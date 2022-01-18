<?php

namespace carbon42\phpmvc\exceptions;

class NotFoundException extends \Exception
{
    protected   $message = 'Page not found';
    protected   $code = 404;
}