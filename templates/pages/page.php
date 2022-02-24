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

    <div class = "pages">

<!-- Главная страница без сортировки -->

<?php
if(empty($pageSortNum) and $pageNum <= 4 ) {?>

    <?for ($i=1;$i<=8;$i++) :?>
    <button onclick="window.location.href='http://podpivo/page/<?=$i?>'" class="btn" ><?= $i?></button>
    <? endfor;?>

    <!-- След страницы без сортировки -->

<?}elseif( empty($pageSortNum) and $pageNum >= 4) {?>

    <button onclick="window.location.href='http://podpivo/page/1'" class="btn">1</button>
    <button class="btn">...</button>
    <?
    $j = $pageNum;
    for($pageNum -= 2; $pageNum <= ceil((count($allSortFilms)-$pageNum))/10 ;$pageNum++) :
        ?>

        <? if($pageNum >= $j +5){
        break;
    }?>
    <button onclick="window.location.href='http://podpivo/page/<? echo $pageNum ?>'" class="btn"><? echo $pageNum ?></button>

   <? endfor; ?>

    <!-- Главная страница с сортировкой -->

<? } elseif(!empty($pageSortNum) and $pageNum <= 5) {?>

    <?for ($i=1;$i<=8;$i++) :?>
    <button onclick="window.location.href='<? echo 'http://podpivo/page=' . $i . '/route=' . $pageSortNum ?>'" class="btn"><?= $i?></button>
 <? endfor;?>
    <!-- След страницы с сортировкой -->
<?} elseif(!empty($pageSortNum) and $pageNum > 5){
    ?>

    <button onclick="window.location.href='<? echo 'http://podpivo/page=1/route=' . $pageSortNum ?>'" class="btn">1</button>
    <button class="btn">...</button>
    <?
    $j = $pageNum;
    for($pageNum -= 2; $pageNum <= ceil(count($allSortFilms)/10) ;$pageNum++){
      ?>
        <? if($pageNum >= $j +5){
            break;
        }?>
    <button onclick="window.location.href='http://podpivo/page=<? echo $pageNum  .  '/route=' . $pageSortNum ?>'" class="btn"><? echo $pageNum?></button>


<?php
    }
}
?>
    </div>

<?php include __DIR__ . '/../footer.php';?>