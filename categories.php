<!DOCTYPE html>
<html lang="ru">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталог игр</title>
    <link rel="stylesheet" href="static/base_styles.css">
    <link rel="stylesheet" href="static/items_styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="static/search_items.js" defer data-query="category"></script>
</head>



<body>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            require_once 'config.php';
            require_once 'query_func.php';
            $list_categories = get_query_answer("categories", 0);
            $list_games = get_query_answer("main_games", 0);
        }
        else
        {
            header("Location: main.php");
            exit();
        }
    ?>



    <?php require_once 'shapka.php';?>
        <div class="container"><!-- основной контент -->
            <?php require_once 'shapka_menu.php';?>

            <div class = "head_word">Категории игр</div>

            <div class = "container_items_content">
            <div class = "item items_select">
            <ul class = "items_list" id="myList">

            <?php foreach ($list_categories as $category): ?>
				<li class="selectable"><span class="square"></span><?= $category['category_name'] ?></li>
			<?php endforeach; ?>
            </ul>
            <input class = "input_items_search" type="text" id="input_items_search" placeholder="Найти жанр">
            </div>
            <div class = "item items_content">
            
            <?php foreach ($list_games as $game): ?>
                <a href = "https://k0j268qj-80.inc1.devtunnels.ms/game.php?game=<?= urlencode($game['game_name']) ?>">
                    <div class="item_rectangle">
                        <?php
                            $images = glob('game_imgs/' . $game['game_id'] . '.{png,jpg,jpeg}', GLOB_BRACE);
                            
                            if (!empty($images)) {
                                echo '<img class="img_game_main" src="' . $images[0] . '" alt="' . $game['game_name'] . '">';
                            } else {
                                echo '<img class="img_game_main" src="game_imgs/0.png" alt="' . $game['game_name'] . '">';
                            }
                        ?>
                        <div class="game_text_main">    <?= $game['game_name'] ?>
                            <div class="text_game_main_description"> <?= $game['genres'] ?> </div>
                        </div>
                    </div>
                </a>
			<?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
