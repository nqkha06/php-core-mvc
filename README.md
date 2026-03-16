# PHP Core MVC User Management

Du an mau su dung PHP Core khong framework, to chuc theo mo hinh MVC, router don gian bang `public/index.php`, session cho dang nhap va PDO cho MySQL.

## Cau truc

```text
project/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── config/
│   └── database.php
├── core/
│   ├── Controller.php
│   ├── Router.php
│   └── helpers.php
├── public/
│   ├── assets/
│   ├── .htaccess
│   └── index.php
├── database.sql
└── routes.php
```

## Cach chay

1. Tao file env tu file mau:

```bash
cp .env.example .env
```

Neu dung Windows CMD:

```bat
copy .env.example .env
```

2. Mo file [`.env`](/Users/qkha/Documents/projects/PHP-CORE/quan-ly-chi-tieu/.env) va cap nhat thong tin ket noi MySQL:

```ini
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=php_core_expense
DB_USERNAME=root
DB_PASSWORD=
```

3. Tao database va import bang:

```sql
SOURCE database.sql;
```

4. Start project:

```bash
php -S localhost:8000 -t public
```

5. Mo trinh duyet:

```text
http://localhost:8000
```

## Tai khoan admin mac dinh

- Email: `admin@example.com`
- Password: `admin123`
