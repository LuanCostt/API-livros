<?php
namespace Model;

use PDO;
use Model\Connection;

class Userlivros
{
    private $conn;

    public $id;
    public $title;
    public $author;
    public $published_year;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function getBooks()
    {
        $sql = "SELECT * FROM books";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Buscar pelo titulo
    public function getBooksTitle($title)
{
    $sql = "SELECT * FROM books WHERE title LIKE :title";
    $stmt = $this->conn->prepare($sql);
    $likeTitle = "%{$title}%";
    $stmt->bindParam(":title", $likeTitle, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    //Buscar pelo ID
    public function getBookId($id)
    {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //Buscar pelo ano
    public function getBooksYear($year)
    {
        $sql = "SELECT * FROM books WHERE published_year = :year";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":year", $year, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createBook()
    {
        $sql = "INSERT INTO books (title, author, published_year) VALUES (:title, :author, :published_year)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":published_year", $this->published_year, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function updateBook()
    {
        $sql = "UPDATE books SET title = :title, author = :author, published_year = :published_year WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":published_year", $this->published_year, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteBook()
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>