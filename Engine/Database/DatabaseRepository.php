<?php

namespace MikhUd\CSVDB\Engine\Database;

class DatabaseRepository
{
    public function __construct(
        private $databaseConnector = new DatabaseConnector()
    ) {}

    public function getExistsBooksAndAuthorsFromDB(array $data): array
    {
        $PDO = $this->databaseConnector->getPDO();
        $stmt = $PDO->query("SELECT b.name AS 'book', (SELECT a.name FROM authors a WHERE a.id = ab.author_id) AS 'author'
        FROM books b JOIN author_book ab ON b.id = ab.book_id
        WHERE b.name IN (" . implode(",", $data) . ")");

        return $stmt->fetchAll();
    }
}