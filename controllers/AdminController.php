<?php
require_once 'models/Model.php';
require_once 'views/View.php';
require_once 'components/Paginator.php';

class AdminController
{
    private Model $model;
    private View $view;
    private Paginator $paginator;
    private int $limit = 10;

    public function __construct() {
        $this->model = new Model;
        $this->view = new View;
        $this->paginator = new Paginator($this->limit);
    }

    /**
     * Shows admin page after basic authentication
     */
    public function show() {
        $this->authenticate();

        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
            $_GET['offset'] = 0;
        }
        $data = $this->paginator->getBooks($_GET['page']);
        $pages = $this->paginator->getPages($_GET['page']);
        $bodyData =['data'=>$data, 'pagesData'=>['labels'=>$pages, 'currentPage'=>$_GET['page'], 'offset'=>$_GET['offset']]];
        $this->view->generateView('admin', 'admin', $bodyData);
    }

    /**
     * Puts the new book's data from the $_POST variable into the database
     */
    public function addBook() {
        if (isset($_POST)) {
            $filename = $this->uploadImage($_FILES['cover']);
            $title = $_POST['bookname'];
            $authors = [];
            for ($i = 0; $i < 3; $i++) {
                if (!empty($_POST["author{$i}"])) {
                    $authors[] = $_POST["author{$i}"];
                }
            }
            $year = $_POST['year'];
            $description = $_POST['description'];
            $this->model->addBook($title, $authors, $year, $description, $filename);
        }
        header("Location: /admin");
    }

    /**
     * Removes book from database using $_GET['id'] variable
     */
    public function deleteBook() {
        if (isset($_GET['id'])) {
            echo 'removing';
            $this->model->deleteBook($_GET['id']);
        }
        header('Location: /admin');
    }

    /**
     *  Offers authorization for the user using basic authorization
     */
    private function authenticate() {
        $realm = "admin-panel";

        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $login = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];
        } else {
            header("WWW-Authenticate: Basic realm=\"$realm\"");
            header("HTTP/1.1 401 Unauthorized");
            die("Вы не ввели данные для авторизации");
        }

        $users = ['admin' => 'admin'];

        if (!isset($users[$login]) || $users[$login] != $pass) {
            die("Вы ввели не верные данные для авторизации");
        }
    }

    /**
     * Moves and renames uploaded image from temporary folder to uploads.
     * @param array $image - array with image data from $_FILES variable.
     * @return string - new filename into uploaded folder.
     */
    private function uploadImage(array $image): string {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $filename = uniqid().".$extension";
        if (move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/uploads/".$filename)) {
            return $filename;
        }
        return '';
    }
}