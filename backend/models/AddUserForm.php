<?php

    namespace backend\models;

    use common\models\User;
    use common\models\UserProfile;
    use Yii;
    use yii\base\Model;

    /**
     * Signup form
     */
    class AddUserForm extends Model
    {
        //USER MODEL
        public $username;
        public $email;
        public $password;

        public $name;
        public $address;
        public $birthDate;
        public $status;

        public $technicianFlag; // 0 ou 1 (Morador / Técnico)
        public $enterpriseID;
        public $profissionalCertificateNumber;


        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                // USER
                ['username', 'trim'],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\common\models\User'],
                ['username', 'string', 'min' => 2, 'max' => 255],

                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'unique', 'targetClass' => '\common\models\User'],

                ['password', 'required'],
                ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

                // PROFILE
                ['name', 'required'],
                ['address', 'required'],
                ['birthDate', 'safe'],

                // USER STATUS
                ['status', 'integer'],

                // TECNICO FLAG
                ['technicianFlag', 'in', 'range' => ['0', '1']],

                // TECNICO EXTRA
                [['enterpriseID', 'profissionalCertificateNumber'], 'required', 'when' => function ($model) {
                    return $model->technicianFlag === '1';
                }, 'whenClient' => "function(){
                return $('#create-user-type').val() === '1';
            }"],
            ];
        }
        /**
         * Signs user up.
         *
         * @return bool whether the creating new account was successful and email was sent
         */
        public function createUser()
        {
            if (!$this->validate()) {
                return null;
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->status = 9;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();

                if($user->save()){
                    $profile = new UserProfile();
                    $profile->userID = $user->id;
                    $profile->name = $this->name;
                    $profile->address = $this->address;
                    $profile->birthDate = $this->birthDate ?: null;
                    $profile->save(false);

                    if ($this->technicianFlag === '1') {
                        $tech = new \common\models\TechnicianInfo();
                        $tech->userID = $user->id;
                        $tech->enterpriseID = $this->enterpriseID;
                        $tech->profissionalCertificateNumber = $this->profissionalCertificateNumber;
                        $tech->save(false);
                    }

                    $auth = Yii::$app->authManager;
                    $role = $auth->getRole($this->technicianFlag === '1' ? 'technician' : 'resident');
                    $auth->assign($role, $user->id);

                    $transaction->commit();
                }
                return true;

            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage(), __METHOD__);
                return false;
            }
        }

        /**
         * Sends confirmation email to user
         * @param User $user user model to with email should be send
         * @return bool whether the email was sent
         */
        protected function sendEmail($user)
        {
            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Account registration at ' . Yii::$app->name)
                ->send();
        }
    }
