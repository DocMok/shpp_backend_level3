<?php

class View
{

    /**
     * Generates the html using template parts.
     * @param string $templateName - template directory name
     * @param string $bodyName - template body name
     * @param array $bodyData - body data array
     */
    public function generateView(string $templateName, string $bodyName, array $bodyData = []) {
        //header including
        include_once "template_parts/{$templateName}/header.php";

        //body including
        include "template_parts/{$templateName}/{$bodyName}_body.php";

        //printing links if need
        if (isset($bodyData['pagesData'])) {
            $pagesLabels = $bodyData['pagesData']['labels'];
            $currentPage = $bodyData['pagesData']['currentPage'];
            $offset = $bodyData['pagesData']['offset'];
            echo $this->generatePagesLinks($pagesLabels, $currentPage, $offset);
        }

        //footer including
        include 'template_parts/' . $templateName . '/footer.php';
    }

    /**
     * Generates pages links html code using next parameters:
     * @param array $pages - list of pages names (including [...] as dividers for pagination)
     * @param int $currentPage - current page number
     * @param int $offset - is items limit for page
     * @return string - pagination html
     */
    private function generatePagesLinks(array $pages, int $currentPage, int $offset): string {
        $links = '';
        foreach ($pages as $page) {
            $active = $page==$currentPage ? 'active' : "";
            if ($page != '...') {
                $links .= "<li class=\"page-item $active\"><a class=\"page-link\"  href=\"?page=$page&offset=$offset\">$page</a></li>";
            } else {
                $links .= "<li class=\"page-item\"><a class=\"page-link\">$page</a></li>";
            }
        }
        return $links;
    }
}