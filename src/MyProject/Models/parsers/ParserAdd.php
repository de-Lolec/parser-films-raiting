<?php

namespace MyProject\Models\parsers;


use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\parsers\Parser;
use MyProject\Services\Db;
use MyProject\View\View;
use MyProject\Controllers\PivoController;

use phpQuery;



class ParserAdd extends ActiveRecordEntity
{




    protected $name;
    protected $country;
    protected $genre;
    protected $grade;
    protected $year;
    protected $poster;
    protected $time;
    protected $description;
    protected $orig_name;
    protected $pivgrade;
    protected $urllive;
    protected $urlclub;


    public function setNameFilm(string $name){
        $this-> name = $name;
    }
    public function setGenre(string $genre){
        $this-> genre = $genre;
    }
    public function setGrade(string $grade){
        $this-> grade = $grade;
    }
    public function setYear(string $year){
        $this-> year = $year;
    }
    public function setPoster($poster){
        $this-> poster = $poster;
    }
    public function setTime(string $time){
        $this-> time = $time;
    }
    public function setDescription(string $description){
        $this-> description = $description;
    }
    public function setCountry(string $country){
        $this-> country = $country;
    }
    public function setOriginal(string $orig_name){
        $this-> orig_name = $orig_name;
    }
    public function setPivgrade($pivgrade){
        $this-> pivgrade = $pivgrade;
    }
    public function setUrllive($urllive){
        $this-> urlllive = $urllive;
    }
    public function setUrlClub($urlclub){
        $this-> urlclub = $urlclub;
    }
    public function getUrlClub()
    {
        return $this->urlclub;
    }
    public function getUrllive()
    {
        return $this->urllive;
    }
    public function getPivgrade()
    {
        return $this->pivgrade;
    }
    public function getNameFilm()
    {
        return $this->name;
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function getGrade()
    {
        return $this->grade;
    }
    public function getYear()
    {
        return $this->year;
    }
    public function getPoster()
    {
        return $this->poster;
    }
    public function getTime()
    {
        return $this->time;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function getOriginal()
    {
        return $this->orig_name;
    }
    public function getName()
    {
        return $this->name;
    }


    protected static function getTableName(): string
    {
        return 'block';
    }
}


