# Test task for wahelp

## How to run

### Add users to DB

```fish
php main.php addUsersFrom path/to/users.csv
```

### Send mails

```fish
php main.php sendMails
```

## Improvements to make

- [] Massive inserts in repositories
- [] Dependency container for Console service
- [] Check for file existence when adding users
- [] Skip duplicated users
