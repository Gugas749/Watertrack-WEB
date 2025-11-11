<?php
/** @var yii\bootstrap5\ActiveForm $form */
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

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
                <h5 class="mb-0 fw-bold text-dark">Adicionar Contador</h5>
                <button type="button" class="btn btn-sm btn-light" id="closePanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-3">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'add-meter-form',
                        'action' => ['meter/createmeter'],
                        'method' => 'post',
                ]); ?>
                <?= $form->field($addMeterModel, 'address')->textInput(['placeholder' => 'Morada', 'autofocus' => true]) ?>
                <?= $form->field($addMeterModel, 'userID')->dropDownList(
                        ArrayHelper::map($users, 'id', function($type) {
                            return $type->id . ' - ' . $type->username;
                        }),
                        ['prompt' => 'Selecione o Utilizador']
                ) ?>
                <?= $form->field($addMeterModel, 'meterTypeID')->dropDownList(
                        ArrayHelper::map($meterTypes, 'id', function($type) {
                            return $type->id . ' - ' . $type->description;
                        }),
                        ['prompt' => 'Selecione o Tipo de Contador']
                ) ?>
                <?= $form->field($addMeterModel, 'enterpriseID')->dropDownList(
                        ArrayHelper::map($enterprises, 'id', function($enterprise) {
                            return $enterprise->id . ' - ' . $enterprise->name;
                        }),
                        ['prompt' => 'Selecione a Empresa']
                ) ?>
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
                <?= $form->field($addMeterModel, 'instalationDate')->input('date', [
                        'placeholder' => 'Data de Instalação'
                ]) ?>
                <?= $form->field($addMeterModel, 'maxCapacity')->textInput(['placeholder' => 'Capacidade Maxima']) ?>
                <?php
                $measureUnityOptions = [
                        '1' => 'm^3',
                        '2' => 'm^3/h',
                        '3' => 'L/s',
                        '4' => 'bar',
                        '5' => 'Litros',
                        '6' => 'Decilitros',
                ];
                ?>
                <?= $form->field($addMeterModel, 'measureUnity')->dropDownList(
                        $measureUnityOptions,
                        ['prompt' => 'Selecione a Unidade de Medida']
                ) ?>
                <?= $form->field($addMeterModel, 'supportedTemperature')->textInput(['placeholder' => 'Temperatura Suportada']) ?>
                <?php
                $stateOptions = [
                        '1' => 'ACTIVE',
                        '2' => 'PROBLEM',
                        '0' => 'INACTIVE',
                ];
                ?>
                <?= $form->field($addMeterModel, 'state')->dropDownList(
                        $stateOptions,
                        ['prompt' => 'Selecione o Estado']
                ) ?>

                <div class="text-end mt-3">
                    <?= \yii\helpers\Html::submitButton('Criar Contador', ['class' => 'btn btn-primary', 'name' => 'createmeter-button']) ?>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
        <!-- Overlay -->
        <div id="overlay"></div>
    </div>
</div>