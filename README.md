# vigrom
Vigrom test task

Инструкциия по установке:

1. При помощи Docker
- Cклонировать из репозитория:

`git clone https://github.com/soper/vigrom.git`

- Перейти в корень проекта:

`cd vigrom`

- Установить проект с помощью Composer

`composer install`

- Создать в корне файл .env и прописать доступы к БД Postgresql на основе файла .env.dist

- Запустить Docker контейнеры:

`sudo docker-compose up -d --build`

- Запустить миграции:

`sudo docker-compose exec app vendor/bin/yii migrate/up --appconfig=config/config.php`


2. Без помощи Docker

- Cклонировать из репозитория:

`git clone https://github.com/soper/vigrom.git`

- Перейти в корень проекта:

`cd vigrom`

- Установить проект с помощью Composer

`composer install`

- Настроить Document Root Web сервера на папку web

- Создать базу данных Postgresql 

- Создать в корне файл .env и прописать доступы к БД Postgresql на основе файла .env.dist

- Запустить миграции:

`vendor/bin/yii migrate/up --appconfig=config/config.php`



