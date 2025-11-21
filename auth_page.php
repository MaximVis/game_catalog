<?php

    require_once 'auth_func.php';
    if (isUserLoggedIn()) {
        header('Location: admin_page.php');
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="ru">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталог игр</title>
    <link rel="stylesheet" href="static/base_styles.css">
    <link rel="stylesheet" href="static/auth_styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="static/auth.js" defer></script>

</head>


<body>
    <?php require_once 'shapka.php';?>

    <div class="container"><!-- основной контент -->
        <?php require_once 'shapka_menu.php';?>

        <div class = "head_word">Авторизация</div>
        <form class = "admin_form" id = "auth_form" method="POST">
            <div class = "form_word">Логин:</div>
            <input class = "input_form" type="text" id="admin_name" name="admin_name" placeholder="Введите логин"><br>
            <div class = "form_word">Пароль:</div>
            <input class = "input_form" type="password" id="admin_password" name="admin_password" placeholder="Введите пароль"><br>
            <div class="auth_message" id="auth_message"></div>
            <button name = "auth" >Войти</button>
        </form>
        <form method="GET" action="auth_vk/index.php">
            <button type="submit" name="auth">Войти VK</button>
        </form>
        <a href="auth_vk/vk_auth.php" class="vk-auth-btn">
                Войти через VK
        </a>
    </div>

</body>

</html>