## Jak uruchomić

Co trzeba dodać do .env dla przykładu
```bash
MAILER_DSN=smtp://localhost
MAILER_FROM='janek@localhost.pl'

DATABASE_URL="mysql://root:root@mysql:3306/ToDoList?serverVersion=8&charset=utf8mb4"
```


```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate


```
Do wysłania maila uruchomić kolejno
```bash
php bin/console messenger:consume async
```

