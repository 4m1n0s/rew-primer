

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
        $module = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;

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
                        'label' => '<i class="icon-home"></i> <span class="title"> ' . Yii::t('app', 'Dashboard') . '</span>',
                        'url' => ['/dashboard/index-backend/index'],
                        'options' => [
                            'class' => 'start'
                        ],
                    ],

                    [
                        'label' => '<i class="fa fa-users"></i> <span class="title"> ' . Yii::t('app', 'Users') . '</span>',
                        'url' => ['/user/index-backend/index'],
                    ],

                    [
                        'label' => '<i class="fa fa-user-plus"></i> <span class="title"> ' . Yii::t('app', 'Invites') . '</span><span class="badge badge-info">' . \app\modules\invitation\widgets\CountWidget::widget(['status' => \app\modules\invitation\models\Invitation::STATUS_NEW]) . '</span>',
                        'url' => ['/invitation/index-backend/index'],
                    ],

                    [
                        'label' => '<i class="fa fa-envelope-o"></i> <span class="title"> ' . Yii::t('app', 'Contact Messages') . '</span><span class="badge badge-info">' . \app\modules\contact\widgets\CountWidget::widget(['status' => \app\modules\contact\models\Contact::STATUS_NEW]) . '</span>',
                        'url' => ['/contact/index-backend/index'],
                        'active' => $module == 'contact' && $controller == 'index-backend'
                    ],

                    [
                        'label' => '<i class="fa fa-gear"></i> <span class="title"> ' . Yii::t('app', 'Settings') . '</span>',
                        'url' => ['/settings/index-backend/index'],
                    ],

                ]
                ]);
        ?>
        
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>