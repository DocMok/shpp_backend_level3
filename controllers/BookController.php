<?php
require_once 'views/View.php';
require_once 'models/Model.php';
require_once 'NotFoundController.php';

class BookController
{
    private Model $model;
    private View $view;

    public function __construct() {
        $this->model = new Model;
        $this->view = new View;
    }

    /**
     * Shows the page about book using book ID or 404 page in case when the ID is wrong.
     * @param $id - book ID.
     */
    public function show($id)
    {
        $data['bodyData'] = $this->model->getBook($id);
        if (sizeof($data['bodyData']) > 0) {
            $this->view->generateView('books', 'book', $data);
        } else {
            new NotFoundController();
        }
    }

    /**
     * Increases the current book view field number in database using book ID.
     * @param $id - book ID.
     */
    public function increaseViewCounter($id) {
        $this->model->increaseViewsCounter($id);
    }
}