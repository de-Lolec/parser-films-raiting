<?php

namespace MyProject\Controllers;

use MyProject\Models\Films\Films;
use MyProject\Models\parsers\CommentAdd;
use MyProject\Models\parsers\Parser;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;
use phpQuery;


class ParserControllerClub
{
    /** @var View */
    public static function addBlockClub()
    {

        $osn_url = ["url" => "https://doramy.club/navi/page/2?razdel=filmy&tax_strana&tax_perevod&tax_studiya&sort_stat=status#038;tax_strana&tax_perevod&tax_studiya&sort_stat=status"];
//foreach ($osn_url as $url=>$izm){
        // $dop_url ['url'] = "https://doramatv.live/list?sortType=USER_RATING&filter=single&offset=0";
        $page = 1;
        $offset = 0;

        while ($page != 90) {

            $html = Parser::getPage($osn_url);
         //   $html = iconv('utf-8//IGNORE', 'windows-1251//IGNORE', $html);
            //    $dopHtml = Parser::getPage($dop_url);
            $osn_url['url'] = "https://doramy.club/navi/page/" . $page++ . "?razdel=filmy&tax_strana&tax_perevod&tax_studiya&sort_stat=status#038;tax_strana&tax_perevod&tax_studiya&sort_stat=status";
            //     var_dump($osn_url);
            //  $dop_url ['url'] = "https://doramatv.live/list?sortType=USER_RATING&filter=single&offset=" . $offset += 70;




            if (!empty($html["data"])) {

                $content = $html["data"]["content"];

                $pq = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $content);


                // $url = self::addElement($url);


                // $checkOrig =  ParserAdd::getOriginal();

                $url = $pq->find(".post-home a");

                foreach ($url as $ur) {

                    $urlOsn = pq($ur);
                    $urlName = trim($urlOsn->attr("href"));

                    $dtp = [];
                    $tmd['url'] = $urlName;

                    $htmlPage = Parser::getPage($tmd);

                    $contBlock = $htmlPage["data"]["content"];

                 //  $pqBlock = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8mb4">' . $contBlock);
                    $pqBlock = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $contBlock);
                    $orig = $pq->find(".post-home em");


                    $orig_name = $pqBlock->find(".original");
                    $origNameUrl = self::addElement($orig_name);
                    $checkOrig = self::addElement($orig_name);
                 //   if (empty($checkOrig)) {

                        $urlOsn = pq($ur);
                        $names = $pqBlock->find(".poloska h1");

                        $country = $pqBlock->find(".tbody-sin td:eq(5)");
                        $time = $pqBlock->find(".tbody-sin td:eq(1)");
                        $year = $pqBlock->find(".tbody-sin td:eq(3)");
                        $genre = $pqBlock->find(".tbody-sin td:eq(7)");
                        $description = $pqBlock->find(".annotaciya");
                        $grade = $pqBlock->find(".unit-rating");
                        $img = $pqBlock->find(".poster img");
                        $comment = $pqBlock->find(".commentlist p");
                        //  $dopcomment = $pqBlock->find(".postbody #text");


                        foreach ($img as $im) {
                            $imgPq = pq($im);
                            $imgUrl = trim($imgPq->attr("src"));

                            $dtp = [
                                'name' => self::addElement($names),
                                'orig_name' => self::addElement($orig_name),
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

                        }
                    }

                }
            }






        phpQuery::unloadDocuments();


    }


    public static function addElement($ed)
    {
        $tmp = [];

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