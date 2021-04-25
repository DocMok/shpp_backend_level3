<table class="table">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col">Название книги</th>
        <th scope="col">Авторы</th>
        <th scope="col">Год</th>
        <th scope="col">Действия</th>
        <th scope="col">Клики</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($bodyData['data'] as $record): ?>
        <tr id="<?= $record['book_id'] ?>">
            <td scope="row">
                <img class="img-mini" src="<?= '/uploads/' . $record['cover'] ?>">
            </td>
            <th scope="row"><a target="_blank" href="/book/<?= $record['book_id'] ?>"><?= $record['title'] ?></a></th>
            <td>
                <?= $record['authors'] ?>
            </td>
            <td><?= $record['year'] ?></td>
            <td><a href="deletebook/?id=<?= $record['book_id'] ?>">удалить</a></td>
            <td><?= $record['views'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

