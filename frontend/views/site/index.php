<?php
$this->title = "WaterTrack – Solução Digital Inteligente";
?>

<div class="hero-section">
    <header class="navbar">
        <div class="logo">
            <img src="../img/tear-drop-png-1.png" alt="WaterTrack">
            <span>WATERTRACK</span>
        </div>

        <nav>
            <a href="#about">Sobre</a>
            <a href="#contact">Contacto</a>
            <?= \yii\helpers\Html::a('Login', ['/site/login'], ['class' => 'a']) ?>
        </nav>
    </header>

    <div class="hero-content">
        <div class="hero-text">
            <h1>Acompanhe o seu<br> Consumo de Água</h1>
            <p>Monitore o seu consumo de água em tempo real e reduza desperdícios.</p>
            <?= \yii\helpers\Html::a('Começar', ['/site/login'], ['class' => 'btn-primary']) ?>
        </div>

        <div class="hero-image">
            <img src="../img/water-meter.png" alt="Ilustração de Consumo de Água">
        </div>
    </div>
</div>


<section class="how-it-works" id="features">
    <h2>Como Funciona</h2>

    <div class="steps">

        <div class="step">
            <img src="../img/install.png" alt="Instalar Dispositivo">
            <h3>Instale o Dispositivo</h3>
            <p>Monitorização portátil e simples.</p>
        </div>

        <div class="step">
            <img src="../img/phone.png" alt="Acompanhar Consumo">
            <h3>Acompanhe o Consumo</h3>
            <p>Acompanhe em tempo real e receba previsões de utilização.</p>
        </div>

        <div class="step">
            <img style="width: 60px" src="../img/waterdrop.png" alt="Reduzir Desperdício">
            <h3>Reduza o Desperdício</h3>
            <p>Use insights para reduzir a fatura e o desperdício de água.</p>
        </div>

    </div>
</section>
