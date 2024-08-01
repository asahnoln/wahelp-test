<?php

namespace src\DB;

class SentRepository extends BaseRepository
{
    protected string $table = 'sent_mailing';

    public function has(Mailing $mail, User $user): bool
    {
        $q = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->table} WHERE mailing_id = ? AND user_id = ?");
        $q->execute([$mail->id, $user->id]);

        return $q->fetchColumn();
    }

    public function insert(Mailing $mail, User $user): bool
    {
        $q = $this->pdo->prepare("INSERT INTO {$this->table} (mailing_id, user_id) VALUES (?, ?)");
        return $q->execute([$mail->id, $user->id]);
    }
}
