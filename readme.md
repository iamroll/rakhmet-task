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
<img src="https://user-images.githubusercontent.com/27915539/58758913-69c06e80-8544-11e9-855e-0b0c26905167.PNG" width="250" height="300">

## Database structure

<img src="https://user-images.githubusercontent.com/27915539/58758982-2a465200-8545-11e9-85d8-a3588e9a8530.PNG" width="550" height="300">
