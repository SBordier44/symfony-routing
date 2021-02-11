<?php

declare(strict_types=1);

use App\AnnotationLoader\ControllerAnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Loader\AnnotationDirectoryLoader;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

$twig = new Environment(new FilesystemLoader([__DIR__ . '/../templates']));

$fileLocator = new FileLocator([__DIR__]);
$routesYamlLoader = new YamlFileLoader($fileLocator);
$routesCollection = $routesYamlLoader->load('routes.yml');

$annotationsLoader = new AnnotationDirectoryLoader(
    new FileLocator([__DIR__ . '/../src/Controller']),
    new ControllerAnnotationLoader(new AnnotationReader())
);
$annotationsRoutesCollection = $annotationsLoader->load(__DIR__ . '/../src/Controller');

$routesCollection->addCollection($annotationsRoutesCollection);

$url = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];
$requestContext = new RequestContext($_SERVER['PATH_INFO'] ?? '/', $_SERVER['REQUEST_METHOD']);
$matcher = new UrlMatcher($routesCollection, $requestContext);

$urlGenerator = new UrlGenerator($routesCollection, new RequestContext());
