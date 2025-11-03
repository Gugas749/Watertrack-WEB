<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Contadores</h4>
            <div class="d-flex align-items-center gap-3">

                <div class="input-group mx-5" style="width:220px;">
                    <input type="text" class="form-control form-control-sm rounded-pill ps-3 pe-5" placeholder="Search"
                           style="border:1px solid #e5e7eb;">
                    <span class="input-group-text bg-transparent border-0 text-muted"
                          style="position:absolute; right:10px; top:50%; transform:translateY(-50%);">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                <button class="btn btn-primary rounded-4" style="background-color:#4f46e5; border:none;">
                    <i class="fas fa-plus me-1"></i> Adicionar Contador
                </button>
            </div>
        </div>

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