<?php
use MyProject\Models\parsers\Parser;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Controllers\ParserController;
use MyProject\Controllers\FilmController;
include __DIR__ . '/../header.php';
?>

<?php //$vsp = ParserController::addBlock() ?>
<?php // $vsr = FilmController::Page();?>
<?php //foreach($vsp as $value): ?>


<?php
foreach ($filmPage as $Film):

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
        <a href="http://podpivo/film/<?= $Film->getId()?>">
            <span><?= $Film->getName(); ?></span>
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

    </div>
<hr>
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
                    <a href="/<?= 'page=' . $pageNum . '/route=' . $pageSortNum ?>"><?= $pageNum ?></a>

                <?php endif;?>

            <?php endfor; ?>
        </div>




<?php include __DIR__ . '/../footer.php';?>