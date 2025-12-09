<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Enterprise;
use common\models\Userprofile;

$this->title = 'Leituras';
$this->registerCssFile('@web/css/views-index.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/main-index.js', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
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
        <div id="detailPanel" class="detail-panel bg-white shadow" style="display:none;">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4">
                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">
                        Detalhes da Leitura
                        <i id="detailWrenchIcon" class="fas fa-wrench ms-2" style="display:none;"></i>
                    </h5>
                    <button type="button" class="closeDetailPanel btn btn-sm btn-light">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- STATUS BADGE -->
                <div class="mb-4">
                    <span id="detailStatusBadge" class="badge bg-secondary px-3 py-2">
                        DESCONHECIDO
                    </span>
                </div>

                <!-- FIELDS -->
                <div class="row g-1">
                    <div class="col-md-2">
                        <label class="form-label">Referência</label>
                        <input id="detailReadingId" readonly class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Técnico</label>
                        <input id="detailTechnician" readonly class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Contador</label>
                        <input id="detailMeterAddress" readonly class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Leitura</label>
                        <input id="detailReadingValue" readonly class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Consumo acumulado</label>
                        <input id="detailAccumulatedConsumption" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pressão da Água</label>
                        <input id="detailWaterPressure" readonly class="form-control">
                    </div>
                    <div class="col-md-11">
                        <label class="form-label">Descrição</label>
                        <input id="detailDesc" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data</label>
                        <input id="detailDate" readonly class="form-control">
                    </div>
                    <!-- ONLY SHOW IF readingType === 1 (via JS) -->
                    <div class="col-md-5" id="detailProblemContainer" style="display:none;">
                        <label class="form-label">Problema</label>
                        <input id="detailProblemType" readonly class="form-control">
                    </div>
                </div>

                <!-- FOOTER BUTTONS -->
                <div class="d-flex justify-content-end mt-4 gap-2">
                    <button type="button" class="closeDetailPanel btn btn-light px-4">Fechar</button>
                    <button id="detailEditButton" class="btn btn-primary px-4 py-2"
                            style="background-color:#4f46e5; border:none;">
                        Editar
                    </button>
                </div>

            </div>
        </div>
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
