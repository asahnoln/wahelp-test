<?php

namespace Helpers\Stubs;

use src\Contracts\MailClientInterface;
use src\DB\User;

class MailClient implements MailClientInterface
{
    public array $sent = [];

    public function __construct(private bool $error = false)
    {

    }

    public function sendTo(User $user): bool
    {
        if ($this->error) {
            return false;
        }

        $this->sent[] = $user;
        return true;
    }

}
