<?php

namespace MyProject\Controllers;


use MyProject\Models\Users\User;
use MyProject\Models\Users\UsersAuthService;
use MyProject\View\View;
use MyProject\Controllers\ParserController;
use MyProject\Models\parsers\ParserAdd;

class FilmController extends AbstractController
{

    public function film(int $FilmId)
    {
        $film = ParserAdd::getById($FilmId);
        explode('%', $pageValue);
        $this->view->renderHtml('film/film.php', [
            'film' => $film
        ]);

    }

    public function sortPages($number){
        $list = self::sortList($_GET, $number);



        $re = '/sort.+/m';
        $str = $_SERVER['REQUEST_URI'];

        preg_match_all($re, $str, $mainSort, PREG_SET_ORDER, 0);


        $amountFilms = count($list)/10;

        $this->view->renderHtml('pages/page.php', [
            'filmPage' => $list['sort'],
            'pagesCount' => $list['count'],
            'pageSortNum' =>  implode('', $mainSort[0]),
            'currentPageNum' => $number,

        ]);
    }

    public function main()
    {
        $this->page(1);
    }
    public function page(int $pageNum)
    {
        $this->view->renderHtml('main/main.php', [
            'articles' => ParserAdd::getPage($pageNum, 10),
            'pagesCount' => ParserAdd::getPagesCount(10),
        ]);
    }

    public static function sortList($get, $number){
        $pivgrade = '';
        $year = false;
        $genre = [];
        $grade = '';
        $country = [];
        $itemsPerPage = 10;
        foreach($get as $key => $tip) {
            if($tip == 'pivgrade'){
                $pivgrade = 'pivgrade';
            } elseif ($key == 'year'){
                $year = true;
            } elseif ($key == 'genre'){
                $genre['genre'] = $tip;
            } elseif ($tip == 'grade'){
                $grade = 'grade';
            } elseif ($key == 'country'){
                $genre['country'] = $tip;
            }

        }

        $list = ParserAdd::sortMain($pivgrade, $genre, $country, $grade, $itemsPerPage, $number);

        return $list;
    }



}
