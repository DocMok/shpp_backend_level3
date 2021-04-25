<?php

require_once 'views/View.php';

class NotFoundController
{
    private View $view;

    /**
     * NotFoundController constructor shows the 404 page.
     * @param string $error - error message
     */
    function __construct($error='')
    {
        $this->view = new View();
        $this->view->generateView('books', '404');
    }

}