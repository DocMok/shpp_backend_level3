<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>shpp-library</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="library Sh++">
    <?php echo '<link href="http://' . $_SERVER['HTTP_HOST'] . '/views/css/libs.min.css" rel="stylesheet">'; ?>
    <?php echo '<link href="http://' . $_SERVER['HTTP_HOST'] . '/views/css/style.css" rel="stylesheet">'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
          crossorigin="anonymous"/>
    <style>
        .details {
            display: none;
        }
    </style>
</head>

<body data-gr-c-s-loaded="true" class="">
<section id="header" class="header-wrapper">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2">
                <div class="logo"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>" class="navbar-brand"><span
                                class="sh">Ш</span><span class="plus">++</span></a></div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
                <div class="main-menu">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form id="form_search" action="http://<?= $_SERVER['HTTP_HOST'] ?>/search"
                              class="navbar-form navbar-right" method="post">
                            <div class="form-group">
                                <input id="search" type="text" placeholder="Введите свой запрос" class="form-control"
                                       name="search">
                                <script>
                                    $("#search").bind("keypress", function (e) {
                                        if (e.keyCode == 13) {
                                            e.preventDefault();
                                            $("#form_search").submit();
                                        }
                                    })
                                </script>
                                <div id="list" size="" class="bAutoComplete mSearchAutoComplete"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2 hidden-xs">
                <div class="social"><a href="https://www.facebook.com/shpp.kr/" target="_blank"><span
                                class="fa-stack fa-sm"><i class="fa fa-facebook fa-stack-1x"></i></span></a><a
                            href="http://programming.kr.ua/ru/courses#faq" target="_blank"><span class="fa-stack fa-sm"><i
                                    class="fa fa-book fa-stack-1x"></i></span></a></div>
            </div>
        </div>
    </nav>
</section>
<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">