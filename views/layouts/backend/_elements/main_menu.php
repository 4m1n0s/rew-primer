

<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        
        
        <?php
            echo yii\widgets\Menu::widget([
                'encodeLabels' => false,
                'activateParents' => true,
                'submenuTemplate' => "\n<ul class=\"sub-menu\">\n{items}\n</ul>\n",
                'options' => [
                    'class' => 'page-sidebar-menu  page-header-fixed',
                    'data-auto-scroll' => 'true',
                    'data-slide-speed' => 200,
                    'style' => 'padding-top: 20px',
                    'data-keep-expanded' => false,
                ],
                'items' => [
                    [
                        'label' => '<h3 class="uppercase">' . Yii::t('app', 'Pages') . '</h3>',
                        'linkTemplate' => '{label}',
                        'options' => [
                            'class' => 'heading start'
                        ],
                    ],
                    [
                        'label' => '<i class="fa fa-newspaper-o"></i> <span class="title"> ' . Yii::t('app', 'Home Page') . '</span>',
                        'url' => ['/page/index-backend/index'],
                    ],
                    [
                        'label' => '<i class="fa fa-file"></i> <span class="title"> ' . Yii::t('app', 'Static Pages') . '</span>',
                        'url' => ['/page/index-backend/index'],
                    ],
                    [
                        'label' => '<h3 class="uppercase">Videos</h3>',
                        'linkTemplate' => '{label}',
                        'options' => [
                            'class' => 'heading'
                        ],
                    ],
                    [
                        'label' => '<i class="fa fa-film"></i> <span class="title"> ' . Yii::t('app', 'Manage videos') . '</span>',
                        'url' => ['/video/index-backend/index'],
                    ],
                    [
                        'label' => '<i class="fa fa-sitemap"></i> <span class="title"> ' . Yii::t('app', 'Categories') . '</span>',
                        'url' => ['/video/category-backend/index'],
                    ],
                    [
                        'label' => '<i class="fa fa-sitemap"></i> <span class="title"> ' . Yii::t('app', 'Channels') . '</span>',
                        'url' => ['/video/channel-backend/index'],
                    ],
                ]
                ]);
        ?>
        
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>