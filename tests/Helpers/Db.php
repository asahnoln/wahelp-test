<?php

namespace Helpers;

use PDO;

class Db
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite::memory:');
    }

    public function createUsers(): void
    {
        $this->pdo->query('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT)');
    }

    public function createMailings(): void
    {
        $this->pdo->query('CREATE TABLE mailing (id INTEGER PRIMARY KEY, name TEXT)');
    }

    public function createSentMailings(): void
    {
        $this->pdo->query('CREATE TABLE sent_mailing (id INTEGER PRIMARY KEY, mailing_id INTEGER, user_id INTEGER)');
    }

    public function drop(): void
    {
        $this->pdo->query('DROP TABLE users');
        $this->pdo->query('DROP TABLE mailing');
        $this->pdo->query('DROP TABLE sent_mailing');
    }
}
