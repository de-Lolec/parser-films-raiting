<?php

namespace MyProject\Controllers;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Films\Films;
use MyProject\View\View;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Models\parsers\CommentAdd;


class UrlController extends ActiveRecordEntity
{
    public static function liveAdd($url, $origname)
    {

        $check = self::getUrlCheck($url);
        if (empty($check)) {
            if (is_array($origname)) {

                foreach ($origname as $orig) {

                    if (!empty($orig)) {
                        $addUrl = ParserAdd::getIdByOrig($orig);

                        if (!empty($addUrl)) {

                            $addUrl->setUrllive($url);
                            $addUrl->save();

                        }
                    }
                }

            } else {
                if (!empty($origname)) {
                    $addUrl = ParserAdd::getIdByOrig($origname);
                    if (!empty($addUrl)) {

                        $addUrl->setUrlClub($url);

                        $addUrl->save();
                        var_dump($addUrl);
                    }
                }
            }
        }
    }
    protected static function getTableName(): string
    {
        return 'block';
    }
}