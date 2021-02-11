<?php
namespace App\Admin;

use App\Admin\AdminWidgetInterface;

class AdminTwigExtension extends \Twig_Extension
{
    
    /**
     * widgets
     *
     * @var mixed
     */
    private $widgets;

    public function __construct(array $widgets)
    {
        $this->widgets = $widgets;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('admin_menu', [$this, 'renderMenu'], ['is_safe' => ['html']])
        ];
    }

    public function renderMenu(): string
    {
        return array_reduce($this->widgets, function (string $html, AdminWidgetInterface $widget) {
            return $html . $widget->renderMenu();
        }, '');
    }
}
