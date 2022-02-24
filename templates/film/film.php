<?php include __DIR__ . '/../header.php'; ?>
    <div class="post-home">

        <span><?= $film->getName(); ?></span>
        <img src="<? echo $film->getPoster()?>"  width="189" height="255" alt="lorem"/>


    <table class="table-hom">
        <tbody class="tbody-hom">
        <tr>
            <td class="naz">Страна:</td>
            <td><?= $film->getCountry();?></td>
        </tr>
        <tr>
            <td class="naz">Жанр:</td>
            <td><?= $film->getGenre() ?></td>
        </tr>
        <tr>
            <td class="naz">Оценка:</td>
            <td><?= $film->getGrade() ?></td>
        </tr>
        <tr>
            <td class="naz">Продолжительность:</td>
            <td><?= $film->getTime() ?></td>
        </tr>
        <tr>
            <td class="naz">Год:</td>
            <td><?= $film->getYear() ?></td>
        </tr>
        <tr>
            <td class="naz">Пивной рейтинг:</td>
            <td><?= $film->getPivgrade() ?></td>
        </tr>




        </tbody>

    </table>
    </div>
    <?php

    if(!empty($film->getUrllive())){ ?>
    <a href="<?= $film->getUrllive() ?>" class="button7" target="_blank">DLive</a>
    <?php } else { ?>
        <a href="https://yandex.ru/search/?text=<?=$film->getName()?> site:https://doramalive.ru" class="button7" target="_blank">DLive'</a>
    <?php }?>
    <a href="<?= $film->getUrlclub() ?>" class="button8" target="_blank">DClub</a>

    <div class="desc">





    <p ><hr>Описание: <?= $film->getDescription() ?></p>
</div>


<?php include __DIR__ . '/../footer.php';


?>