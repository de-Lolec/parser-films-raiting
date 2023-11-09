<?php

namespace MyProject\Controllers;


use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\parsers\CommentAdd;
use MyProject\Models\Users\User;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;

class PivoController
{

    public static function commentAnalyze()
    {

        $OtherTest = ParserAdd::findAll();
        $countryTest = 0;
        $yearTest = 0;
        foreach ($OtherTest as $test){

            $IdTest = $test->getId();
            $country = $test->getCountry();
            $year = $test->getYear();
            $ratingTest = $test->getGrade();
            switch ($country){
                    case 'Япония':
                    $countryTest = 2;
                    break;
                     case 'Южная Корея':
                         $countryTest = 0.7;
                      break;
                      case 'Китай':
                    $countryTest = 0.5;
                    break;
            }
            switch ($year){
                case $year<=2009 && $year>=1995:
                    $yearTest = 1;
                    break;
                case $year>2009 && $year<=2016:
                    $yearTest = 0.7;
                    break;
                case $year>2016 || $year<1995:
                    $countryTest = 0.5;
                    break;
            }



            $pivGrade = 0;
            $comment = CommentAdd::getByIdComment($IdTest);

        foreach ($comment as $comm) {




            $commentText = [$IdTest => $comm->getComment()];

            foreach ($commentText as $IdFilm => $text) {

                $re = '/(пивко|пьяным|поржал|по пьяне|алкоголь|пивка|угар|смотреть пьяным|пиво| мат |трезвым не смотреть|под вино|душевно| вино | мата| мат. |)/m';
                $str = $text;

                preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
                if (!empty($matches[0])) {

                    //   $readyArr = [$IdFilm => $matches,];
                    foreach ($matches as $match) {
                        //    var_dump($match[0]);
                        if($match[0] == 'пивко' || $match[0] == 'пивка' || $match[0] == 'пиво' || $match[0] == 'смотреть пьяным' || $match[0] == 'трезвым не смотреть'|| $match[0] == 'под вино' || $match[0] == ' вино ' || $match[0] == 'по пьяне'){
                            $pivGrade += 4;
                        }elseif ($match[0] == 'алкоголь' || $match[0] == 'душевно' || $match[0] == ' мат ' || $match[0] == ' мата'){
                            $pivGrade +=2;
                        }elseif ($match[0] == 'угар' || $match[0] == 'поржал'){
                            $pivGrade +=1;
                        }

                           echo $match[0];
                        echo $IdFilm;

                    }




                    }
                }

            }
            $pivGradeFinal = $pivGrade + $countryTest + $yearTest;
            if(!empty($IdTest)) {
                $addFilm = ParserAdd::getById($IdTest);
                $addFilm->setPivgrade($pivGradeFinal);
                $addFilm->save();
                file_put_contents('Z:\\5.log', date(DATE_ISO8601) . ' ' . $pivGradeFinal .  '  ' . $IdTest . '    ' . $pivGrade . PHP_EOL, FILE_APPEND);


            }

        }

    }



}
