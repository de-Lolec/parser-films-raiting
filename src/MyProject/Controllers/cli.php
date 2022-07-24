<?php



spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
});
$className = '\\MyProject\\Controllers\\' . array_shift($argv);
$down = new $className();
$down -> dva();

file_put_contents('Z:\\5.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);

