<?php

namespace MyProject\Controllers;

use MyProject\Models\Films\Films;
use MyProject\Models\parsers\Parser;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;


class MainController extends AbstractController
{

    public function main()
    {
        $this->page(1);
    }
    public function page(int $pageNum)
    {
        $this->view->renderHtml('main/main.php', [
            'vsr' => ParserAdd::getPage($pageNum, 10),
            'pagesCount' => ParserAdd::getPagesCount(10),
            'currentPageNum' => $pageNum,

        ]);
    }
}