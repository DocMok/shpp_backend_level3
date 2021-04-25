<?php
require_once 'views/View.php';
require_once 'models/Model.php';
require_once 'components/Paginator.php';

class BooksController
{
    private View $view;
    private Paginator $paginator;
    private int $limit = 20;

    public function __construct() {
        $this->view = new View;
        $this->paginator = new Paginator($this->limit);
    }

    /**
     * Shows books page using $_GET variable data
     */
    public function show()
    {
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
            $_GET['offset'] = $this->limit;
        }

        $data = $this->paginator->getBooks($_GET['page']);
        $pages = $this->paginator->getPages($_GET['page']);
        $bodyData = ['data' => $data, 'pagesData' => ['labels' => $pages, 'currentPage' => $_GET['page'], 'offset' => $_GET['offset']]];
        $this->view->generateView('books', 'books', $bodyData);
    }
}