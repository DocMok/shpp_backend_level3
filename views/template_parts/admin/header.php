<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <?php echo '<link href="http://'.$_SERVER['HTTP_HOST']. '/views/css/bootstrap.min.css" rel="stylesheet">'; ?>
    <style>
        .preview {
            display: block;
            max-width: 100%;
            max-height: 100%;
        }

        .img-mini {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container h-100">
    <div class="row align-items-center justify-content-between">
        <div class="col-4">
            <h2 class="display-6"><a href="/admin/">Library++ Admin Panel</a></h2>
            <h2 class="display-6"><a href="/">Library++ Home</a></h2>
        </div>
        <div class="col-2 text-end">
            <a href="http://logout:logout@<?= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" class="display-6">Logout</a>
        </div>
    </div>
    <div class="row align-items-start">
        <div class="col-7">