<?php include __DIR__ . '/../header.php'; ?>
    <div style="text-align: left;">
        <form action="/users/pd-update" method="POST">
            <p>Обновить:</p>

            <label>

                <input type="checkbox" name="update[]" value="addBlockClub">

                <span>ДорамаКлаб</span>
                <br>
                <input type="checkbox" name="update[]" value="addBlockLive">
                <span>ДорамаЛайв(Ссылки, комментарии)</span>
                <br>
                <input type="checkbox" name="update[]" value="commentAnalyze">
                <span>По пиву</span>
                <br>
                <input type="submit" value="Обновить">

        </form>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>