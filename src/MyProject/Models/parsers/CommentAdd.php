<?php

namespace MyProject\Models\parsers;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Controllers\PivoController;
use MyProject\Services\Db;
use MyProject\View\View;
use phpQuery;

class CommentAdd extends ActiveRecordEntity
{

    protected $comment;

    protected $filmId;


    public function setComment($comment){
        $this -> comment = $comment;
}

    public function setFilmId($filmId)
    {
        $this -> filmId = $filmId -> getId();
    }
    public function getFilmId()
    {
        return ParserAdd::getById($this->id);
    }
    public function getFilmIdComment()
    {
        return $this->filmId;
    }
    public function getComment()
    {
        return $this->comment;
    }

    protected static function getTableName(): string
    {
        return 'comment';
    }

}