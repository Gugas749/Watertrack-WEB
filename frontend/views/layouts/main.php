<?php
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\helpers\Url;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->title = $this->title ?: 'WaterTrack';

$route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

$showSidebar = !in_array($route, [
        'site/login',
        'site/signup',
        'site/request-password-reset',
        'site/reset-password'
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php if ($showSidebar): ?>
    <div class="sidebar">
        <div class="logo">
            <?= Html::a('💧 WaterTrack', Url::to(['/dashboard/index'])) ?>
        </div>

        <?= Nav::widget([
                'options' => ['class' => 'nav flex-column'],
                'items' => [
                        ['label' => '📊 Dashboard', 'url' => ['/dashboard/index']],
                        ['label' => '🧮 Contadores', 'url' => ['/meter/index']],
                        ['label' => '📖 Leituras', 'url' => ['/reading/index']],
                        ['label' => '📈 Relatório', 'url' => ['/report/index']],
                        ['label' => '⚙️ Definições', 'url' => ['/dashboard/settings']],
                        ['label' => '⚙️ login', 'url' => ['/site/login']],
                        ['label' => '⚙️ signup', 'url' => ['/site/signup']],
                ],
                'encodeLabels' => false
        ]) ?>

        <div style="position:absolute; bottom:20px; width:100%; text-align:center;">
            <div style="font-size: 12px; color: #aaa;">
                <?= Yii::$app->user->isGuest ? 'Visitante' : Html::encode(Yii::$app->user->identity->username) ?><br>
                <span style="font-size: 11px;">Free Account</span>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="main-content" style="<?= $showSidebar ? '' : 'margin-left:0; max-width:600px; margin:auto; padding-top:80px;' ?>">
    <?php if ($showSidebar): ?>
        <div class="topbar">
            <h4><?= Html::encode($this->title) ?></h4>
            <?= Html::a('+ Relatar Problema', ['/problema/create'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?= $content ?>

    <?php if ($showSidebar): ?>
        <footer>
            &copy; WaterTrack <?= date('Y') ?> | Powered by Yii2
        </footer>
    <?php endif; ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
