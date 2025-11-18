<?php
$this->title = "WaterTrack – Solução Digital Inteligente";
?>

<div class="hero-section">
    <header class="navbar">
        <div class="logo">
            <img src="../web/img/tear-drop-png-1.png" alt="WaterTrack">
            <span>WATERTRACK</span>
        </div>

        <nav>
            <a href="#about">Sobre</a>
            <a href="#contact">Contacto</a>
            <?= \yii\helpers\Html::a('Login', ['/site/comece-agora'], ['class' => 'a']) ?>
        </nav>
    </header>

    <div class="hero-content">
        <div class="hero-text">
            <h1>Acompanha o teu<br> Consumo de Água</h1>
            <p>Monitora o teu consumo de água em tempo real e reduz os desperdícios.</p>
            <?= \yii\helpers\Html::a('Começa agora!', ['/site/comece-agora'], ['class' => 'btn-primary']) ?>
        </div>

        <div class="hero-image">
            <img src="../web/img/water-meter.png" alt="Ilustração de Consumo de Água">
        </div>
    </div>
</div>


<section class="how-it-works" id="features">
    <h2>Como Funciona?</h2>

    <div class="steps">

        <div class="step">
            <img src="../web/img/install.png" alt="Instalar Dispositivo">
            <h3>Instala a Aplicação</h3>
            <p>Monitorização movel, agil e simples.</p>
        </div>

        <div class="step">
            <img src="../web/img/phone.png" alt="Acompanhar Consumo">
            <h3>Acompanha o Consumo</h3>
            <p>Acompanha em tempo real os relatórios de consumo.</p>
        </div>

        <div class="step">
            <img style="width: 60px" src="../web/img/waterdrop.png" alt="Reduzir Desperdício">
            <h3>Monitora as tuas leituras</h3>
            <p>Consulta as leituras realizadas e informações adicionais</p>
        </div>
    </div>
</section>
