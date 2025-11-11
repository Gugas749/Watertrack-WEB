<?php
/** @var yii\bootstrap5\ActiveForm $form */
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/user-index.css', ['depends' => [\yii\bootstrap4\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/user-index.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">
        <!-- NAVIGATION? -->
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Utilizadores</h4>
            <div class="d-flex align-items-center gap-3">
                <!-- Search -->
                <div class="input-group mx-5" style="width:220px;">
                    <?php $form = ActiveForm::begin([
                            'method' => 'get',
                            'action' => ['user/index'],
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
                    <i class="fas fa-plus me-1"></i> Adicionar Utilizador
                </button>
            </div>
        </div>
        <!-- USER LIST -->
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
                                        $enterpriseText = $user->technicianInfo === null ? 'Morador' : 'Técnico';
                                        ?>
                                        <span class="fw-semibold"><?= htmlspecialchars($enterpriseText) ?></span>
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
                                        <button class="text-primary fw-semibold" data-toggle="detail-panel">Ver Detalhes</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Nenhum utilizador encontrado.</td>
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
                <h5 class="mb-0 fw-bold text-dark">Adicionar Utilizador</h5>
                <button type="button" class="btn btn-sm btn-light" id="closeRightPanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-3">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'add-user-form',
                        'action' => ['user/createuser'],
                        'method' => 'post',
                ]); ?>
                <?= $form->field($addUserModel, 'username')->textInput(['placeholder' => 'Username', 'autofocus' => true]) ?>
                <?= $form->field($addUserModel, 'email')->textInput(['placeholder' => 'Email']) ?>
                <?= $form->field($addUserModel, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                <div class="text-end mt-3">
                    <?= \yii\helpers\Html::submitButton('Criar Utilizador', ['class' => 'btn btn-primary', 'name' => 'createuser-button']) ?>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
        <!-- DETAIL PANEL -->
        <div id="detailPanel" class="detail-panel bg-white shadow" style="display:none;">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4" style="background-color:#fff">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">Detalhes do Utilizador</h5>
                    <button type="button" class="closeDetailPanel btn btn-sm btn-light">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-start align-items-center mb-4">
                    <span class="badge bg-success rounded-pill px-3 py-2">Ativo</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small text-muted">Referência</label>
                        <input type="text" class="form-control rounded-3" value="123" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small text-muted">Nome</label>
                        <input type="text" class="form-control rounded-3" value="João Silva" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small text-muted">Tipo de Utilizador</label>
                        <input type="text" class="form-control rounded-3" value="Técnico" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Email</label>
                        <input type="text" class="form-control rounded-3" value="joao@exemplo.pt" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Morada</label>
                        <input type="text" class="form-control rounded-3" value="Rua das Flores, 45" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Data de Registo</label>
                        <input type="text" class="form-control rounded-3" value="10/01/2023" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Último Acesso</label>
                        <input type="text" class="form-control rounded-3" value="05/11/2025" readonly>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 gap-2">
                    <button type="button" class="closeDetailPanel btn btn-light rounded-4 px-4">Fechar</button>
                    <button type="button" class="btn btn-primary rounded-4 px-4" style="background-color:#4f46e5; border:none;">Editar</button>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div id="overlay"></div>
    </div>
</div>