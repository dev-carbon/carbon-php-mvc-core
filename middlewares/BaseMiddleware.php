<?php

namespace carbon42\phpmvc\middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}