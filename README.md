# Test task for wahelp

## How to run

### Add .env

```fish
echo 'DSN=yourDsnForPdo' > .env
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

- [] General autoloader for src and tests
- [] Dependency container for Console service
- [] Massive inserts in repositories
- [] Check for file existence when adding users
- [] Skip duplicated users
- [] Env throw error if given file does not exist
- [] Removed dupes from test
- [] Check commands in Console
