<?php

namespace App\Admin;

use Framework\Module;
use Framework\Router;
use App\Admin\DashboardAction;
use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRenderer;
use App\Admin\AdminTwigExtension;

class AdminModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';

    public function __construct(
        RendererInterface $renderer,
        Router $router,
        AdminTwigExtension $adminTwigExtension,
        string $prefix
    ) {
        $renderer->addPath('admin', __DIR__ . '/views');
        $router->get($prefix, DashboardAction::class, 'admin');
        if ($renderer instanceof TwigRenderer) {
            $renderer->getTwig()->addExtension($adminTwigExtension);
        }
    }
}
