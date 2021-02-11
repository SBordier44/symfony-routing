<?php

declare(strict_types=1);

use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require __DIR__ . '/config/configuration.php';

try {
    $currentRoute = $matcher->match($url);

    $controller = $currentRoute['_controller'];
    $className = substr($controller, 0, strpos($controller, '@'));
    $methodName = substr($controller, strpos($controller, '@') + 1);

    $instance = new $className($twig, $urlGenerator);
    $instance->$methodName($currentRoute);
} catch (ResourceNotFoundException $e) {
    require 'templates/404.html.twig';
    return;
} catch (Exception $e) {
    var_dump($e->getMessage());
}
