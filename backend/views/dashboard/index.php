<div class="content">

    <!-- Info Boxes -->
    <div class="container d-flex justify-content-center flex-wrap mt-5">
        <div class="col-lg-3 col-md-4 col-sm-6 col-10 m-2">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Contadores Ativos',
                'number' => $activeMeterCount,
                'icon' => 'fas fa-tint',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-10 m-2">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Leituas Criadas',
                'number' => $readingCount,
                'icon' => 'fas fa-clipboard-list',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-10 m-2">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Utilizadores',
                'number' => $userCount,
                'icon' => 'fas fa-user',
            ]) ?>
        </div>
    </div>

    <!-- Corpo da Dashboard -->
    <div class="container-fluid py-4" style="background-color:#f8f9fc;">
        <div class="row justify-content-center">

            <!-- Gráfico de Leituras -->
            <div class="col-lg-7 col-md-12 mb-4">
                <div class="card shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-body">
                        <h6 class="mb-3 fw-bold text-secondary">Gráfico de Leituras por Mês</h6>
                        <canvas id="chartLeituras" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico Donut -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-secondary mb-3">Resumo de Contadores</h6>
                        <canvas id="chartDonut" height="160"></canvas>
                        <button class="btn btn-sm btn-secondary my-3 rounded-4">Ver Contadores</button>
                        <div class="d-flex justify-content-center gap-3 mt-2 small">
                            <span><i class="fas fa-circle text-success mx-1"></i>Ativos</span>
                            <span><i class="fas fa-circle text-warning mx-1"></i>Com Problema</span>
                            <span><i class="fas fa-circle text-danger mx-1"></i>Inativos</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Histórico de Leituras -->
            <div class="col-lg-11 col-md-12">
                <div class="card shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-body">
                        <h6 class="fw-bold text-secondary mb-3">Histórico de Leituras Recentes</h6>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="text-muted small">
                                <tr>
                                    <th>Referência</th>
                                    <th>Leitura</th>
                                    <th>Data</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#123456</td>
                                    <td>10m³</td>
                                    <td>10/10/2024</td>
                                    <td><span class="badge bg-success">Validada</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Detalhes</a></td>
                                </tr>
                                <tr>
                                    <td>#123457</td>
                                    <td>9m³</td>
                                    <td>09/10/2024</td>
                                    <td><span class="badge bg-warning text-dark">Pendente</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Detalhes</a></td>
                                </tr>
                                <tr>
                                    <td>#123458</td>
                                    <td>8m³</td>
                                    <td>08/10/2024</td>
                                    <td><span class="badge bg-danger">Erro</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Detalhes</a></td>
                                </tr>
                                <tr>
                                    <td>#123459</td>
                                    <td>11m³</td>
                                    <td>07/10/2024</td>
                                    <td><span class="badge bg-success">Validada</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Detalhes</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
        // Gráfico de barras
        new Chart(document.getElementById("chartLeituras"), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out'],
                datasets: [{
                    label: 'Leituras',
                    data: [120, 180, 150, 200, 250, 230, 280, 310, 270, 320],
                    backgroundColor: '#4f46e5',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {legend: {display: false}},
                scales: {
                    y: {beginAtZero: true, ticks: {color: '#6b7280'}},
                    x: {ticks: {color: '#6b7280'}}
                }
            }
        });

        // Gráfico donut
        new Chart(document.getElementById("chartDonut"), {
            type: 'doughnut',
            data: {
                labels: ['Ativos', 'Com Problema', 'Inativos'],
                datasets: [{
                    data: [65, 20, 15],
                    backgroundColor: ['#4f46e5', '#f59e0b', '#ef4444'],
                    cutout: '70%'
                }]
            },
            options: {plugins: {legend: {position: 'bottom'}}}
        });
    });
</script>

<style>
    body {
        overflow-x: hidden;
    }

    .container, .container-fluid {
        max-width: 100vw;
        overflow-x: hidden;
    }

    .card {
        transition: all .3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }
</style>
