# Task Management API (Test Task)

REST API для управления задачами с автоматизированным развертыванием в Docker.

## Стек технологий
- **PHP 8.2** 
- **Laravel**
- **MySQL 8.0**
- **Nginx**
- **Scribe**
- **Docker**

## Быстрый запуск

**Клонируем репозиторий**

git clone https://github.com/Oberon1989/effectmobile.git

**Переходим в каталог с проектом**

cd effectmobile

**Собираем и запускаем образ**

docker compose up -d --build

**После чего необходимо дождаться пока все поднимется включая базу данных и выполнятся миграции, проверить можно командой**

docker compose logs -f app

**Документация доступна по http://IP:8080/docs**
