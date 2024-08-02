<?php

namespace src\Services;

use src\DB\MailRepository;
use src\DB\Mailing;
use src\DB\SentRepository;
use src\DB\UserRepository;

class Console
{
    public function __construct(
        private UserRepository $userRepo,
        private MailRepository $mailRepo,
        private SentRepository $sentRepo,
        private MailService $mailService,
    ) {
    }

    public function run(array $argv): void
    {
        if ($argv[1] == 'sendMails') {
            foreach ($this->mailRepo->all() as $m) {
                $this->mailService->sendTo($this->userRepo, $m);
            }
            return;
        }

        $file = fopen($argv[2], 'r');
        $this->userRepo->saveFromCsvFile($file);
    }
}
