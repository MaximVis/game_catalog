<?php

    require_once 'auth_func.php';

    if (!isUserLoggedIn()) {
        header('Location: auth_page.php');
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
    <link rel="stylesheet" href="static/admin_styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="static/CRUD_Genre_Category.js" defer></script>
</head>

<body>
    <?php require_once 'shapka.php';?>
    
    <div class="container"><!-- основной контент -->
		<?php require_once 'shapka_menu.php';?>

        <div class="header_">
            <span class="login"><?php echo $_SESSION['user_login']; ?></span>
            <a href="?action=logout" class="logout">Выход</a>
        </div>

        <?php

            require_once 'auth_func.php';

            if (isset($_GET['action']) && $_GET['action'] === 'logout') {
                logoutUser();
                header('Location: auth_page.php');
                exit;
            }

        ?>

        <div class = "head_word">Панель администратора</div>
        <form action="admin_developers_page.php" method="GET"><button class ="button_menu">Добавить нового разработчика</button></br></form>
        <form action="game_admin.php" method="GET"><button class ="button_menu">Добавить новую игру</button></form>


        <!-- Форма поиска игры -->
        <form class="admin_form" id="admin_form_game" action="games_search.php" method="GET">
            <div class="form_word">Поиск игры:</div>
            <input class="input_form_search" type="text" id="search_game" name="search_game" placeholder="Введите название игры" required>
            <input type="hidden" name="admin_search" value="true">
            <div id="game_suggestions" class="suggestions"></div>

            <input type="submit" class = "search_value_button" value="Поиск игры">
        </form>

        <!-- Форма поиска разработчика -->
        <form class="admin_form" id="admin_form_dev" action="developers.php" method="GET">
            <div class="form_word">Поиск разработчика:</div>
            <input class="input_form_search" type="text" id="input_items_search" name="input_items_search" placeholder="Введите разработчика" required>
            <input type="hidden" name="admin_search" value="true">
            <div id="dev_suggestions" class="suggestions"></div>

            <input type="submit" class = "search_value_button" value="Поиск разработчика">
        </form>

        <!-- Форма изменения жанров -->
        <form class="admin_form" id="form_change_genre" method="POST">
            <div class="form_word">Изменить жанр игр:</div>
            <input class="input_form_search" type="text" id="based_name_genre" name="based_name_genre" placeholder="Введите жанр" required>
            <div class="sub_message" id="genre_message"></div>
            <input type="submit" class = "search_value_button catgeory_genre" id = "create_genre" value="Добавить жанр">
            <input type="submit" class = "search_value_button catgeory_genre" id = "delete_genre" value="Удалить жанр">
            <input class="input_form_search catgeory_genre_input" type="text" id="new_name_genre" name="new_name_genre" placeholder="Введите новое название жанра">
            <input type="submit" class = "search_value_button catgeory_genre" id = "update_genre" value="Изменить жанр">
        </form>


        <!-- Форма изменения категорий -->
        <form class="admin_form" id="form_change_category" method="POST">
            <div class="form_word">Изменить категорию игр:</div>
            <input class="input_form_search" type="text" id="based_name_category" name="based_name_category" placeholder="Введите категорию" required>
            <div class="sub_message" id="category_message"></div>
            <input type="submit" class = "search_value_button catgeory_genre" id = "create_category" value="Добавить категорию">
            <input type="submit" class = "search_value_button catgeory_genre" id = "delete_category" value="Удалить категорию">
            <input class="input_form_search catgeory_genre_input" type="text" id="new_name_category" name="new_name_category" placeholder="Введите новое название категории">
            <input type="submit" class = "search_value_button catgeory_genre" id = "update_category" value="Изменить Категории">
        </form>


    </div>

</body>
</html>
