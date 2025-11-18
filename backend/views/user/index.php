<?php
/** @var yii\bootstrap5\ActiveForm $form */
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;


$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/views-index.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/main-index.js', ['depends' => [\yii\bootstrap5\BootstrapPluginAsset::class]]);
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
                    <i class="fas fa-plus me-1"></i> Adicionar Utilizador
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
                                        <?= htmlspecialchars($user->username) ?>
                                    </td>
                                    <td><?= htmlspecialchars($user->profile->address ?? 'N/A') ?></td>
                                    <td>
                                        <?php
                                        $enterpriseText = count($user->technicianinfos) === 0 ? 'Morador' : 'Técnico';
                                        ?>
                                        <?= htmlspecialchars($enterpriseText) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $statusText = match ($user->status ?? null) {
                                            10 => 'ATIVO',
                                            9  => 'INATIVO',
                                            0  => 'DESATIVADO',
                                            default => 'DESCONHECIDO',
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
                                        <?= Html::button('Ver Detalhes', [
                                                'class' => 'btn btn-outline-primary btn-sm fw-semibold shadow-sm',
                                                'onclick' => "window.location.href='" . Url::to(['user/index', 'id' => $user->id]) . "'",
                                                'style' => 'transition: all 0.2s ease-in-out;',
                                                'onmouseover' => "this.style.transform='scale(1.05)';",
                                                'onmouseout' => "this.style.transform='scale(1)';"
                                        ]) ?>
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
        <!-- RIGHT ADD PANEL -->
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
                        'action' => ['user/create'],
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
        <?php if ($detailUser): ?>
            <div id="detailPanel" class="detail-panel bg-white shadow show">
                <div class="modal-content border-0 shadow-lg rounded-4 p-4" style="background-color:#fff">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Detalhes do Utilizador</h5>
                        <button type="button" class="closeDetailPanel btn btn-sm btn-light">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <?php
                        $statusClass = match ($detailUser->status ?? null) {
                            10 => 'bg-success',
                            9  => 'bg-warning',
                            0  => 'bg-danger',
                            default => 'bg-secondary',
                        };
                        $statusText = match ($detailUser->status ?? null) {
                            10 => 'Ativo',
                            9  => 'Inativo',
                            0  => 'Desativado',
                            default => 'Desconhecido',
                        };
                        ?>
                        <span class="badge <?= $statusClass ?> px-3 py-2"><?= $statusText ?></span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-muted">Referência</label>
                            <input type="text" class="form-control rounded-3" value="<?= htmlspecialchars($detailUser->id) ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-muted">Nome</label>
                            <input type="text" class="form-control rounded-3" value="<?= htmlspecialchars($detailUser->username) ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-muted">Tipo de Utilizador</label>
                            <?php
                            $type = count($detailUser->technicianinfos) === 0 ? 'Morador' : 'Técnico';
                            ?>
                            <input type="text" class="form-control rounded-3" value="<?= $type ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted">Email</label>
                            <input type="text" class="form-control rounded-3" value="<?= htmlspecialchars($detailUser->email) ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted">Morada</label>
                            <input type="text" class="form-control rounded-3" value="<?= htmlspecialchars($detailUser->profile->address ?? 'N/A') ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted">Data de Registo</label>
                            <input type="text" class="form-control rounded-3" value="<?= Yii::$app->formatter->asDate($detailUser->created_at) ?>" readonly>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted">Último Update</label>
                            <input type="text" class="form-control rounded-3" value="<?= Yii::$app->formatter->asDate($detailUser->updated_at ?? 'N/A') ?>" readonly>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="closeDetailPanel btn btn-light px-4">Fechar</button>
                        <button type="button" class="btn btn-primary px-4" style="background-color:#4f46e5; border:none;">Editar</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--ATIVAR O DETAIL PANEL -->
        <?php if ($detailUser): ?>
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