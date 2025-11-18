<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <h1>Bem-vindo ao WaterTrack</h1>
        <p>Monitorização inteligente para uma gestão eficiente de água.</p>
        <br>
        <a href="#features" class="btn btn-light btn-lg">Saber mais</a>
    </div>
</section>

<!-- FEATURES SECTION -->
<section id="features" class="features-section">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-4">
                <div class="feature-box">
                    <h4>Monitorização em Tempo Real</h4>
                    <p>Acompanhe consumos, alertas e estatísticas instantaneamente.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <h4>Alertas Inteligentes</h4>
                    <p>Receba avisos automáticos sobre fugas e consumos anormais.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <h4>Gestão Simplificada</h4>
                    <p>Interface intuitiva para utilizadores e administradores.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTENT EXTRA DO CONTROLLER -->
<div class="extra-content">
    <?= $content ?>
</div>

<!-- FOOTER -->
<footer>
    <p>&copy; <?= date('Y') ?> WaterTrack — Todos os direitos reservados.</p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
