<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Twig\Environment;

abstract class Controller
{
    public function __construct(protected Environment $twig, protected UrlGenerator $urlGenerator)
    {
    }

    protected function renderView(string $path, array $variables = []): void
    {
        $variables['urlGenerator'] = $this->urlGenerator;
        $this->twig->display($path, $variables);
    }
}
