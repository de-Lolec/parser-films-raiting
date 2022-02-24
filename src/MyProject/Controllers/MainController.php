<?php

namespace MyProject\Controllers;

use MyProject\Models\Films\Films;
use MyProject\Models\parsers\Parser;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;


class MainController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
        $addFilm = ParserAdd::findAll();
        $this->view->renderHtml('main/main.php', ['addFilm' => $addFilm]);
    }
}