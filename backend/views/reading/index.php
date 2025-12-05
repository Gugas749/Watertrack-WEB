<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Enterprise;
use common\models\Userprofile;

$this->title = 'Leituras';
$this->registerCssFile('@web/css/views-index.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerCssFile('@web/js/main-index.js', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/reading-index.js', ['depends' => [\yii\bootstrap5\BootstrapPluginAsset::class]]);
?>
<?php
$statusOptions = [
        1 => 'COM PROBLEMAS',
        0  => 'SEM PROBLEMAS',
];
$statusClasses = [
        0 => 'text-success',
        1  => 'text-warning',
];

$statusClassesUser = match ($user->status ?? null) {
    0 => 'bg-success',
    1  => 'bg-warning',
    default => 'bg-secondary',
};

$statusText = match ($user->status ?? null) {
    1 => 'COM PROBLEMAS',
    0  => 'SEM PROBLEMAS',
    default => 'DESCONHECIDO',
};

$statusClass = match ($user->status ?? null) {
    0 => 'text-success',
    1  => 'text-warning',
    default => 'text-muted',
};
?>

<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Leituras</h4>
            <div class="d-flex align-items-center gap-3">
                <!-- Dropdown selection -->
                <?= Html::dropDownList(
                        'enterprise_id',
                        null,
                        $enterpriseItems,
                        [
                                'class' => 'form-select',
                                'id' => 'enterprise-dropdown',
                                'prompt' => 'Selecione uma Empresa',
                        ]
                ) ?>
                <?= Html::dropDownList(
                        'meter_id',
                        null,
                        [],
                        [
                                'class' => 'form-select',
                                'id' => 'meter-dropdown',
                                'prompt' => 'Selecione um Item',
                        ]
                ) ?>

                <!-- Date range -->
                <div class="input-group mx-3" style="width:220px;">
                    <input type="date" class="form-control form-control-sm rounded-pill ps-3 pe-5"
                           style="border:1px solid #e5e7eb;">
                </div>
                <span class="text-muted">–</span>
                <div class="input-group" style="width:220px;">
                    <input type="date" class="form-control form-control-sm rounded-pill ps-3 pe-5"
                           style="border:1px solid #e5e7eb;">
                </div>

                <!-- Action -->
                <button class="btn btn-primary rounded-4" style="background-color:#4f46e5; border:none;">
                    <i class="fas fa-sync me-1"></i>
                </button>
            </div>
        </div>
        <!-- Cards superiores -->
        <div class="row g-4 px-3 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="card shadow-sm border-0 rounded-4" style="background:white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1">Consumo Acumulado</h6>
                                <h3 class="fw-bold mb-0 text-dark" id="accumulatedConsumption-label">0</h3>
<!--                                <small class="text-success fw-semibold">+1,400 Novos</small>-->
                            </div>
                            <div class="text-primary fs-3"><i class="fas fa-tint"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card shadow-sm border-0 rounded-4" style="background:white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1">Média da Pressão</h6>
                                <h3 class="fw-bold mb-0 text-dark" id="waterPressure-label">0</h3>
<!--                                <small class="text-success fw-semibold">+1,000 Hoje</small>-->
                            </div>
                            <div class="text-warning fs-3"><i class="fas fa-gauge-high"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Corpo principal -->
        <div class="row px-3">
            <!-- Histórico -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h6 class="fw-bold text-secondary mb-3">Histórico de Leituras</h6>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="text-muted small">
                                <tr>
                                    <th>Referência Leitura</th>
                                    <th>Leitura</th>
                                    <th>Data da Leitura</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="readings-table-body">
                                <!-- Javascript que vai encher a lista -->
                                <tr><td colspan="4" class="text-muted text-center">Sem leituras.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold text-secondary mb-3">Leituras por Mês</h6>
                        <canvas id="barChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- DETAIL PANEL -->
        <?php if ($detailReading): ?>
            <div id="detailPanel" class="detail-panel bg-white shadow show">
                <div class="modal-content border-0 shadow-lg rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Detalhes da Leitura
                            <?php if ($detailReading->readingType === 1): ?>
                                <i class="fas fa-wrench ms-2"></i>
                            <?php endif; ?></h5>
                        <button type="button" class="closeDetailPanel btn btn-sm btn-light">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <?php $form = \yii\widgets\ActiveForm::begin([
                            'id' => 'update-meter-form',
                            'action' => ['update', 'id' => $detailReading->id],
                            'method' => 'post',
                    ]); ?>
                    <!-- STATUS BADGE -->
                    <div class="mb-4">
                        <?php
                        $statusClass = $statusClasses[$detailReading->problemState ?? 0] ?? 'bg-secondary';
                        $statusText = $statusOptions[$detailReading->problemState ?? 0] ?? 'DESCONHECIDO';
                        ?>
                        <span id="user-status-badge" class="badge <?= $statusClass ?> px-3 py-2"><?= $statusText ?></span>
                    </div>
                    <!-- RESTO DOS CAMPOS -->
                    <div class="row g-1">
                        <div class="col-md-2"><?= $form->field($detailReading, 'id')->textInput(['readonly' => true])->label('Referência') ?></div>
                        <div class="col-md-4"><?= $form->field($technician, 'username')->textInput(['readonly' => true])->label('Tecnico') ?></div>
                        <div class="col-md-5"><?= $form->field($meter, 'address')->textInput(['readonly' => true])->label('Contador') ?></div>
                        <div class="col-md-4"><?= $form->field($detailReading, 'reading')->textInput(['readonly' => true])->label('Leitura') ?></div>
                        <div class="col-md-4"><?= $form->field($detailReading, 'accumulatedConsumption')->textInput(['readonly' => true])->label('Consumo acumulado') ?></div>
                        <div class="col-md-3"><?= $form->field($detailReading, 'waterPressure')->textInput(['readonly' => true])->label('Pressão da Agua') ?></div>
                        <div class="col-md-11"><?= $form->field($detailReading, 'desc')->textInput(['readonly' => true])->label('Descrição') ?></div>
                        <div class="col-md-3"><?= $form->field($detailReading, 'date')->textInput(['value' => Yii::$app->formatter->asDate($detailReading->date), 'readonly' => true])->label('Data') ?></div>
                        <?php if ($detailReading->readingType === 1): ?>
                            <div class="col-md-5"><?= $form->field($problem, 'problemType')->textInput(['readonly' => true])->label('Problema') ?></div>
                        <?php endif; ?></h5>
                    </div>
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="closeDetailPanel btn btn-light px-4">Fechar</button>
                        <?= Html::submitButton('Editar', ['class' => 'btn btn-primary px-4 py-2', 'style' => 'background-color:#4f46e5; border:none;']) ?>
                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--ATIVAR O DETAIL PANEL -->
        <?php if ($detailReading): ?>
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        new Chart(document.getElementById("barChart"), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Leituras',
                    data: [23400, 16000, 30000, 10000, 23000, 5000, 12000],
                    backgroundColor: '#4f46e5',
                    borderRadius: 6
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { color: '#6b7280' } }, x: { ticks: { color: '#6b7280' } } }
            }
        });
    });
</script>
<!-- AJAX URLS -->
<script>
    const getMetersUrl = "<?= \yii\helpers\Url::to(['/reading/get-meters']) ?>";
    const getReadingsUrl = "<?= \yii\helpers\Url::to(['/reading/get-readings']) ?>";
    const getReadingDetailUrl = "<?= \yii\helpers\Url::to(['/reading/get-reading-detail']) ?>";
</script>
