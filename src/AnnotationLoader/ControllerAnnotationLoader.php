<?php

declare(strict_types=1);

namespace App\AnnotationLoader;

use ReflectionClass;
use ReflectionMethod;
use Symfony\Component\Routing\Loader\AnnotationClassLoader;
use Symfony\Component\Routing\Route;

class ControllerAnnotationLoader extends AnnotationClassLoader
{
    protected function getDefaultRouteName(ReflectionClass $class, ReflectionMethod $method): void
    {
    }

    protected function configureRoute(
        Route $route,
        ReflectionClass $class,
        ReflectionMethod $method,
        object $annot
    ): void {
        $className = $method->class;
        $methodName = $method->name;
        $_controller = "$className@$methodName";

        $route->addDefaults(
            [
                '_controller' => $_controller
            ]
        );
    }
}
