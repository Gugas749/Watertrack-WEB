<?php
/** @var $user \common\models\User */
use yii\helpers\Html;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl([
        'site/verify-email',
        'token' => $user->verification_token
]);
?>

Hello <?= Html::encode($user->username) ?>, <!-- adiciona o nome do user -->

<h2>Confirm Your Account</h2>
<p>Click the link below to confirm your email:</p>
<p><a href="<?= $verifyLink ?>"><?= $verifyLink ?></a></p>
