<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    use frontend\assets\AppAsset;
    AppAsset::register($this);
    ?>
    <?php $this->head() ?>
</head>

<body class="lande-page">
<?php $this->beginBody() ?>



<div class="lande-container">
    <?= $content ?>
</div>

<footer>
    &copy; WaterTrack <?= date('Y') ?> | Powered by Yii2
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
