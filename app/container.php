<?php
$container = new \Slim\Container;

$container = $app->getContainer();

$container['db'] = function ($container)
                {
                    $setting = $container->get('settings')['db'];

                    $config = new \Doctrine\DBAL\Configuration();
                    $connectionParams = [
                        'dbname' => $setting['name'],
                        'user' => $setting['user'],
                        'password' => $setting['pass'],
                        'host' => $setting['host'],
                        'driver' => 'pdo_mysql',
                    ];

                    $connection = \Doctrine\DBAL\DriverManager::getConnection(
                        $connectionParams, $config
                    );
                    return $connection->createQueryBuilder();
                };

$container['view'] = function ($container)
                    {
                        $setting = $container->get('settings');

                        $view = new \Slim\Views\Twig(
                            $setting['view']['view_path'], $setting['view']['twig']
                        );

                        $view->addExtension(
                            new \Slim\Views\TwigExtension(
                                $container->router, $container->request->getUri()
                                )
                            );
                        $view->getEnvironment()->addGlobal('old', @$_SESSION['old']);
                        // unset($_SESSION['old']);
                        $view->getEnvironment()->addGlobal('errors', @$_SESSION['errors']);
                        // unset($_SESSION['errors']);
                        $view->getEnvironment()->addGlobal('success', @$_SESSION['success']);
                        return $view;
                    };

$container['validation'] = function ($c) {
    $setting = $c->get('settings');
    $param = $c['request']->getParams();
    $lang = $setting['lang'];

    return new \Valitron\Validator($param, [], $lang['default']);
};
