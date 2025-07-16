php bin/console dbal:run-sql "SELECT author_id, COUNT(author_id) FROM book GROUP BY author_id"

php -d memory_limit=2G bin/console dbal:run-sql "SELECT author.id as Author, COUNT(author.id) as Count FROM book INNER JOIN author WHERE book.author_id=author.id GROUP BY author.id"

php -d memory_limit=2G bin/console data:add 1 10000 - пример вызова консольной команды для заполнения БД.
