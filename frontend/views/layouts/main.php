<?php
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\helpers\Url;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->title = $this->title ?: 'WaterTrack';

// Verifica a rota atual (ex: 'dashboard/login', 'dashboard/signup', etc.)
$route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

// Define se deve mostrar a sidebar
$showSidebar = !in_array($route, ['dashboard/login', 'dashboard/signup', 'dashboard/request-password-reset', 'dashboard/reset-password']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background-color: #fff;
            border-right: 1px solid #e6e6e6;
            padding: 20px 0;
        }

        .sidebar .logo {
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #555;
            padding: 10px 25px;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #e8f0fe;
            color: #007bff;
        }

        /* Conteúdo */
        .main-content {
            margin-left: 240px;
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .topbar .btn-primary {
            background-color: #4f46e5;
            border: none;
        }

        footer {
            background-color: #fff;
            border-top: 1px solid #e6e6e6;
            padding: 15px;
            text-align: center;
            color: #999;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<?php if ($showSidebar): ?>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <?= Html::a('💧 WaterTrack', Url::to(['/dashboard/index'])) ?>
        </div>

        <?= Nav::widget([
                'options' => ['class' => 'nav flex-column'],
                'items' => [
                        ['label' => '📊 Dashboard', 'url' => ['/dashboard/index']],
                        ['label' => '🧮 Contadores', 'url' => ['/contador/index']],
                        ['label' => '📖 Leituras', 'url' => ['/leitura/index']],
                        ['label' => '📈 Relatório', 'url' => ['/relatorio/index']],
                        ['label' => '⚙️ Definições', 'url' => ['/dashboard/settings']],
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

<!-- CONTEÚDO PRINCIPAL -->
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
