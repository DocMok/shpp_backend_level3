<?php
require_once 'models/Model.php';

class Paginator
{
    const ITEMS_ON_PAGE = 10;
    const PAGES_TO_SHOW = 3; //must be an odd integer
    private int $totalItems;
    private int $totalPages;
    private int $limit;
    private Model $model;

    public function __construct($limit = self::ITEMS_ON_PAGE)
    {
        $this->model = new Model();
        $this->limit = $limit;
        $this->totalItems = $this->model->getRecordsCount();
        $this->totalPages = $this->getTotalPages();
    }

    /**
     * Gets the books selection using class $limit and function $page parameters for current page
     * @param int $page - page number
     * @return array - books selection from [($page - 1) * $limit] to [($page - 1) * $limit + $limit]
     */
    public function getBooks(int $page): array
    {
        return $this->model->getBooksSelection($page, $this->limit);
    }


    /**
     * Returns array with labels for pages buttons
     * @param $currentPage - current page number
     * @return array - with labels for pages buttons
     */
    public function getPages($currentPage): array
    {
        //validating currentPage value
        $currentPage = $this->validateCurrentPage($currentPage);

        $result = [];
        $middlePages = $this->getMiddlePages($currentPage);

        //adding dot-dividers between first page and block with middle pages
        if ($middlePages[0] == 1) {
            $result = $middlePages;
        } else {
            $result[] = '1';
            if ($middlePages[0] > 2) {
                $result[] = '...';
            }
            $result = array_merge($result, $middlePages);
        }
        //adding dot-dividers between last page and block with middle pages
        if ($middlePages[sizeof($middlePages) - 1] < $this->totalPages - 1) {
            $result[] = '...';
        }
        if ($middlePages[sizeof($middlePages) - 1] != $this->totalPages) {
            $result[] = $this->totalPages;
        }
        return $result;
    }

    /**
     * Returns middle part of the pagination pattern. Middle part is a part that located between [...] buttons, for example:
     * in [... 5 6 7 ...] [5 6 7] is middle part
     * @param $currentPage - current page number
     * @return array - middle part of the pagination pattern
     */
    private function getMiddlePages($currentPage): array
    {
        $offset = (self::PAGES_TO_SHOW - 1) / 2;
        $start = max(1, $currentPage - $offset);
        $end = min($this->totalPages, $currentPage + $offset);
        $middlePages = [];
        for ($i = $start; $i <= $end; $i++) {
            $middlePages[] = $i;
        }
        return $middlePages;
    }

    /**
     * @return int - total pages number depending on the $totalItems and $limit variables
     */
    private function getTotalPages(): int
    {
        return ceil($this->totalItems / $this->limit);
    }

    /**
     * Validates current page number in the range from 1 to $totalPages value.
     * @param $currentPage - current page number
     * @return int - validated page number
     */
    private function validateCurrentPage($currentPage): int
    {
        if ($currentPage > ($this->totalPages / 2)) {
            $currentPage = min($currentPage, $this->totalPages);
        } else {
            $currentPage = max(1, $currentPage);
        }
        return $currentPage;
    }

}
