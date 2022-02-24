<?php

namespace MyProject\Controllers;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Films\Films;
use MyProject\Models\parsers\Parser;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Models\parsers\CommentAdd;


class CommentController extends ActiveRecordEntity
{
    public static function commentAdd($commFind, $origname)
    {

        if (!is_array($origname)) {

            foreach ($commFind as $comm) {
                $commPq = pq($comm);
                $AllComm = trim($commPq->text());
                $checkComm = new CommentAdd();
                $check = $checkComm::getCommentCheck($AllComm);

                if (empty($check)) {


                    $FilmId = ParserAdd::getIdByOrig($origname);

                    if (!empty($FilmId)) {

                        $addComment = new CommentAdd();
                        $addComment->setFilmId($FilmId);
                        //  $addComment->setOrigName($FilmId);
                        $addComment->setComment($AllComm);
                        $addComment->save();
                        var_dump($addComment);
                        //  echo $orig;
                    }
                }

            }
            } else {
            foreach ($commFind as $comm) {
                $commPq = pq($comm);

                $AllComm = trim($commPq->text());

                $checkComm = new CommentAdd();
                $check = $checkComm::getCommentCheck($AllComm);

                if (empty($check)) {
                    foreach ($origname as $orig) {
                        if (!empty($orig)) {
                            $FilmId = ParserAdd::getIdByOrig($orig);

                        if (!empty($FilmId)) {
                            $addComment = new CommentAdd();
                            $addComment->setFilmId($FilmId);
                            $addComment->setComment($AllComm);
                            $addComment->save();
                        }
                        }
                    }
                }
            }
        }

            return $AllComm;

        }


    protected static function getTableName(): string
    {
        return 'comment';
    }
}