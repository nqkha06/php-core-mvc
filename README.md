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

1. Tao database va bang:

```sql
SOURCE database.sql;
```

2. Cap nhat thong tin ket noi trong `config/database.php`.

3. Chay Apache/PHP va tro document root vao thu muc `public/`.
php -S localhost:8000 -t public

## Tai khoan admin mac dinh

- Email: `admin@example.com`
- Password: `admin123`
