<?php
/** @var $user \common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl([
    'site/verify-email',
    'token' => $user->verification_token
]);
?>

Confirmar Conta
================
Clique no link abaixo para confirmar o seu email:
<?= $verifyLink ?>
