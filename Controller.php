<?php

namespace carbon42\phpmvc;

use carbon42\phpmvc\middlewares\BaseMiddleware;

class Controller
{

    public string   $layout = 'default';
    public string   $action = '';
    /**
     * @var \carbon42\phpmvc\middlewares\BaseMiddleware[]
     */
    protected array    $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}