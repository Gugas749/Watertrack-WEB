<?php
/** @var yii\web\View $this */
$this->title = 'Leituras';
?>

<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Leituras</h4>
            <div class="d-flex align-items-center gap-3">

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
                    <i class="fas fa-sync me-1"></i> Atualizar Leituras
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
                                <h3 class="fw-bold mb-0 text-dark">5,00,874</h3>
                                <small class="text-success fw-semibold">+1,400 Novos</small>
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
                                <h3 class="fw-bold mb-0 text-dark">2,34,888</h3>
                                <small class="text-success fw-semibold">+1,000 Hoje</small>
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
                                <tbody>
                                <?php for ($i = 0; $i < 6; $i++): ?>
                                    <tr>
                                        <td>123456</td>
                                        <td>10m³</td>
                                        <td>10/01/2000</td>
                                        <td><a href="#" class="text-primary fw-semibold text-decoration-none">Ver Detalhes</a></td>
                                    </tr>
                                <?php endfor; ?>
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

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h6 class="fw-bold text-secondary mb-3">Resumo Geral</h6>
                        <canvas id="donutChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
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

        new Chart(document.getElementById("donutChart"), {
            type: 'doughnut',
            data: {
                labels: ['Total Sales', 'Total Order', 'Order Cancel'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: ['#4f46e5', '#f59e0b', '#ef4444'],
                    cutout: '70%'
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });
    });
</script>

<style>
    body { overflow-x: hidden; background-color:#f9fafb; }
    .container, .container-fluid { max-width: 100vw; overflow-x: hidden; }
    .card { transition: all 0.3s ease; }
    .card:hover { transform: translateY(-3px); box-shadow: 0 8px 16px rgba(0,0,0,0.06); }
</style>
