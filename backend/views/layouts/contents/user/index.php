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

                <button class="btn btn-primary rounded-4" data-bs-toggle="offcanvas" data-bs-target="#addInfoPanel" aria-controls="addInfoPanel" style="background-color:#4f46e5; border:none;">
                    <i class="fas fa-plus me-1"></i> Adicionar Utilizador
                </button>
            </div>
        </div>
        <!-- LISTA -->
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
                            <th>Tipo de Utilizador</th>
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
                                            <?php
                                                if ($user->technicianInfo === null) {
                                                    $enterpriseText = 'Morador';
                                                } else {
                                                    $enterpriseText = 'Técnico';
                                                }
                                            ?>
                                            <span class="fw-semibold">
                                                <?= htmlspecialchars($enterpriseText) ?>
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
        <!-- ---------------------------------------------- -->
        <!-- Add User Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="addInfoPanel" aria-labelledby="addInfoPanelLabel">
            <div class="offcanvas-header border-bottom">
                <h5 id="addInfoPanelLabel" class="fw-bold mb-0 text-dark">Adicionar Utilizador</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body" style="background-color:#f9fafb;">
                <div class="card border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-body">
                        <h6 class="fw-semibold text-secondary mb-3">Preencher os detalhes do novo utilizador</h6>

                        <?php $form = \yii\widgets\ActiveForm::begin([
                                'id' => 'add-user-form',
                                'options' => ['class' => 'needs-validation'],
                        ]); ?>

                        <div class="mb-3">
                            <?= $form->field($addUserModel, 'username')
                                    ->textInput(['placeholder' => 'Nome de utilizador'])
                                    ->label('Username <span class="text-danger">*</span>', ['encode' => false]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($addUserModel, 'email')
                                    ->textInput(['placeholder' => 'exemplo@dominio.com'])
                                    ->label('Email <span class="text-danger">*</span>', ['encode' => false]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($addUserModel, 'password')
                                    ->passwordInput(['placeholder' => 'Palavra-passe'])
                                    ->label('Password <span class="text-danger">*</span>', ['encode' => false]) ?>
                        </div>

                        <div class="text-end mt-4">
                            <?= \yii\helpers\Html::submitButton(
                                    '<i class="fas fa-user-plus me-1"></i> Criar Utilizador',
                                    ['class' => 'btn btn-primary px-4 py-2 rounded-3']
                            ) ?>
                        </div>

                        <?php \yii\widgets\ActiveForm::end(); ?>
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