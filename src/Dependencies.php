<?php

$injector = new \Auryn\Injector;


// HTTP Component
$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');


// Template Engine
$injector->alias('FrameworkTest\Template\Renderer', 'FrameworkTest\Template\TwigRenderer');

// Mustache file endings
$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
            'extension' => '.html',
        ]),
    ],
]);

// Twig special needs
$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});
// Frontend Twig Renderer
$injector->alias('FrameworkTest\Template\FrontendRenderer', 'FrameworkTest\Template\FrontendTwigRenderer');

// Menu Reader
$injector->alias('FrameworkTest\Menu\MenuReader', 'FrameworkTest\Menu\ArrayMenuReader');
$injector->share('FrameworkTest\Menu\ArrayMenuReader');


// Page Reader
$injector->define('FrameworkTest\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);
$injector->alias('FrameworkTest\Page\PageReader', 'FrameworkTest\Page\FilePageReader');
$injector->share('FrameworkTest\Page\FilePageReader');


return $injector;