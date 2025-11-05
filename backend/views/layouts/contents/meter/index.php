<?php
/** @var yii\bootstrap5\ActiveForm $form */
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Contadores';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/meter-index.css', ['depends' => [\yii\bootstrap4\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/meter-index.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">
        <!-- NAVIGATION? -->
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Contadores</h4>
            <div class="d-flex align-items-center gap-3">
                <!-- Search -->
                <div class="input-group mx-5" style="width:220px;">
                    <?php $form = ActiveForm::begin([
                            'method' => 'get',
                            'action' => ['meter/index'],
                            'options' => ['class' => 'd-flex align-items-center w-100'],
                    ]); ?>
                    <input type="text"
                           name="q"
                           class="form-control form-control-sm rounded-pill ps-3 pe-5"
                           placeholder="Search"
                           value="<?= Html::encode(Yii::$app->request->get('q')) ?>"
                           style="border:1px solid #e5e7eb;">
                    <button type="submit" class="input-group-text bg-transparent border-0 text-muted"
                            style="position:absolute; right:10px; top:50%; transform:translateY(-50%);">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- Open Panel Button -->
                <button class="btn btn-primary rounded-4"
                        data-toggle="right-panel"
                        style="background-color:#4f46e5; border:none;">
                    <i class="fas fa-plus me-1"></i> Adicionar Contador
                </button>
            </div>
        </div>
        <!-- METER LIST -->
        <div class="card shadow-sm border-0 mx-3" style="border-radius:16px;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary mb-3">
                    Total de Contadores: <?= count($meters) ?>
                </h6>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-muted small">
                        <tr>
                            <th>Referência</th>
                            <th>Morada</th>
                            <th>Data de Instalação</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($meters)): ?>
                                <?php foreach ($meters as $meter): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($meter->id) ?></td>
                                        <td>
                                            <a href="#" class="text-decoration-none text-primary">
                                                <?= htmlspecialchars($meter->address) ?>
                                            </a>
                                        </td>
                                        <td><?= htmlspecialchars($meter->instalationDate ?? 'N/A') ?></td>
                                        <td>
                                            <?php
                                            $statusText = match ($meter->state ?? null) {
                                                1 => 'ACTIVE',
                                                2  => 'PROBLEM',
                                                0  => 'DEACTIVATED',
                                                default => 'UNKNOWN',
                                            };
    
                                            $statusClass = match ($meter->state ?? null) {
                                                1 => 'text-success',
                                                2  => 'text-warning',
                                                0  => 'text-muted',
                                                default => 'text-muted',
                                            };
                                            ?>
                                            <span class="<?= $statusClass ?> fw-semibold">
                                                    <?= htmlspecialchars($statusText) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="text-primary fw-semibold">Ver Detalhes</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Nenhum contador encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- RIGHT PANEL -->
        <div id="rightPanel" class="right-panel bg-white shadow" style="display:none;">
            <div class="right-panel-header d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 class="mb-0 fw-bold text-dark">Adicionar Utilizador</h5>
                <button type="button" class="btn btn-sm btn-light" id="closePanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-3">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'add-user-form',
                        'action' => ['meter/createmeter'],
                        'method' => 'post',
                ]); ?>
                <?= $form->field($addMeterModel, 'address')->textInput(['placeholder' => 'Morada', 'autofocus' => true]) ?>
                <?= $form->field($addMeterModel, 'userID')->textInput(['placeholder' => 'User id']) ?>
                <?= $form->field($addMeterModel, 'meterTypeID')->textInput(['placeholder' => 'Meter type id']) ?>
                <?= $form->field($addMeterModel, 'enterpriseID')->textInput(['placeholder' => 'Enterprise id']) ?>
                <?php
                    $classOptions = [
                            'A' => 'Classe A',
                            'B' => 'Classe B',
                            'C' => 'Classe C',
                            'D' => 'Classe D',
                    ];
                ?>
                <?= $form->field($addMeterModel, 'class')->dropDownList(
                        $classOptions,
                        ['prompt' => 'Selecione a Classe']
                ) ?>


                <div class="text-end mt-3">
                    <?= \yii\helpers\Html::submitButton('Criar Utilizador', ['class' => 'btn btn-primary', 'name' => 'createuser-button']) ?>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
        <!-- Overlay -->
        <div id="overlay"></div>
    </div>
</div>