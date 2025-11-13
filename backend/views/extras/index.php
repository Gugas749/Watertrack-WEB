<?php
/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Extras';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/user-index.css', ['depends' => [\yii\bootstrap4\BootstrapAsset::class]]);
$this->registerJsFile('@web/js/user-index.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="content">
    <div class="container-fluid py-4" style="background-color:#f9fafb; min-height:100vh;">
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <h4 class="fw-bold text-dark">Extras</h4>
            <div class="d-flex align-items-center gap-3">
                <div class="input-group mx-5" style="width:220px;">
                    <?php $form = ActiveForm::begin([
                            'method' => 'get',
                            'action' => ['index'],
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
                <button class="btn btn-primary rounded-4"
                        data-toggle="right-panel"
                        style="background-color:#4f46e5; border:none;">
                    <i class="fas fa-plus me-1"></i> Adicionar Tipo de Contador
                </button>
            </div>
        </div>

        <div class="card shadow-sm border-0 mx-3" style="border-radius:16px;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary mb-3">
                    Total de Tipo de Contadores: <?= count($meterTypes) ?>
                </h6>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-muted small">
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($meterTypes)): ?>
                            <?php foreach ($meterTypes as $meterType): ?>
                                <tr>
                                    <td><?= htmlspecialchars($meterType->id) ?></td>
                                    <td><?= htmlspecialchars($meterType->description) ?></td>
                                    <td>
                                        <?= Html::a('Ver Detalhes', ['extras/index', 'id' => $meterType->id],
                                                ['class' => 'text-primary fw-semibold text-decoration-none']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">Nenhum extra encontrado.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="rightPanel" class="right-panel bg-white shadow" style="display:none;">
            <div class="right-panel-header d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 class="mb-0 fw-bold text-dark">Adicionar Tipo de Contador</h5>
                <button type="button" class="btn btn-sm btn-light" id="closeRightPanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-3">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'add-extra-form',
                        'action' => ['create'],
                        'method' => 'post',
                ]); ?>
                <?= $form->field($addMeterTypeModel, 'description')->textInput(['placeholder' => 'Descrição', 'autofocus' => true]) ?>
                <div class="text-end mt-3">
                    <?= \yii\helpers\Html::submitButton('Criar Tipo de Contador', ['class' => 'btn btn-primary', 'name' => 'create-extra-button']) ?>
                </div>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>

        <?php if ($detailMeterTypes): ?>
            <div id="detailPanel" class="detail-panel bg-white shadow show">
                <div class="modal-content border-0 shadow-lg rounded-4 p-4" style="background-color:#fff">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Detalhes do Tipo de Contador</h5>
                        <button type="button" class="closeDetailPanel btn btn-sm btn-light">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-muted">ID</label>
                            <input type="text" class="form-control rounded-3" value="<?= htmlspecialchars($detailMeterTypes->id) ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-muted">Descrição</label>
                            <input type="text" class="form-control rounded-3" value="<?= htmlspecialchars($detailMeterTypes->description) ?>" readonly>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="closeDetailPanel btn btn-light rounded-4 px-4">Fechar</button>
                        <button type="button" class="btn btn-primary rounded-4 px-4" style="background-color:#4f46e5; border:none;">Editar</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($detailMeterTypes): ?>
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

        <div id="overlay"></div>
    </div>
</div>
