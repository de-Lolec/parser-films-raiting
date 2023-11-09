<?php
use MyProject\Models\Users\UsersAuthService;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Под пиво</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<table class="layout">
    <tr >
                <td colspan="2" class="header">
            <a href=/> Под пиво </a>

            <hr>

        </td>

    </tr>
    <tr>
        <td colspan="2" style="text-align: right">

            <?php if(empty($user)): ?>

                <a href="/users/login">Войти</a>
                <a>|</a>
                <a href="/users/register">Регистрация</a>
            <? endif?>

            <?php if($user = UsersAuthService::getUserByToken()): ?>
                <a href="/users/pd-admin">Админка</a>
                <a>|</a>
                <a href="/users/<?$id?>">Профиль</a>
                <a>|</a>
                <a href="/users/exit">Выйти</a>
      <? endif?>
        </td>
    </tr>
    <tr>
        <td>