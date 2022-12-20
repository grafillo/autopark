php artisan migrate
php artisan db:seed 
php artisan serve  
php artisan test

http://127.0.0.1:8000/api/gettoken?id=2 - получение токена
http://127.0.0.1:8000/api/getfreecars?class=&model=&start=2022-12-01 12:00:00&end=2022-12-16 20:16:07 - получение списка свободных машин, можно указать класс или модель
