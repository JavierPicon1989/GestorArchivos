<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/archivosGestion/frontend/web/index.php" class="brand-link">
        <span class="brand-text font-weight-light">Gestor de Archivos</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
           
            <div class="info">
                <a href="#" class="d-block"><?php 
                if(isset(Yii::$app->user->identity->username)){
                    
                       echo 'Usuario: '.Yii::$app->user->identity->username;   
                            
                }else{
                    echo "Sin logueo activo";
                   
                } ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Starter Pages',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            //['label' => 'Dashboard', 'url' => ['site/index2'], 'iconStyle' => 'far'],
                            ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    //['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    //['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    //['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Usuarios', 'icon' => 'user', 'url' => ['/usuarios']],
                    ['label' => 'Rutas', 'icon' => 'route', 'url' => ['/rbac/route']],
                    ['label' => 'Carpetas', 'icon' => 'folder', 'url' => ['/carpetas']],
                    ['label' => 'Archivos', 'icon' => 'file', 'url' => ['/archivos']],
                    
//                    ['label' => 'Menus de Permisos', 'header' => true],
//                    [
//                        'label' => 'Gestión de usuarios',
//                        'items' => [
//                            ['label' => 'Roles', 'iconStyle' => 'user', 'url' => ['/rbac/role']],
//                            ['label' => 'Permisos', 'iconStyle' => 'user', 'url' => ['/rbac/permission']],
//                            ['label' => 'Asignaciones', 'iconStyle' => 'user', 'url' => ['/rbac/assignment']],
//                           
//                        ]
//                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>