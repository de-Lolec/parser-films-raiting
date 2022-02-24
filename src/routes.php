<?php

return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^page/(.+)$~' => [\MyProject\Controllers\FilmController::class, 'mainPages'],
    '~^film/(\d+)$~' => [\MyProject\Controllers\FilmController::class, 'film'],
    '~^sort$~' => [\MyProject\Controllers\FilmController::class, 'sortPages'],
    '~^page=(\d+)/route=sort$~' => [\MyProject\Controllers\FilmController::class, 'sortPages'],

];