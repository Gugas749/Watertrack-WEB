<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
    <div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
        <?= $message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endforeach; ?>

<p>Please fill out the following fields to login:</p>

<?php $form = ActiveForm::begin([
        'id' => 'login-form',
]); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

<div class="my-1 mx-0 text-muted" style="font-size:0.9rem;">
    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
    <!--    <br>-->
    <!--    Need new verification email? --><?php //= Html::a('Resend', ['site/resend-verification-email']) ?>
    <br>
    Dont have account? <?= Html::a('SignUp', ['site/signup']) ?>.
</div>

<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php ActiveForm::end(); ?>
