
<?php
use common\models\User;



$verifyLink = Yii::$app->urlManager->createAbsoluteUrl([
    '/site/verify-email',
    'token' => $user->verification_token
]);
?>

<h2>Confirmar Conta</h2>
<p>Clique no link abaixo para confirmar a sua conta:</p>
<p><a href="<?= $verifyLink ?>"><?= $verifyLink ?></a></p>
