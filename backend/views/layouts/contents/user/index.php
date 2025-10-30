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
                <h6 class="fw-bold text-secondary mb-3">Total de Utilizadores: 69</h6>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-muted small">
                        <tr>
                            <th>Referência</th>
                            <th>Nome</th>
                            <th>Morada</th>
                            <th>Contadores</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#" class="text-decoration-none text-primary">Joao</a></td>
                            <td>R. Dr. Duarte Álvares Abreu 21</td>
                            <td><span class="text-success fw-semibold">0</span></td>
                            <td><a href="#" class="text-primary fw-semibold">Ver Detalhes</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="#" class="text-decoration-none text-primary">Pedro</a></td>
                            <td>R. Dr. Duarte Álvares Abreu 21</td>
                            <td><span class="text-success fw-semibold">15</span></td>
                            <td><a href="#" class="text-primary fw-semibold">Ver Detalhes</a></td>
                        </tr>
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