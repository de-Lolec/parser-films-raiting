<?php

return [
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'],
    '~^film/(\d+)$~' => [\MyProject\Controllers\FilmController::class, 'film'],
    '~^page=(\d+)/route=sort$~' => [\MyProject\Controllers\FilmController::class, 'sortPages'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/exit$~' => [\MyProject\Controllers\UsersController::class, 'exit'],
    '~^users/pd-admin$~' => [\MyProject\Controllers\UsersController::class, 'PDadmin'],
    '~^users/pd-update$~' => [\MyProject\Controllers\ParserControllerClub::class, 'controlParser'],
    '~^users/user/$~' => [\MyProject\Controllers\ProfileController::class, 'PDadmin'],
];