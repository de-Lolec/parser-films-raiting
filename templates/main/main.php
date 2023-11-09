<?php

use MyProject\Controllers\ParserControllerLive;
use MyProject\Controllers\PivoController;
use MyProject\Models\parsers\Parser;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Controllers\ParserControllerClub;
use MyProject\Controllers\FilmController;
use MyProject\Controllers\CommentController;
include __DIR__ . '/../header.php';
?>

<?php  // PivoController::commentAnalyze(); ?>
<?php // ParserControllerClub::addBlockClub();?>
<?php  //   ParserControllerLive::addBlockLive();?>
<?php // $vsr = FilmController::PageMain($addFilm);?>
        <?php //foreach($vsp as $value): ?>


<?php
foreach ($vsr as $Film):

?>
    <div class="pod-poster">
        <?php
        if(!empty($Film->getUrllive())){ ?>
            <a href="<?= $Film->getUrllive() ?>" class="button1" target="_blank">DLive</a>
        <?php } else { ?>
            <a href="https://yandex.ru/search/?text=<?=$Film->getName()?> site:https://doramalive.ru фильм" class="button1" target="_blank">DLive'</a>
        <?php }?>
        <a href="<?= $Film->getUrlclub() ?>" class="button2" target="_blank">DClub</a>
    </div>
<div class="post-home">
    <a href="/film/<?= $Film->getId()?>">
    <span>
        <?= $Film->getName(); ?>


    </span>

        <img src="<? echo $Film->getPoster()?>"  width="189" height="255" alt="lorem"/>


    </a>



    <table class="table-hom">

        <tbody class="tbody-hom">
        <tr>
            <td class="naz">Страна:</td>
            <td><?= $Film->getCountry();?></td>

        </tr>
        <tr>
            <td class="naz">Жанр:</td>
            <td><?= $Film->getGenre() ?></td>
        </tr>
        <tr>
            <td class="naz">Оценка:</td>
            <td><?= $Film->getGrade() ?></td>
        </tr>
        <tr>
            <td class="naz">Продолжительность:</td>
            <td><?= $Film->getTime() ?></td>
        </tr>
        <tr>
            <td class="naz">Год:</td>
            <td><?= $Film->getYear() ?></td>
        </tr>
        <tr>
            <td class="naz">Пивной рейтинг:</td>
            <td><?= $Film->getPivgrade() ?></td>
        </tr>

        <tr>
            <td class="naz">Описание</td>
            <td class="nazdes"><?= $Film->getDescription() ?></td>
        </tr>
        </tbody>
    </table>

<hr>
</div>

<?php endforeach;


?>
    <div style="text-align: center">
        <?php

        for ($pageNum = $currentPageNum-5; $pageNum <= $pagesCount; $pageNum++): ?>
            <?php if ($currentPageNum+6 <= $pageNum):
                break;
                ?>
            <?php endif;?>
            <?php if ($currentPageNum == $pageNum): ?>
                <b><?= $pageNum ?></b>

            <?php elseif($pageNum > 0): ?>
                <a href="/<?=  $pageNum . $pageSortNum ?>"><?= $pageNum ?></a>

            <?php endif;?>

        <?php endfor; ?>
    </div>

<?php include __DIR__ . '/../footer.php';?>