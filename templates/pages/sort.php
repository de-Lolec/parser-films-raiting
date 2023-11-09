<?php
use MyProject\Models\parsers\Parser;
use MyProject\Models\parsers\ParserAdd;
use MyProject\Controllers\ParserControllerClub;
use MyProject\Controllers\ParserControllerLive;
use MyProject\Controllers\FilmController;
include __DIR__ . '/../header.php';
?>

<?php //$vsp = ParserController::addBlock() ?>

<?php // $vsr = FilmController::Page();?>
<?php //foreach($vsp as $value): ?>


<?php
foreach ($sortPage as $Film):

    ?>
    <div class="pod-poster">
        <?php
        if(!empty($Film->getUrllive())){ ?>
            <a href="<?= $Film->getUrllive() ?>" class="button1" target="_blank">DLive</a>
        <?php } else { ?>
            <a href="https://yandex.ru/search/?text=<?=$Film->getName()?> site:https://doramalive.ru" class="button1" target="_blank">DLive</a>
            <?php }?>
    </div>
    <div class="post-home">
        <a href="/film/<?= $Film->getId()?>">
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

<?php endforeach;

?>

<?php switch ($pageNum):
    case null:?>
        <button onclick="window.location.href='<? echo '/page=1/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">1</button>
        <button onclick="window.location.href='<? echo '/page=2/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">2</button>
        <button onclick="window.location.href='<? echo '/page=3/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">3</button>
        <button onclick="window.location.href='<? echo '/page=4/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">4</button>
        <button onclick="window.location.href='<? echo '/page=5/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">5</button>
        <button onclick="window.location.href='<? echo '/page=6/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">6</button>
        <button onclick="window.location.href='<? echo '/page=7/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">7</button>
        <button onclick="window.location.href='<? echo '/page=8/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">8</button>
        <? break;?>
   <? case 2:?>
        <button onclick="window.location.href='<? echo '/page=1/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">1</button>
        <button onclick="window.location.href='<? echo '/page=2/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">2</button>
        <button onclick="window.location.href='<? echo '/page=3/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">3</button>
        <button onclick="window.location.href='<? echo '/page=4/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">4</button>
        <button onclick="window.location.href='<? echo '/page=5/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">5</button>
        <button onclick="window.location.href='<? echo '/page=6/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">6</button>
        <button onclick="window.location.href='<? echo '/page=7/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">7</button>
        <button onclick="window.location.href='<? echo '/page=8/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">8</button>
        <? break;?>
    <? case 3:?>
        <button onclick="window.location.href='<? echo '/page=1/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">1</button>
        <button onclick="window.location.href='<? echo '/page=2/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">2</button>
        <button onclick="window.location.href='<? echo '/page=3/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">3</button>
        <button onclick="window.location.href='<? echo '/page=4/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">4</button>
        <button onclick="window.location.href='<? echo '/page=5/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">5</button>
        <button onclick="window.location.href='<? echo '/page=6/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">6</button>
        <button onclick="window.location.href='<? echo '/page=7/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">7</button>
        <button onclick="window.location.href='<? echo '/page=8/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">8</button>
        <?break;?>
    <? case 4:?>
        <button onclick="window.location.href='<? echo '/page=1/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">1</button>
        <button onclick="window.location.href='<? echo '/page=2/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">2</button>
        <button onclick="window.location.href='<? echo '/page=3/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">3</button>
        <button onclick="window.location.href='<? echo '/page=4/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">4</button>
        <button onclick="window.location.href='<? echo '/page=5/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">5</button>
        <button onclick="window.location.href='<? echo '/page=6/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">6</button>
        <button onclick="window.location.href='<? echo '/page=7/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">7</button>
        <button onclick="window.location.href='<? echo '/page=8/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">8</button>
        <?break;?>
    <? default: ?>
        <button onclick="window.location.href='<? echo '/page=1/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">1</button>
        <button onclick="window.location.href='<? echo '/page=2/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">2</button>
        <button onclick="window.location.href='<? echo '/page=3/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">3</button>
        <button onclick="window.location.href='<? echo '/page=4/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">4</button>
        <button onclick="window.location.href='<? echo '/page=5/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">5</button>
        <button onclick="window.location.href='<? echo '/page=6/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">6</button>
        <button onclick="window.location.href='<? echo '/page=7/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">7</button>
        <button onclick="window.location.href='<? echo '/page=8/' . $_SERVER['QUERY_STRING']; ?>'" class="btn">8</button>
    <?php endswitch; ?>
    </div>

<?php include __DIR__ . '/../footer.php';?>