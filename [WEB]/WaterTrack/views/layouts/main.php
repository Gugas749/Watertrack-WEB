<?php
use app\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\helpers\Url;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->title = $this->title ?: 'WaterTrack';

// Verifica a rota atual (ex: 'site/login', 'site/signup', etc.)
$route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

// Define se deve mostrar a sidebar
$showSidebar = !in_array($route, ['site/login', 'site/signup', 'site/request-password-reset', 'site/reset-password']);
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
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
            color: #333;
        }

        /* Estrutura geral */
        .wrapper {
            display: flex;
            min-height: 100vh;
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

        /* Conteúdo principal */
        .main-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-left: <?= $showSidebar ? '240px' : '0' ?>;
            padding: 30px;
            min-height: 100vh;
            box-sizing: border-box;
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
            margin-top: auto;
        }

        /* Estilo quando não há sidebar (login, signup, etc.) */
        .auth-page {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <?php if ($showSidebar): ?>
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="logo">
                <?= Html::a('💧 WaterTrack', Url::to(['/site/index'])) ?>
            </div>

            <?= Nav::widget([
                    'options' => ['class' => 'nav flex-column'],
                    'items' => [
                            ['label' => '📊 Dashboard', 'url' => ['/site/index']],
                            ['label' => '🧮 Contadores', 'url' => ['/contador/index']],
                            ['label' => '📖 Leituras', 'url' => ['/leitura/index']],
                            ['label' => '📈 Relatório', 'url' => ['/relatorio/index']],
                            ['label' => '⚙️ Definições', 'url' => ['/site/settings']],
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
    <div class="<?= $showSidebar ? 'main-content' : 'auth-page' ?>">
        <?php if ($showSidebar): ?>
            <div class="topbar">
                <h4><?= Html::encode($this->title) ?></h4>
                <?= Html::a('+ Relatar Problema', ['/problema/create'], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php endif; ?>

        <?= $content ?>

        <footer>
            &copy; WaterTrack <?= date('Y') ?> | Powered by Yii2
        </footer>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
