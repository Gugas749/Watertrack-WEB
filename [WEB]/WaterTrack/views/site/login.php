<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<style>
    body {
        background-color: #f8f9fc;
        font-family: 'Inter', sans-serif;
    }

    .login-container {
        display: flex;
        min-height: 100vh;
    }

    /* Lado esquerdo (formulário) */
    .login-form-section {
        flex: 1;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }

    .login-form-section h2 {
        margin-top: 20px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .social-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 130px;
        height: 40px;
        border-radius: 8px;
        font-weight: 500;
        color: #fff;
        cursor: pointer;
        text-decoration: none;
    }

    .social-btn.google {
        background-color: #db4437;
    }

    .social-btn.facebook {
        background-color: #4267b2;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 20px 0;
        color: #aaa;
        font-size: 14px;
    }

    .divider::before, .divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #ddd;
        margin: 0 10px;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px 12px;
    }

    .form-check-label {
        font-size: 14px;
        color: #555;
    }

    .login-btn {
        width: 100%;
        background-color: #4f46e5;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 10px;
        font-weight: 500;
        transition: 0.3s;
    }

    .login-btn:hover {
        background-color: #4338ca;
    }

    .extra-links {
        margin-top: 10px;
        text-align: center;
        font-size: 14px;
    }

    .extra-links a {
        color: #4f46e5;
        text-decoration: none;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }

    /* Lado direito (imagem) */
    .login-image-section {
        flex: 1;
        background-color: #f8f9fc;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }

    .login-image-section img {
        max-width: 90%;
        height: auto;
    }
</style>

<div class="login-container">

    <div class="login-form-section">
        <div class="text-center">
            <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="WaterTrack Logo" width="100">
        </div>

        <h2>Log in</h2>

        <div class="social-buttons">
            <a href="#" class="social-btn google">Google</a>
            <a href="#" class="social-btn facebook">Facebook</a>
        </div>

        <div class="divider">Or</div>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'example@gmail.com'])->label('Email Address') ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => '********'])->label('Password') ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <?= $form->field($model, 'rememberMe')->checkbox(['label' => 'Remember me']) ?>
            <a href="<?= \yii\helpers\Url::to(['site/request-password-reset']) ?>" style="font-size: 14px;">Reset Password?</a>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Log in', ['class' => 'btn login-btn', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="extra-links">
            Don’t have an account yet? <?= Html::a('New Account', ['site/signup']) ?>
        </div>
    </div>


    <div class="login-image-section">
        <img src="<?= Yii::getAlias('@web/images/login-illustration.png') ?>" alt="Login Illustration">
    </div>
</div>
