

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
                        'label' => '<i class="fa fa-envelope-o"></i> <span class="title"> ' . Yii::t('app', 'Contact Messages') . '</span>',
                        'url' => ['/contact/index-backend/index'],
                        'active' => $module == 'contact' && $controller == 'index-backend'
                    ],

                    [
                        'label' => '<i class="fa fa-cubes"></i> <span class="title"> ' . Yii::t('app', 'Offers') . '</span></span><span class="arrow"></span>',
                        'url' => 'javascript:;',
                        'template' => '<a href="{url}" class="nav-link nav-toggle">{label}</a>',
                        'options' => [
                            'class' => 'nav-item'
                        ],
                        'items' => [
                            'options' => [
                                'class' => 'sub-menu'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'OfferWalls'),
                                'url' => ['/offer/backend-offer/index'],
                                'active' => $module == 'offer' && $controller == 'backend-offer'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Categories'),
                                'url' => ['/offer/backend-category/index'],
                                'active' => $module == 'offer' && $controller == 'backend-category',
                            ],
                        ]
                    ],

                    [
                        'label' => '<i class="fa fa-list"></i> <span class="title"> ' . Yii::t('app', 'Catalog') . '</span></span><span class="arrow"></span>',
                        'url' => 'javascript:;',
                        'template' => '<a href="{url}" class="nav-link nav-toggle">{label}</a>',
                        'options' => [
                            'class' => 'nav-item'
                        ],
                        'items' => [
                            'options' => [
                                'class' => 'sub-menu'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Orders'),
                                'url' => ['/catalog/backend-order/index'],
                                'active' => $module == 'catalog' && $controller == 'backend-order',
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Products'),
                                'url' => ['/catalog/backend-product/index'],
                                'active' => $module == 'catalog' && $controller == 'backend-product'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Product Groups'),
                                'url' => ['/catalog/backend-product-group/index'],
                                'active' => $module == 'catalog' && $controller == 'backend-product-group'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Group Categories'),
                                'url' => ['/catalog/backend-category-group/index'],
                                'active' => $module == 'catalog' && $controller == 'backend-category-group',
                            ],
                        ]
                    ],

                    [
                        'label' => '<i class="fa fa-users"></i> <span class="title"> ' . Yii::t('app', 'Users') . '</span></span><span class="arrow"></span>',
                        'url' => 'javascript:;',
                        'template' => '<a href="{url}" class="nav-link nav-toggle">{label}</a>',
                        'options' => [
                            'class' => 'nav-item'
                        ],
                        'items' => [
                            'options' => [
                                'class' => 'sub-menu'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Manage Users'),
                                'url' => ['/user/index-backend/index'],
                                'active' => $module == 'user' && $controller == 'index-backend'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Manage Groups'),
                                'url' => ['/user/user-group-backend/index'],
                                'active' => $module == 'user' && $controller == 'user-group-backend'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Invite Requests'),
                                'url' => ['/invitation/index-backend/index'],
                                'active' => $module == 'invitation' && $controller == 'index-backend'
                            ],
                        ]
                    ],

                    [
                        'label' => '<i class="icon-layers"></i> <span class="title"> ' . Yii::t('app', 'Templates') . '</span></span><span class="arrow"></span>',
                        'url' => 'javascript:;',
                        'template' => '<a href="{url}" class="nav-link nav-toggle">{label}</a>',
                        'options' => [
                            'class' => 'nav-item'
                        ],
                        'items' => [
                            'options' => [
                                'class' => 'sub-menu'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Pages'),
                                'url' => ['/pages/backend-page/index'],
                                'active' => $module == 'pages' && $controller == 'backend-page'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Emails'),
                                'url' => ['/core/backend-email-template'],
                                'active' => $module == 'core' && $controller == 'backend-email-template'
                            ],
                        ]
                    ],

                    [
                        'label' => '<i class="fa fa-gear"></i> <span class="title"> ' . Yii::t('app', 'Settings') . '</span></span><span class="arrow"></span>',
                        'url' => 'javascript:;',
                        'template' => '<a href="{url}" class="nav-link nav-toggle">{label}</a>',
                        'options' => [
                            'class' => 'nav-item'
                        ],
                        'items' => [
                            'options' => [
                                'class' => 'sub-menu'
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'General'),
                                'url' => ['/settings/index-backend/index'],
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Security'),
                                'url' => ['/settings/index-backend/security'],
                                'active' => $module == 'settings' && $controller == 'index-backend' && $action == 'security',
                            ],
                            [
                                'label' => '<i class="fa fa-table"></i> ' . Yii::t('app', 'Social'),
                                'url' => ['/settings/index-backend/social'],
                                'active' => $module == 'settings' && $controller == 'index-backend' && $action == 'social',
                            ],
                        ]
                    ],
                ]
            ]);
        ?>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>