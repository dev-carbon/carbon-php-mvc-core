<?php

namespace carbon42\phpmvc;

use carbon42\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}