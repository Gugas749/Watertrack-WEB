<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="../../web/assets/upload/images/logo_WaterTrack.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">WaterTrack</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column justify-content-between">

        <!-- Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'options' => [
                    'class' => 'nav nav-pills nav-sidebar flex-column nav-legacy',
                    'data-widget' => 'treeview',
                    'role' => 'menu'
                ],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['dashboard/index']],
                    ['label' => 'Utilizadores', 'icon' => 'users', 'url' => ['users/index']],
                    ['label' => 'Contadores', 'icon' => 'tint', 'url' => ['contadores/index']],
                    ['label' => 'Leituras', 'icon' => 'book-open', 'url' => ['leituras/index']],
                    ['label' => 'Definições', 'icon' => 'cog', 'url' => ['settings/index']],
                ],
            ]);
            ?>
        </nav>


        <!-- Painel do utilizador fixo ao fundo -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-top pt-3">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Habibi</a>
            </div>
        </div>
    </div>
</aside>
