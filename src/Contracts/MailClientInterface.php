<?php

namespace src\Contracts;

use src\DB\User;

interface MailClientInterface
{
    public function sendTo(User $user): bool;
}
