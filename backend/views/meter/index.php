<?php
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Contadores';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/views-index.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/main-index.js', ['depends' => [\yii\bootstrap5\BootstrapPluginAsset::class]]);
?>
<?php
$classOptions = [
        'A' => 'Classe A',
        'B' => 'Classe B',
        'C' => 'Classe C',
        'D' => 'Classe D',
];

$measureUnityOptions = [
        '1' => 'm^3',
        '2' => 'm^3/h',
        '3' => 'L/s',
        '4' => 'bar',
        '5' => 'Litros',
        '6' => 'Decilitros',
];

$stateOptions = [
        '1' => 'ATIVO',
        '2' => 'COM PROBLEMA',
        '0' => 'INATIVO',
];
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
                            'options' => [
                                    'class' => 'd-flex align-items-center w-100',
                            ],
                    ]); ?>
                    <input type="text"
                           name="q"
                           class="form-control form-control-sm ps-3 pe-5"
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
                <button class="btn btn-primary"
                        data-toggle="right-panel"
                        style="background-color:#4f46e5; border:none;">
                    <i class="fas fa-plus me-1"></i> Adicionar Contador
                </button>
            </div>
        </div>
        <!-- ALERT -->
        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
            <?php
            $bgClass = match($type) {
                'error' => 'bg-danger text-white',
                'success' => 'bg-success text-white',
                default => 'bg-info text-white',
            };
            ?>
            <div class="toast show <?= $bgClass ?> ms-auto" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-bell-fill me-2"></i><?= $message ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php endforeach; ?>
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
                                            <a href="https://www.google.com/maps/search/<?= urlencode($meter->address) ?>" class="text-decoration-none text-primary">
                                                <?= htmlspecialchars($meter->address) ?>
                                            </a>
                                        </td>
                                        <td><?= htmlspecialchars($meter->instalationDate ?? 'N/A') ?></td>
                                        <td>
                                            <?php
                                            $statusText = match ($meter->state ?? null) {
                                                1 => 'ATIVO',
                                                2  => 'PROBLEMA RELATADO',
                                                0  => 'DESATIVADO',
                                                default => 'DESCONHECIDO',
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
                                            <?= Html::button('Ver Detalhes', [
                                                    'class' => 'btn btn-outline-primary btn-sm fw-semibold shadow-sm',
                                                    'onclick' => "window.location.href='" . Url::to(['meter/index', 'id' => $meter->id]) . "'",
                                                    'style' => 'transition: all 0.2s ease-in-out;',
                                                    'onmouseover' => "this.style.transform='scale(1.05)';",
                                                    'onmouseout' => "this.style.transform='scale(1)';"
                                            ]) ?>
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
                <button type="button" class="btn btn-sm btn-light" id="closeRightPanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-3">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'add-meter-form',
                        'action' => ['meter/create'],
                        'method' => 'post',
                ]); ?>
                <?= $form->field($addMeterModel, 'address')->textInput(['placeholder' => 'Morada']) ?>
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
                <?= $form->field($addMeterModel, 'class')->dropDownList(
                        $classOptions,
                        ['prompt' => 'Selecione a Classe']
                ) ?>
                <?= $form->field($addMeterModel, 'instalationDate')->input('date', [
                        'placeholder' => 'Data de Instalação'
                ]) ?>
                <?= $form->field($addMeterModel, 'maxCapacity')->textInput(['placeholder' => 'Capacidade Maxima']) ?>
                <?= $form->field($addMeterModel, 'measureUnity')->dropDownList(
                        $measureUnityOptions,
                        ['prompt' => 'Selecione a Unidade de Medida']
                ) ?>
                <?= $form->field($addMeterModel, 'supportedTemperature')->textInput(['placeholder' => 'Temperatura Suportada']) ?>
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
        <!-- DETAIL PANEL -->
        <?php if ($detailMeter): ?>
            <div id="detailPanel" class="detail-panel bg-white shadow show">
                <div class="modal-content border-0 shadow-lg rounded-4 p-4" style="background-color:#fff">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Detalhes do Tipo de Contador</h5>
                        <button type="button" class="closeDetailPanel btn btn-sm btn-light">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <?php $form = \yii\widgets\ActiveForm::begin([
                            'id' => 'update-meter-form',
                            'action' => ['update', 'id' => $detailMeter->id],
                            'method' => 'post',
                    ]); ?>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'id')->textInput(['readonly' => true])->label('Referência') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'address')->textInput()->label('Morada') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'userID')->textInput()->label('Utilizador Responsável')
                                    ->dropDownList(
                                    ArrayHelper::map($users, 'id', function($type) {
                                        return $type->id . ' - ' . $type->username;
                                    })
                            )?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'meterTypeID')->textInput()->label('Tipo de Contador')
                                    ->dropDownList(
                                    ArrayHelper::map($meterTypes, 'id', function($type) {
                                        return $type->description;
                                    })
                            )?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'enterpriseID')->textInput()->label('Empresa Agregada')
                                    ->dropDownList(
                                    ArrayHelper::map($enterprises, 'id', function($enterprise) {
                                        return $enterprise->name;
                                    })
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'class')->textInput()->label('Classe de Contador')
                                ->dropDownList(
                                    $classOptions
                            )?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'instalationDate')->textInput(['readonly' => true])->label('Data de Instalação') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'shutdownDate')->textInput(['readonly' => true])->label('Data de Desativação') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'maxCapacity')->textInput()->label('Capacidade Máxima') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'measureUnity')->textInput()->label('Unidade de Medida')
                                    ->dropDownList(
                                            $measureUnityOptions
                                    )?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'supportedTemperature')->textInput()->label('Temperatura Suportada') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($detailMeter, 'state')->textInput()->label('Estado')
                                    ->dropDownList(
                                            $stateOptions
                                    )?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center gap-2 mt-4">
                        <button type="button" class="closeDetailPanel btn btn-light px-4 py-2">Fechar</button>
                        <?= \yii\helpers\Html::submitButton('Salvar', [
                                'class' => 'btn btn-primary px-4 py-2',
                                'style' => 'background-color:#4f46e5; border:none;'
                        ]) ?>
                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--ATIVAR O DETAIL PANEL -->
        <?php if ($detailMeter): ?>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const detailPanel = document.getElementById('detailPanel');
                    const overlay = document.getElementById('overlay');

                    overlay.style.display = 'block';
                    detailPanel.style.display = 'block';
                    document.body.style.overflow = 'hidden';

                    requestAnimationFrame(() => {
                        detailPanel.classList.add('show');
                    });
                });
            </script>
        <?php endif; ?>
        <!-- OVERLAY -->
        <div id="overlay"></div>
    </div>
</div>