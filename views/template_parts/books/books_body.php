<?php foreach ($bodyData['data'] as $record):?>
    <div data-book-id="<?= $record['book_id'] ?>" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
        <div class="book">
            <a href="book/<?= $record['book_id'] ?>"><img src="<?= '/uploads/' . $record['cover'] ?>" alt="<?= $record['title'] ?>">
                <div data-title="<?= $record['title'] ?>" class="blockI" style="height: 46px;">
                    <div data-book-title="<?= $record['title'] ?>" class="title size_text"><?= $record['title'] ?></div>
                    <div data-book-author="<?= $record['authors'] ?>" class="author"><?= $record['authors'] ?></div>
                </div>
            </a>
            <a href="book/<?= $record['book_id'] ?>">
                <button type="button" class="details btn btn-success">Читать</button>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="col-12">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">