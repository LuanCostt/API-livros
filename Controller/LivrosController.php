<?php
namespace Controller;

use Model\Userlivros;

require_once __DIR__ . '/../Config/configuration.php';

class LivrosController
{
    public function getBooks()
    {
        $book = new Userlivros();
        $books = $book->getBooks();

        if ($books) {
            header('Content-Type: application/json', true, 200);
            echo json_encode($books);
        } else {
            header('Content-Type: application/json', true, 404);
            echo json_encode(["message" => "Livros não encontrados"]);
        }
    }
    public function getBookId()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $book = new Userlivros();
            $book->id = $id;
            $result = $book->getBookId($id);
            if ($result) {
                header('Content-Type: application/json', true, 200);
                echo json_encode($result);
            } else {
                header('Content-Type: application/json', true, 404);
                echo json_encode(["message" => "Livro não encontrado"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "ID inválido"]);
        }
    }
    public function getBookTitle()
    {
        $title = $_GET['title'] ?? null;

        if ($title) {
            $book = new Userlivros();
            $result = $book->getBookTitle($title);

            if ($result) {
                header('Content-Type: application/json', true, 200);
                echo json_encode($result);
            } else {
                header('Content-Type: application/json', true, 404);
                echo json_encode(["message" => "Livro não encontrado"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Título inválido"]);
        }
    }
    public function getBookAuthor()
    {
        $author = $_GET['author'] ?? null;

        if ($author) {
            $book = new Userlivros();
            $result = $book->getBookAuthor($author);

            if ($result) {
                header('Content-Type: application/json', true, 200);
                echo json_encode($result);
            } else {
                header('Content-Type: application/json', true, 404);
                echo json_encode(["message" => "Autor não encontrado"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Nome do autor inválido"]);
        }
    }
    public function getBookYear()
    {
        $year = $_GET['year'] ?? null;

        if ($year && is_numeric($year)) {
            $book = new Userlivros();
            $result = $book->getBookYear((int) $year);

            if ($result) {
                header('Content-Type: application/json', true, 200);
                echo json_encode($result);
            } else {
                header('Content-Type: application/json', true, 404);
                echo json_encode(["message" => "Nenhum livro encontrado para o ano $year"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Ano inválido"]);
        }
    }


    public function createBook()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->title) && isset($data->author) && isset($data->published_year)) {
            $book = new Userlivros();
            $book->title = $data->title;
            $book->author = $data->author;
            $book->published_year = $data->published_year;


            if ($book->createBook()) {
                header('Content-Type: application/json', true, 201);
                echo json_encode(["message" => "Livro criado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao criar livro"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informações inválidas"]);
        }
    }

    public function updateBook()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->title) && isset($data->author) && isset($data->published_year)) {
            $book = new Userlivros();
            $book->id = $data->id;
            $book->title = $data->title;
            $book->author = $data->author;
            $book->published_year = $data->published_year;

            if ($book->updateBook()) {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Livro atualizado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao atualizar livro"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informações inválidas"]);
        }
    }

    public function deleteBook()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $book = new Userlivros();
            $book->id = $id;

            if ($book->deleteBook()) {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Livro excluído com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao excluir livro"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "ID inválido"]);
        }
    }
}

?>