# Test task for wahelp

Only happy path is implemented currently. Unhappy path is implemented partially.

## How to run

### Prepare DB

Sqlite example:

```sql
CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT);
CREATE TABLE mailings (id INTEGER PRIMARY KEY, name TEXT);
CREATE TABLE sent_mailings (id INTEGER PRIMARY KEY, mailing_id INTEGER, user_id INTEGER);
```

### Add .env

Sqlite example:

```fish
echo 'DSN=sqlite:db.sq3' > .env
```

### Add users to DB

```fish
php main.php addUsersFrom path/to/users.csv
```

### Send mails

```fish
php main.php sendMails
```

### Tests

```fish
php tests/main.php
```

## Improvements to make

- [ ] Massive inserts in repositories
- [ ] Dependency container for Console service
- [ ] Check for file existence when adding users
- [ ] Skip duplicated users when adding them to DB
- [ ] Env throw error if given file does not exist
- [ ] Check commands in Console
- [ ] Transactions for repositories, race conditions
