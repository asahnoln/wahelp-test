<?php

namespace Helpers\Stubs;

use src\Contracts\MailClientInterface;
use src\DB\User;

class MailClient implements MailClientInterface
{
    public array $sent = [];

    public function sendTo(User $user): bool
    {
        $this->sent[] = $user;
        return true;
    }

}
