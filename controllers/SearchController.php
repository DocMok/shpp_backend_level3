<?php
require_once 'models/Model.php';
require_once 'views/View.php';

class SearchController {
    private Model $model;
    private View $view;

    public function __construct() {
        $this->model = new Model;
        $this->view = new View;
    }

    /**
     * Shows page with search query's result.
     */
    public function show() {
        $searchQuery = $_POST['search'];
        $searchResult = $this->model->findBook($searchQuery);

        $bodyData = ['data' => $searchResult,
            'searchQuery'=>$searchQuery,
        ];
        $this->view->generateView('books', 'search', $bodyData);
    }
}