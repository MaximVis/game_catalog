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
    <script src="https://unpkg.com/@vkid/sdk@2.0.0/dist/vkid.sdk.js"></script>
    <script src="static/auth.js" defer></script>
</head>

<body>
    <?php require_once 'shapka.php';?>

    <div class="container">
        <?php require_once 'shapka_menu.php';?>

        <h1 class="head_word">Авторизация</h1>
        <form class="admin_form" id="auth_form" method="POST">
            <label class="form_word">Логин:</label>
            <input class="input_form" type="text" id="admin_name" name="admin_name" placeholder="Введите логин"><br>
            <label class="form_word">Пароль:</label>
            <input class="input_form" type="password" id="admin_password" name="admin_password" placeholder="Введите пароль"><br>
            <div class="auth_message" id="auth_message"></div>
            <button name="auth">Войти</button>
        </form>

        <!-- Кнопка VK ID -->
        <div id="vkAuthButton" class="vk-id-button">
            <button type="button" class="vk-auth-btn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0Z" fill="#07F"/>
                    <path d="M14.5 6.5H12.5C11.95 6.5 11.5 6.95 11.5 7.5V9.5H14.5V11H11.5V15H9.5V11H7.5V9.5H9.5V7.5C9.5 5.84 10.84 4.5 12.5 4.5H14.5V6.5Z" fill="white"/>
                </svg>
                Войти через VK ID
            </button>
        </div>
    </div>

    <?php require_once 'footer.php';?>
</body>
</html>
