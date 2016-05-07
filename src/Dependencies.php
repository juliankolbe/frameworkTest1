<?php

$injector = new \Auryn\Injector;

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

$injector->alias('FrameworkTest\Template\Renderer', 'FrameworkTest\Template\MustacheRenderer');
$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
            'extension' => '.html',
        ]),
    ],
]);

$injector->define('FrameworkTest\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

$injector->alias('FrameworkTest\Page\PageReader', 'FrameworkTest\Page\FilePageReader');
$injector->share('FrameworkTest\Page\FilePageReader');


return $injector;