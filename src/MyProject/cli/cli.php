<?php

namespace MyProject\cli;

use MyProject\Controllers\ParserControllerClub;
use MyProject\cli\tar;
use MyProject\Controllers\PivoController;

//class CronAdd
//{
//require_once __DIR__ . '/' . str_replace('\\', '/', 'ParserControllerClub') . '.php';
//require_once __DIR__ . '/../Controllers/ParserControllerClub.php';
spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../../' . str_replace('\\', '/', $className) . '.php';
});
//$className = '\\MyProject\\Controllers\\' . array_shift($argv);
//$down = new $className();
//$down -> dva();

//public function tre()
//{
//    echo 'иди нахуй';
//
//    tar::re();
//
//    file_put_contents('Z:\\5.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);

//ParserControllerClub::addBlockClub();
ParserControllerClub::addBlockLive();
//PivoController::commentAnalyze();

//$updatePivGrade = new \MyProject\Controllers\PivoController;
//$updateContent -> addBlockClub();
//$updateContent -> addBlockLive();
//$updatePivGrade -> commentAnalyze();
//}

//  echo 'иди нахуй';
//    $up = new \MyProject\cli\tar;
//    $up -> re();
//    tar::re();

 //   file_put_contents('Z:\\5.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);


//}