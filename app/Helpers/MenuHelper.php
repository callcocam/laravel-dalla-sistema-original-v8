<?php


namespace App\Helpers;


class MenuHelper extends \ArrayObject
{

    protected $menus = [];

    public function __construct($input = array(), $flags = 0, $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
    }

    public static function make()
    {

        $menu = new static(
            [
                'dash' => [
                    'permissions' => ['admin.admin.index'],
                    'route' => 'admin.admin.index',
                    'icon' => 'i-Dashboard',
                    'label' => 'Painel',
                    'submenu' => null,
                ],
                'orders' => [
                    'permissions' => ['admin.products.index','admin.orders.index'],
                    'route' => null,
                    'icon' => 'i-Shopping-Cart',
                    'label' => 'Pedidos',
                    'submenu' => [
                        [
                            'route' => 'admin.products.index',
                            'label' => 'Produtos',
                        ],
                        [
                            'route' => 'admin.orders.index',
                            'label' => 'Pedidos',
                        ],
                        [
                            'route' => 'admin.products-manage-stoque.index',
                            'label' => 'Pedidos/Estoque',
                        ],
//                        [
//                            'route' => 'admin.history-barrels.index',
//                            'label' => 'Histórico',
//                        ]
                    ],
                ],
//                'supports' => [
//                    'permissions' => ['admin.supports-material.index','admin.supports-orders.index'],
//                    'route' => null,
//                    'icon' => 'i-Shopping-Cart',
//                    'label' => 'Material de apoio',
//                    'submenu' => [
//                        [
//                            'route' => 'admin.supports-material.index',
//                            'label' => 'Material de apoio',
//                        ],
//                        [
//                            'route' => 'admin.supports-orders.index',
//                            'label' => 'Pedidos',
//                        ],
//                    ],
//                ],
                'settings' => [
                    'permissions' => ['admin.settings.setting'],
                    'route' => 'admin.settings.setting',
                    'icon' => 'i-Gear-2',
                    'label' => 'Configuração',
                    'submenu' => null,
                ],
                'operacional' => [
                    'permissions' => ['admin.roles.index', 'admin.permissions.index', 'passport-clients', 'passport-authorized-clients', 'passport-personal-access-tokens'],
                    'route' => null,
                    'icon' => 'i-Lock-User',
                    'label' => 'Operacional',
                    'submenu' => [
                        [
                            'route' => 'admin.roles.index',
                            'label' => 'Papéis',
                        ],
                        [
                            'route' => 'admin.permissions.index',
                            'label' => 'Permissões',
                        ],
                        [
                            'route' => 'passport-personal-access-tokens',
                            'label' => 'P. Access token',
                            'title' => 'Personal access token',
                        ]
                    ],
                ],
                'users' => [
                    'permissions' => ['admin.users.index'],
                    'route' => 'admin.users.index',
                    'icon' => 'i-Add-User',
                    'label' => 'Usuários',
                    'submenu' => null,
                ],
                'clients' => [
                    'permissions' => ['admin.clients.index'],
                    'route' => 'admin.clients.index',
                    'icon' => 'i-Checked-User',
                    'label' => 'Clientes',
                    'submenu' => null,
                ],
                'drivers' => [
                    'permissions' => ['admin.drivers.index'],
                    'route' => 'admin.drivers.index',
                    'icon' => 'i-Truck',
                    'label' => 'Logística/Entrega',
                    'submenu' => null,
                ],
//                'lendings' => [
//                    'permissions' => ['admin.lendings.index'],
//                    'route' => 'admin.lendings.index',
//                    'icon' => 'i-Search-on-Cloud',
//                    'label' => 'Comodata',
//                    'submenu' => null,
//                ],
                'posts' => [
                    'permissions' => ['admin.posts.index'],
                    'route' => 'admin.posts.index',
                    'icon' => 'i-Communication-Tower',
                    'label' => 'Notificações',
                    'submenu' => null,
                ],
                'downloads' => [
                    'permissions' => ['admin.downloads.index'],
                    'route' => 'admin.downloads.index',
                    'icon' => 'i-Download',
                    'label' => 'Downloads',
                    'submenu' => null,
                ],
                'events' => [
                    'permissions' => ['admin.events-next.index','admin.events-last.index','admin.tasks.index'],
                    'route' => null,
                    'icon' => 'i-Calendar-2',
                    'label' => 'Eventos',
                    'submenu' => [
                        [
                            'route' => 'admin.events-next.index',
                            'label' => 'Últimos Eventos',
                        ],
                        [
                            'route' => 'admin.events-last.index',
                            'label' => 'Próximos Eventos',
                        ],
                        [
                            'route' => 'admin.tasks.index',
                            'label' => 'Tarefas',
                        ],
                    ],
                ],
                'visits-distributors' => [
                    'permissions' => ['admin.visits-distributors.index'],
                    'route' => 'admin.visits-distributors.index',
                    'icon' => 'i-Search-People',
                    'label' => 'Visitas',
                    'submenu' => null,
                ],
//                'barrels.client' => [
//                    'permissions' => ['admin.barrels.client.index'],
//                    'route' => 'admin.barrels.client.index',
//                    'icon' => 'i-Search-People',
//                    'label' => 'Items/Comodata',
//                    'submenu' => null,
//                ],
                'metas' => [
                    'permissions' => ['admin.metas.index'],
                    'route' => 'admin.metas.index',
                    'icon' => 'i-Bar-Chart-2',
                    'label' => 'Metas',
                    'submenu' => null,
                ]
            ]
        );


        return $menu;
    }

    public function getMenus()
    {

        return $this->getArrayCopy();
    }
}
