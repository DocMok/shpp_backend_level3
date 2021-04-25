<?php $data = $bodyData['bodyData'][0]; ?>
<script id="pattern" type="text/template">
    <div data-book-id="<?= $data['book_id'] ?>" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
        <div class="book">
            <a href="book/<?= $data['book_id'] ?>"><img src="<?= '/uploads/' . $data['cover'] ?>"
                                                        alt="<?= $data['title'] ?>">
                <div data-title="<?= $data['title'] ?>" class="blockI">
                    <div data-book-title="<?= $data['title'] ?>" class="title size_text"><?= $data['title'] ?></div>
                    <div data-book-author="<?= $data['authors'] ?>" class="author"><?= $data['authors'] ?></div>
                </div>
            </a>
            <a href="book/<?= $data['book_id'] ?>">
                <button type="button" class="details btn btn-success">Читать</button>
            </a>
        </div>
    </div>
</script>
<div id="id" book-id="<?= $data['book_id'] ?>">
    <div id="bookImg" class="col-xs-12 col-sm-3 col-md-3 item" style="
    margin:;
"><img src="<?= '/uploads/' . $data['cover'] ?>" alt="Responsive image" class="img-responsive">

        <hr>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 info">
        <div class="bookInfo col-md-12">
            <div id="title" class="titleBook"><?= $data['title'] ?></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="bookLastInfo">
                <div class="bookRow"><span class="properties">автор:</span><span
                            id="author"><?= $data['authors'] ?></span></div>
                <div class="bookRow"><span class="properties">год:</span><span id="year"><?= $data['year'] ?></span>
                </div>
            </div>
        </div>
        <div class="btnBlock col-xs-12 col-sm-12 col-md-12">
            <button type="button" class="btnBookID btn-lg btn btn-success">Хочу читать!</button>
        </div>
        <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-sm">
            <h4>О книге</h4>
            <hr>
            <p id="description"><?= $data['description'] ?></p>
        </div>
    </div>
    <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-md hidden-lg">
        <h4>О книге</h4>
        <hr>
        <p class="description"><?= $data['description'] ?></p>
    </div>
</div>
<script src="/views/js/book.js" defer=""></script>
</div>