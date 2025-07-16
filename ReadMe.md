docker/books.postman_collection.json - файл с запросами к API для Postman

Развертывание:

1) git clone https://github.com/alexinbox80/books.git (ветка develop)
2) git checkout develop
3) docker compose up -d
4) docker exec -it -u www-data books_php bash
5) composer install
6) php bin/console cache:clear
7) php bin/console do:mi:mi
8) php -d memory_limit=2G bin/console data:add 3 10000


php bin/console dbal:run-sql "SELECT author_id, COUNT(author_id) FROM book GROUP BY author_id"

php -d memory_limit=2G bin/console dbal:run-sql "SELECT author.id as Author, COUNT(author.id) as Count FROM book INNER JOIN author WHERE book.author_id=author.id GROUP BY author.id"

php -d memory_limit=2G bin/console data:add 1 10000 - пример вызова консольной команды для заполнения БД.
