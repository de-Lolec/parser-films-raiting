<?php

namespace MyProject\Controllers;

use MyProject\Models\Films\Films;
use MyProject\Models\parsers\CommentAdd;
use MyProject\Repositories\Parser;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;
use phpQuery;


class ParserControllerClub

{

    public function controlParser(){

        foreach ($_POST['update'] as $item){
            if($item == 'addBlockClub'){

                self::addBlockClub();
                var_dump($item);

        } elseif($item == 'addBlockLive'){

                self::addBlockLive();
                var_dump($item);

            }elseif($item == 'commentAnalyze'){
                PivoController::commentAnalyze();
            }
        }
    }


    public static function addBlockClub()
    {

        $osn_url = ["url" => "https://doramy.club/navi/page/1?razdel=filmy&tax_strana&tax_perevod&tax_studiya&sort_stat=status#038;tax_strana&tax_perevod&tax_studiya&sort_stat=status"];

        $page = 0;


        while ($page != 5) {
            $ied = 0;
            $html = Parser::getPage($osn_url);

            $osn_url['url'] = "https://doramy.club/navi/page/" . $page++ . "?razdel=filmy&tax_strana&tax_perevod&tax_studiya&sort_stat=status#038;tax_strana&tax_perevod&tax_studiya&sort_stat=status";


            if (!empty($html["data"])) {

                $content = $html["data"]["content"];

                $pq = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $content);

                $url = $pq->find(".post-home a");


                foreach ($url as $ur) {


                    if ($ied != 10) {

                        var_dump($ied);

                        $orig = $pq->find(".post-home em:eq(" . $ied . ")");
                    }else{
                            $ied = 0;
                        }

                    $re = 0;

                 //   while($ied<10){

                        // $ied++;



//                        switch ($ied) {
//                            case 0:
//                                $orig = $pq->find(".post-home em:eq(0)");
//                                break;
//                            case 1:
//                                $orig = $pq->find(".post-home em:eq(1)");
//                                break;
//                            case 2:
//                                $orig = $pq->find(".post-home em:eq(2)");
//                                break;
//                            case 3:
//                                $orig = $pq->find(".post-home em:eq(3)");
//                                break;
//                            case 4:
//                                $orig = $pq->find(".post-home em:eq(4)");
//                                break;
//                            case 5:
//                                $orig = $pq->find(".post-home em:eq(5)");
//                                break;
//                            case 6:
//                                $orig = $pq->find(".post-home em:eq(6)");
//                                break;
//                            case 7:
//                                $orig = $pq->find(".post-home em:eq(7)");
//                                break;
//                            case 8:
//                                $orig = $pq->find(".post-home em:eq(8)");
//                                break;
//                            case 9:
//                                $orig = $pq->find(".post-home em:eq(9)");
//                                break;
//                        }

                        $ied++;
                                $urlOsn = pq($ur);
                                $urlName = trim($urlOsn->attr("href"));

                                $dtp = [];
                                $tmd['url'] = $urlName;

                                $htmlPage = Parser::getPage($tmd);
                                $contBlock = $htmlPage["data"]["content"];

                                $pqBlock = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $contBlock);


                                // $orig_name = $pqBlock->find(".original");
                                //  $origNameUrl = self::addElement($orig);


                                foreach ($orig as $el) {

                                    $clout = pq($el);
                                    $origNameUrl = trim($clout->text());

                                    file_put_contents('Z:\\5.log', date(DATE_ISO8601) . ' ' . $origNameUrl . ' ' . $ied . '  ' . $urlName . '    ' . $page . PHP_EOL, FILE_APPEND);

var_dump($origNameUrl);

//var_dump($ied);
                                    //$CheckName = self::addElement($names);

                                    if (empty(ParserAdd::getIdByOrig($origNameUrl))) {

                                        //    $checkOrig = self::addElement($orig_name);

                                        $urlOsn = pq($ur);
                                        $yearCheck = self::addElement($pqBlock->find(".tbody-sin td:eq(3)"));
                                        if ($yearCheck == '18+') {
                                            $year = $pqBlock->find(".tbody-sin td:eq(5)");
                                            $country = $pqBlock->find(".tbody-sin td:eq(7)");
                                            $genre = $pqBlock->find(".tbody-sin td:eq(9)");
                                        } else {
                                            $year = $pqBlock->find(".tbody-sin td:eq(3)");
                                            $country = $pqBlock->find(".tbody-sin td:eq(5)");
                                            $genre = $pqBlock->find(".tbody-sin td:eq(7)");
                                        }
                                        $time = $pqBlock->find(".tbody-sin td:eq(1)");
                                        $names = $pqBlock->find(".poloska h1");
                                        $description = $pqBlock->find(".annotaciya");
                                        $grade = $pqBlock->find(".unit-rating");
                                        $img = $pqBlock->find(".poster img");
                                        $comment = $pqBlock->find(".commentlist p");

                                        foreach ($img as $im) {
                                            $imgPq = pq($im);
                                            $imgUrl = trim($imgPq->attr("src"));

                                            $dtp = [
                                                'name' => self::addElement($names),
                                                'orig_name' => $origNameUrl,
                                                'country' => self::addElement($country),
                                                'time' => self::addElement($time),
                                                'year' => self::addElement($year),
                                                'genre' => self::addElement($genre),
                                                'description' => self::addElement($description),
                                                'grade' => self::addElement($grade),
                                                'poster' => $imgUrl,
                                            ];

                                            $addFilm = new ParserAdd();
                                            $addFilm->setNameFilm($dtp['name']);
                                            $addFilm->setCountry($dtp['country']);
                                            $addFilm->setTime($dtp['time']);
                                            $addFilm->setYear($dtp['year']);
                                            $addFilm->setDescription($dtp['description']);
                                            $addFilm->setGrade($dtp['grade']);
                                            $addFilm->setPoster($dtp['poster']);
                                            $addFilm->setGenre($dtp['genre']);
                                            $addFilm->setOriginal($dtp['orig_name']);
                                            $addFilm->save();

                                            UrlController::liveAdd($urlName, $origNameUrl);
                                            CommentController::commentAdd($comment, $dtp['orig_name']);
                                            var_dump($addFilm);

                                        }
                                    }

                                }
                        }

            }

        }
        phpQuery::unloadDocuments();
    }

    public static function addBlockLive()
    {

        $dop_url = ["url" => "https://doramalive.ru/dorama/?mode=film&PAGEN_1="];
        $page = 1;
        $offset = 0;
        while ($page != 50) {


            $dopHtml = Parser::getPage($dop_url);

            $dop_url['url'] = "https://doramalive.ru/dorama/?mode=film&PAGEN_1=" . $page++;

            if (!empty($dopHtml["data"])) {

                $content = $dopHtml["data"]["content"];

                $pq = phpQuery::newDocument($content);


                $url = $pq->find(".media-heading a");

                foreach ($url as $ur) {

                    $urlOsn = pq($ur);

                    $urlName = trim($urlOsn->attr("href"));

                    $urlNameFull = 'https://doramalive.ru' . $urlName;
                    if (empty(ParserAdd::getUrlCheck($urlNameFull))) {

                        $tmd['url'] = 'https://doramalive.ru' . $urlName;

                        $htmlPage = Parser::getPage($tmd);

                        $contBlock = $htmlPage["data"]["content"];

                        $pqBlock = phpQuery::newDocument($contBlock);

                        $page2 = 1;
                        $dopOrig1 = $pqBlock->find(".dl-horizontal i:eq(0)");
                        $dopOrig2 = $pqBlock->find(".dl-horizontal i:eq(1)");
                        $dopOrig3 = $pqBlock->find(".dl-horizontal i:eq(2)");
                        $dopOrig4 = $pqBlock->find(".dl-horizontal i:eq(3)");

                        while ($page2 != 3) {


                            $tmd2['url'] = 'https://doramalive.ru' . $urlName . '?page=page-' . $page2++;
                            $htmlPage2 = Parser::getPage($tmd2);

                            $contBlock2 = $htmlPage2["data"]["content"];

                            $pqBlock2 = phpQuery::newDocument($contBlock2);

                            $dopcomment = $pqBlock2->find(".fulltext p");

                            $otp = [
                                self::addElement($dopOrig1),
                                self::addElement($dopOrig2),
                                self::addElement($dopOrig3),
                                self::addElement($dopOrig4)
                            ];

                            CommentController::commentAdd($dopcomment, $otp);
                            UrlController::liveAdd($urlNameFull, $otp);

                        }
                    }
                }
            }
        }

        phpQuery::unloadDocuments();
    }


    public static function addElement($ed)
    {

        foreach ($ed as $elements) {

            $clout = pq($elements);
            $arrayOne=trim($clout->text());

        }

        return $arrayOne;

    }

    protected static function getTableName(): string
    {
        return 'block';
    }

}