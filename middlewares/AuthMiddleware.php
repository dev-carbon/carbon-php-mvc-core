<?php

namespace carbon42\phpmvc\middlewares;

use carbon42\phpmvc\Application;
use carbon42\phpmvc\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{

    public array    $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}