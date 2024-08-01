<?php

namespace src\Services;

use src\Contracts\MailClientInterface;
use src\DB\UserRepository;

class MailService
{
    public function __construct(protected MailClientInterface $client)
    {

    }

    public function sendTo(UserRepository $repo)
    {
        foreach ($repo->all() as $user) {
            $this->client->sendTo($user);
        }

        return true;
    }
}
