<?php

declare(strict_types=1);

namespace App\Controller;

class HelloController extends Controller
{
    public function sayHello(array $routeParams): void
    {
        $this->renderView(
            'hello/hello.html.twig',
            [
                'name' => $routeParams['name']
            ]
        );
    }
}
