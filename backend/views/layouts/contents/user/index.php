<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Utilizadores</h4>
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
                    <i class="fas fa-plus me-1"></i> Adicionar Utilizador
                </button>
            </div>
        </div>

        <div class="card shadow-sm border-0 mx-3" style="border-radius:16px;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary mb-3">
                    Total de Utilizadores: <?= count($users) ?>
                </h6>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-muted small">
                        <tr>
                            <th>Referência</th>
                            <th>Nome</th>
                            <th>Morada</th>
                            <th>Contadores</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user->id) ?></td>
                                    <td>
                                        <a href="#" class="text-decoration-none text-primary">
                                            <?= htmlspecialchars($user->username) ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($user->profile->address ?? 'N/A') ?></td>
                                    <td>
                                        <span class="text-success fw-semibold">
                                            <?= htmlspecialchars($user->contador_count ?? 0) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $statusText = match ($user->status ?? null) {
                                            10 => 'ACTIVE',
                                            9  => 'INACTIVE',
                                            0  => 'DELETED',
                                            default => 'UNKNOWN',
                                        };

                                        $statusClass = match ($user->status ?? null) {
                                            10 => 'text-success',
                                            9  => 'text-warning',
                                            0  => 'text-danger',
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
                                <td colspan="5" class="text-center text-muted">Nenhum utilizador encontrado.</td>
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