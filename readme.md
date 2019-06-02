# Рахмет Task №1
API для каталога товаров. Приложение содержит:

- Категории товаров
- Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)
- Пользователей, которые могут авторизоваться (авторизация через jwt- токены)
- **(Extra)** Фильтры к товарам
- **(Extra)** На все методы с операциями добавление/редактирование/удаление поставлена валидация ролей админа и модератора
## Installing 
##### Basic Steps
```
git clone https://github.com/iamroll/rakhmet-task
cp .env.example .env
composer update
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan jwt:secret
php artisan serve
https://www.getpostman.com/collections/6aab01f90a56ebcdf369 - Postman.
```

##Database structure

