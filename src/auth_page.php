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
    <link rel="stylesheet" href="static/footer.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="static/auth.js" defer></script>

</head>


<body>
    <?php require_once 'shapka.php';?>

    <div class="container"><!-- основной контент -->
        <?php require_once 'shapka_menu.php';?>

        <h1 class = "head_word">Авторизация</h1>
        <form class = "admin_form" id = "auth_form" method="POST">
            <label class="form_word">Логин:</label>
            <input class = "input_form" type="text" id="admin_name" name="admin_name" placeholder="Введите логин"><br>
            <label class = "form_word">Пароль:</label>
            <input class = "input_form" type="password" id="admin_password" name="admin_password" placeholder="Введите пароль"><br>
            <div class="auth_message" id="auth_message"></div>
            <button name = "auth" >Войти</button>
        </form>

        <!-- Кнопка входа через VK -->
        <div class="vk-auth-container">
            <a href="auth_vk/index.php" class="vk-auth-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5.5 13.5c-.3.4-.8.5-1.2.5-.4 0-.9-.2-1.4-.5-.3-.2-.6-.3-.9-.3-.3 0-.6.1-.9.3-.5.3-1 .5-1.4.5-.4 0-.9-.1-1.2-.5-.3-.3-.4-.7-.4-1.2 0-.5.1-.9.4-1.2.3-.3.8-.5 1.2-.5.4 0 .9.2 1.4.5.3.2.6.3.9.3.3 0 .6-.1.9-.3.5-.3 1-.5 1.4-.5.4 0 .9.2 1.2.5.3.3.4.7.4 1.2 0 .5-.1.9-.4 1.2z"/>
                </svg>
                Войти через VK
            </a>
        </div>
    </div>

    <!-- <form method="GET" action="auth_vk/index.php">
        <button type="submit" name="auth">Войти VK</button>
    </form> -->
    </div>
    <?php require_once 'footer.php';?>
</body>

</html>