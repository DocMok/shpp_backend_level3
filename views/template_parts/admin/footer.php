
</ul>
</nav>

</div>
<div class="col-5">
    <form method="post" action="addBook/" enctype="multipart/form-data">
        <fieldset class="form-group">
            <legend>Добавить новую книгу</legend>
            <div class="row mb-3">
                <div class="col-7">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="bookName" name="bookname"
                               placeholder="Название книги">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="year" name="year" placeholder="Год издания">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="imageLoader" name="cover">
                    </div>
                    <span id="preview"></span>
                </div>
                <div class="col-5">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="author1" name="author1"
                               placeholder="Автор 1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="author2" name="author2"
                               placeholder="Автор 2">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="author3" name="author3"
                               placeholder="Автор 3">
                    </div>
                    <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here"
                                          id="floatingTextarea2" name="description" style="height: 150px;"></textarea>
                        <label for="floatingTextarea2">Описание книги</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-content-center">
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Добавить ></button>
                </div>
                <div class="col-6">
                    <p class="text-end">
                        *оставьте поля пустыми, если авторов меньше 3
                    </p>
                </div>
            </div>
        </fieldset>
    </form>
</div>
</div>
</div>
</body>
<script>
    <!--Image preview loader-->
    function handleFileSelect(evt) {
        var file = evt.target.files; // FileList object
        var f = file[0];
        // Only process image files.
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                var span = document.getElementById('preview');
                span.innerHTML = ['<img class="thumb preview" title="preview" src="', e.target.result, '" />'].join('');
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }

    document.getElementById('imageLoader').addEventListener('change', handleFileSelect, false);
</script>
</html>