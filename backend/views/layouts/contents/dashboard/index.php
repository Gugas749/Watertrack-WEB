<div class="content">
    <div class="container d-flex justify-content-center flex-wrap mt-5">
        <div class="col-lg-3 col-md-4 col-sm-6 col-10 m-2">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Contadores Ativos',
                'number' => '32',
                'icon' => 'fas fa-tint',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-10 m-2">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Leituas Criadas',
                'number' => '410',
                'icon' => 'fas fa-clipboard-list',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-10 m-2">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Utilizadores',
                'number' => '16',
                'icon' => 'fas fa-users',
            ]) ?>
        </div>
    </div>
    <div class="container-fluid py-4" style="background-color:#f8f9fc;">
        <div class="row justify-content-center">

            <!-- Gráfico de Consumo -->
            <div class="col-lg-7 col-md-12 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 16px;">
                    <div class="card-body">
                        <h6 class="mb-3 fw-bold text-secondary">Gráfico de Leituras Criadas</h6>
                        <div style="height: 250px; background: linear-gradient(90deg, rgba(108,99,255,0.1), rgba(255,107,230,0.1)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color:#777;">
                            <span>Gráfico aqui</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Última Leitura -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 16px;">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-secondary mb-3">Contadores</h6>
                        <div style="width:160px; height:160px; margin:auto; border-radius:50%; background: conic-gradient(#4f46e5 0% 35%, #f59e0b 35% 65%, #f43f5e 65% 100%); display:flex; align-items:center; justify-content:center; color:#1f2937; font-size:22px; font-weight:600;">
                        </div>
                        <button class="btn btn-sm btn-secondary my-3 rounded-4">Ver Contadores</button>
                        <div class="d-flex justify-content-center mt-3gap-3">
                            <span><i class="fas fa-circle text-indigo-600 mx-1"></i>Ativos</span>
                            <span><i class="fas fa-circle text-amber-400 mx-1"></i>Inativos</span>
                            <span><i class="fas fa-circle text-rose-500 mx-1"></i>Com Problema</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertas Ativos -->
            <div class="col-lg-11 col-md-12">
                <div class="card shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-body">
                        <h6 class="fw-bold text-secondary mb-3">Alertas Ativos</h6>
                        <table class="table align-middle">
                            <thead class="text-muted small">
                            <tr>
                                <th>Referência do Contador</th>
                                <th>Contador Nome</th>
                                <th>Última Inspeção</th>
                                <th>Total de Ocorrências</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>#876364</td>
                                <td><i class="fas fa-tint text-primary me-2"></i> Câmara Municipal</td>
                                <td>15/01/2000</td>
                                <td><span class="badge bg-light text-dark px-3">2</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Relatório</a></td>
                            </tr>
                            <tr>
                                <td>#876368</td>
                                <td><i class="fas fa-tint text-info me-2"></i> Bairro Central</td>
                                <td>15/01/2000</td>
                                <td><span class="badge bg-light text-dark px-3">1</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Relatório</a></td>
                            </tr>
                            <tr>
                                <td>#876412</td>
                                <td><i class="fas fa-tint text-warning me-2"></i> Zona Industrial</td>
                                <td>15/01/2000</td>
                                <td><span class="badge bg-light text-dark px-3">5</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Relatório</a></td>
                            </tr>
                            <tr>
                                <td>#876621</td>
                                <td><i class="fas fa-tint text-danger me-2"></i> Área Norte</td>
                                <td>15/01/2000</td>
                                <td><span class="badge bg-light text-dark px-3">2</span></td>
                                <td><a href="#" class="btn btn-sm btn-primary rounded-4">Ver Relatório</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style> /*EVITAR SCROLL HORIZONTAL*/
    body {
        overflow-x: hidden;
    }
    .container, .container-fluid {
        max-width: 100vw;
        overflow-x: hidden;
    }
</style>


