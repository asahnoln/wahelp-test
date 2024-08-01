<?php

namespace src\Services;

use src\Contracts\MailClientInterface;
use src\DB\Mailing;
use src\DB\MailingRepository;
use src\DB\SentRepository;
use src\DB\UserRepository;

class MailService
{
    public function __construct(private MailClientInterface $client, private SentRepository $sentRepo)
    {

    }

    public function sendTo(UserRepository $repo, Mailing $mail): bool
    {
        foreach ($repo->all() as $user) {
            if ($this->sentRepo->has($mail, $user)) {
                continue;
            }

            $this->client->sendTo($user);
            $this->sentRepo->insert($mail, $user);
        }

        return true;
    }
}
