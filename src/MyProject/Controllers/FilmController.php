<?php

namespace MyProject\Controllers;


use MyProject\Models\Users\User;
use MyProject\View\View;
use MyProject\Controllers\ParserController;
use MyProject\Models\parsers\ParserAdd;

class FilmController
{

    protected $view;
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');

    }


    public function film(int $FilmId)
    {
        $film = ParserAdd::getById($FilmId);
        explode('%', $pageValue);
        $this->view->renderHtml('film/film.php', [
            'film' => $film
        ]);

    }

    public function dva()
    {
        echo 'sdasdasd';
        file_put_contents('Z:\\4.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);

    }

    public static function PageMain($addFilm)
    {

        $main = [];
        $key = [];


        foreach ($addFilm as $key => $Film) {
            $main[] = $Film;
            if ($key == 10) {
                //  var_dump($main);
                return $main;
            }
        }
    }
    public function mainPages($pageValue){

        $list = ParserAdd::findAll();
        explode('%', $pageValue);
        $main = self::page($pageValue, $list);
        $this->view->renderHtml('pages/page.php', [
            'filmPage' => $main,
            'pageNum' => $pageValue,
            'allSortFilms' => $list
        ]);
    }

    public function sortPages($number){
        $list = self::sortList($_GET);
        $main = self::page($number, $list);


        $re = '/sort.+/m';
        $str = $_SERVER['REQUEST_URI'];

        preg_match_all($re, $str, $mainSort, PREG_SET_ORDER, 0);


        $amountFilms = count($list)/10;


        $this->view->renderHtml('pages/page.php', [
            'filmPage' => $main,
            'pageNum' => $number,
            'pageSortNum' =>  implode('', $mainSort[0]),
            'allSortFilms' => $list

        ]);
    }
    public static function page($pageValue, $list)
    {

        explode('%', $pageValue);



        $page = $pageValue-1;
        $pageNum = $page * 10;
        $whileNum = $pageValue * 10;
        $main = [];

        while($pageNum <= $whileNum) {

            $main[] = $list[$pageNum];
            //     echo $pageNum . ' ';
            $pageNum++;

        }
        return $main;
        // var_dump($main);

    }


    public function sort(){

        $list = self::sortList($_GET);


        $re = '~.$~';
        $str = parse_url($_SERVER['QUERY_STRING'], PHP_URL_QUERY);

        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        var_dump($matches);
        var_dump($str);
        var_dump(next($_GET));
        var_dump($_GET);
        $main = [];
        $amount = 0;
        while($amount != 10) {

            $main[] = $list[$amount];

            $amount++;

        }

        $this->view->renderHtml('pages/sort.php', [
            'sortPage' => $main,

        ]);
    }
    public static function sortList($get){
        $pivgrade = '';
        $year = false;
        $genre = [];
        $grade = '';
        $country = [];
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


        echo reset($genre);
        echo end($genre);

        $list = ParserAdd::sortMain($pivgrade, $genre, $country, $grade);

        return $list;
    }



}
