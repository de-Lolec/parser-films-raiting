<?php

namespace MyProject\Controllers;

use MyProject\Models\Films\Films;
use MyProject\Models\parsers\CommentAdd;
use MyProject\Models\parsers\Parser;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;
use phpQuery;


class ParserControllerLive
{
    /** @var View */
    public static function addBlockLive()
    {


        $dop_url = ["url" => "https://doramalive.ru/dorama/?mode=film&PAGEN_1="];
        $page = 1;
        $offset = 0;
        while ($page != 5) {


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
    public static function conn($arrName, $arrCountry){

    }

    protected static function getTableName(): string
    {
        return 'block';
    }

}