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
    public function controlParser()
    {
      foreach ($_POST['update'] as $item) {
        if ($item == 'addBlockClub') {

          self::addBlockClub();
        
          var_dump($item);

        } elseif ($item == 'addBlockLive') {

          self::addBlockLive();
          var_dump($item);

        } elseif ($item == 'commentAnalyze') {
          PivoController::commentAnalyze();
        }
      }
    }


    public static function addBlockClub()
    {
      $osn_url = ["url" => "https://doramy.club/navi-cl/page/2?razdel=filmy&tax_strana&tax_perevod=russkaya-ozvuchka&tax_studiya&sort_rai=ratings_average&sort_stat=status#038;tax_strana&tax_perevod=russkaya-ozvuchka&tax_studiya&sort_rai=ratings_average&sort_stat=status"];

      $page = 50;

      while ($page != 111) {
        $ied = 0;
        
        echo $page;
        $osn_url['url'] = "https://doramy.club/navi-cl/page/" . $page++ . "?razdel=filmy&tax_strana&tax_perevod=russkaya-ozvuchka&tax_studiya&sort_rai=ratings_average&sort_stat=status#038;tax_strana&tax_perevod=russkaya-ozvuchka&tax_studiya&sort_rai=ratings_average&sort_stat=status";
        $html = Parser::getPage($osn_url);
        // var_dump($osn_url);
        if (!empty($html["data"])) {

          $content = $html["data"]["content"];

          $pq = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $content);

          $url = $pq->find(".post-list a");
          
          foreach ($url as $ur) {

            if ($ied != 10) {

              // var_dump($ied);

              $orig = $pq->find(".post-list em:eq(" . $ied . ")");
            } else {
              $ied = 0;
            }

            $ied++;
            $urlOsn = pq($ur);
            $urlName = trim($urlOsn->attr("href"));

            $dtp = [];
            $tmd['url'] = $urlName;

            $htmlPage = Parser::getPage($tmd);
            $contBlock = $htmlPage["data"]["content"];

            $pqBlock = phpQuery::newDocument('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $contBlock);

            foreach ($orig as $el) {

              $clout = pq($el);
              $origNameUrl = trim($clout->text());

              // file_put_contents('Z:\\5.log', date(DATE_ISO8601) . ' ' . $origNameUrl . ' ' . $ied . '  ' . $urlName . '    ' . $page . PHP_EOL, FILE_APPEND);
              // var_dump($origNameUrl);
              // var_dump(empty(ParserAdd::getIdByOrig($origNameUrl)));
              if (empty(ParserAdd::getIdByOrig($origNameUrl))) {
                var_dump($origNameUrl);
                $urlOsn = pq($ur);

                $yearYearCountry = self::addElement($pqBlock->find(".table-tag u:eq(1)"));

                $sliceYearCountry = explode(", ", $yearYearCountry);

                $country = implode(", ", array_slice($sliceYearCountry, 0, -1));
                $year = end($sliceYearCountry);
                
                $genre = $pqBlock->find(".table-tag td:eq(2)");

                $time = $pqBlock->find(".tbody-sin td:eq(1)");
                $names = $pqBlock->find(".post-singl h1");
                $description = $pqBlock->find(".infotext p");
                $grade = $pqBlock->find(".unit-rating");
                $img = $pqBlock->find(".img-poster img");
                $comment = $pqBlock->find(".commentlist p");
                // var_dump('faefawefawefaa');
                foreach ($img as $im) {
                  
                  $imgPq = pq($im);
                  $imgUrl = trim($imgPq->attr("src"));

                  var_dump($imgUrl);
                  
                  $dtp = [
                    'name' => self::addElement($names),
                    'orig_name' => $origNameUrl,
                    'country' => $country,
                    'time' => self::addElement($time),
                    'year' => $year,
                    'genre' => self::addElement($genre),
                    'description' => self::addElement($description),
                    'grade' => self::addElement($grade),
                    'poster' => $imgUrl,
                  ];

                  echo '<pre>';
                  var_dump($dtp);
                  echo '</pre>';
                  $addFilm = new ParserAdd();
                  $addFilm->setNameFilm($dtp['name']);
                  $addFilm->setCountry($dtp['country']);
                  $addFilm->setTime($dtp['time']);
                  $addFilm->setYear($dtp['year']);
                  if(!is_null($dtp['description'])){
                    $addFilm->setDescription($dtp['description']);
                  }
                  $addFilm->setGrade($dtp['grade']);
                  $addFilm->setPoster($dtp['poster']);
                  $addFilm->setGenre($dtp['genre']);
                  $addFilm->setOriginal($dtp['orig_name']);
                  $addFilm->save();
                  // var_dump('faefawefawefa');
                  // echo 'faefawefawefa';
                  UrlController::liveAdd($urlName, $origNameUrl);
                  CommentController::commentAdd($comment, $dtp['orig_name']);
                  // echo '<pre>';
                  // var_dump($addFilm);
                  // echo '<pre>';
                }
                // var_dump($addFilm);
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
      while ($page != 2) {


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
              // file_put_contents('Z:\\5.log', date(DATE_ISO8601) . $urlName . '    ' . $page . PHP_EOL, FILE_APPEND);

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
        $arrayOne = trim($clout->text());

      }

      return $arrayOne;

    }

    protected static function getTableName(): string
    {
      return 'block';
    }

}