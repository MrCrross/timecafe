# Поликлиника

## БД

в .env - настроено для бд time_cafe и СУБД mysql с пользователем root без пароля на локальную БД

в папке public/documents есть sql-скрипт, который создаст таблицы с тестовыми данными

Или выполните команду ```php artisan migrate --seed```

## Фронт

Должен быть с билженным под продакшн, но если не работает, то ```npm run dev``` или  ```npm run build```

## Бэк

Необходимо пересгенерировать ключ приложения. Используем команду ```php artisan key:generate```

Если хотите работать без сервера(nginx, apache), то ```php artisan serve``` в помощь

Если же хотите использовать средства XAMPP, то распакуйте архив в папке XAMPP/htdocs

И в файл ```xampp\apache\conf\extra\httpd-vhosts.conf``` вставить

```
<VirtualHost *:80>
    ServerName timecafe.localhost
    DocumentRoot "C:/xampp/htdocs/TimeCafe/public"
    <Directory "C:/xampp/htdocs/TimeCafe/public">
        AllowOverride all
    </Directory>
    ErrorLog "logs/timecafe-error.log"
    CustomLog "logs/timecafe-access.log" common
</VirtualHost>
```

при перезапуске apache в XAMPP-control по timecafe.localhost должен открыться проект
