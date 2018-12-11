<?php
namespace Omeka_s_Module_FeedImport;
return [
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH.'/modules/MetadataBrowse/view',
        ],
    ],
    'controllers' => [
        'invokables' => [
            'MetadataBrowse\Controller\Admin\Index' => 'MetadataBrowse\Controller\Admin\IndexController',
        ],
    ],
    'form_elements' => [
        'factories' => [
            'MetadataBrowse\Omeka_s_Module_FeedImport\ConfigForm' => 'MetadataBrowse\Service\Omeka_s_Module_FeedImport\ConfigFormFactory',
        ],
    ],

    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'site' => [
                        'child_routes' => [
                            'slug' => [
                                'child_routes' => [
                                    'Omeka_s_Module_FeedImport' => [
                                        'type' => \Zend\Router\Http\Literal::class,
                                        'options' => [
                                            'route' => '/Omeka_s_Module_FeedImport',
                                            'defaults' => [
                                                '__NAMESPACE__' => 'Omeka_s_Module_FeedImport\Controller\Admin',
                                                'controller' => Controller\Admin\FormController::class,
                                                'action' => 'create-site',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'Omeka_s_Module_FeedImport' => [
                        'type' => \Zend\Router\Http\Literal::class,
                        'options' => [
                            'route' => '/Omeka_s_Module_FeedImport',
                            'defaults' => [
                                '__NAMESPACE__' => 'Omeka_s_Module_FeedImport\Controller\Admin',
                                'controller' => Controller\Admin\Omeka_s_Module_FeedImportController::class,
                                'action' => 'create',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'default' => [
                                'type' => \Zend\Router\Http\Segment::class,
                                'options' => [
                                    'route' => '/:action',
                                    'constraints' => [
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ],
                                    'defaults' => [
                                        'action' => 'create',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],


    'navigation' => [
        'AdminModule' => [
            [
                'label' => 'Omeka_s_Module_FeedImport',
                'route' => 'admin/Omeka_s_Module_FeedImport',
                'resource' => 'Omeka_s_Module_FeedImport\Controller\Index',
                'pages' => [
                    [
                        'label'      => 'Import', // @translate
                        'route'      => 'admin/Omeka_s_Module_FeedImport',
                        'resource'   => 'Omeka_s_Module_FeedImport\Controller\Index',
                    ],
                ],
            ],
        ],
    ],

];
