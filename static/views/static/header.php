<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="interkassa-verification" content="bc812fb8c6ab49f57fda2333a20deba6">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Document</title>
	
	<link href="/static/css/bootstrap.css" rel="stylesheet">
	<link href="/static/css/buttons.css" rel="stylesheet">
    <link href="/static/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/font-awesome.min.css">

	<script src="/static/js/time.js"></script>
    <script src="/static/js/googleReCaptcha.js"></script>
    <script src="/static/js/buttons.js"></script>
    <script src="/static/js/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://use.fontawesome.com/987a522823.js"></script>

</head>
<body>
	<div class="hiddenLine">
        <div class="header">
            <div class="container">
                <div class="">
                    <div class="row">
                        <div class="col-sm-4 headerContainer">
                            <div class="logo">
                                <h1>
                                    <span>
                                        cwdw.tv
                                    </span>
                                </h1>
                            </div>
                        </div>
                        <div class="col-sm-8 headerContainer">
                            <div class="menu">
                                
                                <?php if( !empty( $_SESSION['user'] ) ) : ?>
                                    <ul>
                                        <li>
                                            <a href="/home" class="butn <?php if( !empty( $active ) and $active == '/home' ) : ?>active<?php endif; ?>">Новости</a>
                                        </li>
                                        <li>
                                            <a href="/packages" class="butn <?php if( !empty( $active ) and $active == '/packages' ) : ?>active<?php endif; ?>">Пакеты</a>
                                        </li>
                                        
                                        <li>
                                            <a href="/balance" class="butn <?php if( !empty( $active ) and $active == '/balance' ) : ?>active<?php endif; ?>">Баланс: <?php echo $balance ?>$</a>
                                        </li>
                                        <li>
                                            <a href="/iptv" class="butn <?php if( !empty( $active ) and $active == '/iptv' ) : ?>active<?php endif; ?>">IpTV</a>
                                        </li>
                                        <li>
                                            <a href="/settings" class="butn <?php if( !empty( $active ) and $active == '/settings' ) : ?>active<?php endif; ?>">Настройки</a>
                                        </li>
                                        <li>
                                            <a href="/logout" class="butn">Выход</a>
                                        </li>
                                    </ul>
                                <?php elseif( empty( $_SESSION['user'] ) ) : ?>
                                    <ul>
                                        <li>
                                            <a href="/" class="butn <?php if( !empty( $active ) and $active == '/' or $active == '/index' ) : ?>active<?php endif; ?>">Главная</a>
                                        </li>
                                        <li>
                                            <a href="/register" class="butn <?php if( !empty( $active ) and $active == '/register' ) : ?>active<?php endif; ?>">Регистрация</a>
                                        </li>
                                        <li>
                                            <a href="/login" class="butn <?php if( !empty( $active ) and $active == '/login' ) : ?>active<?php endif; ?>">Авторизация</a>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            

        <div class="botTop">
            <?php 
                if( !empty( $_SESSION['user'] ) and !empty( $status ) and $status == 'admin' )
                {
                    echo '<div class="container">';
                        echo '<ul class="center">';
                            echo '<center>';
                                echo '<li>';
                                    echo '<a href="/users" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/users' ) echo 'active';
                                    echo '">Пользователи</a>';
                                echo '</li>';
                                echo '<li>';
                                    echo '<a href="/resserlers" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/resserlers' ) echo 'active';
                                    echo '">Ресселеры</a>';
                                echo '</li>';
                                echo '<li>';
                                    echo '<a href="/services" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/services' ) echo 'active';
                                    echo '">Услуги</a>';
                                echo '</li>';
                                echo '<li>';
                                    echo '<a href="/events" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/events' ) echo 'active';
                                    echo '">События</a>';
                                echo '</li>';
                                echo '<li>';
                                    echo '<a href="/packagessettings" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/packagessettings' ) echo 'active';
                                    echo '">Пакеты - Управление</a>';
                                echo '</li>';
                                echo '<li>';
                                    echo '<a href="/iptvsettings" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/iptvsettings' ) echo 'active';
                                    echo '">IpTv - Управление</a>';
                                echo '</li>';
                            echo '</center>';
                        echo '</ul>';
                    echo '</div>';
                }
                elseif( !empty( $_SESSION['user'] ) and !empty( $status ) and $status == 'resseler' )
                {
                    echo '<div class="container">';
                        echo '<ul class="center">';
                            echo '<center>';
                                echo '<li>';
                                    echo '<a href="/users" class="buttonAdmin ';
                                        if( !empty( $active ) and $active == '/users' ) echo 'active';
                                    echo '">Пользователи</a>';
                                echo '</li>';
                            echo '</center>';
                        echo '</ul>';
                    echo '</div>';
                }
            ?>
        </div>  

        <div class="content">
            <div class="container center">
            
        
    

    