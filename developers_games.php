<!DOCTYPE html>
<html lang="ru">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталог игр</title>
    <link rel="stylesheet" href="static/base_styles.css">
    <link rel="stylesheet" href="static/developers_games_styles.css">
    <link rel="stylesheet" href="static/items_styles.css">
    <script src="static/search_items.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>



<body>

    <?php 
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['input_items_search']))
        {
            require_once 'config.php';
            require_once 'query_func.php';
            $autor_name = htmlspecialchars($_GET['input_items_search']);
            $games = get_query_answer("developers_games", $autor_name);
            echo '<script src="static/pagination.js" defer data-query="developers_games" data-query_param="' . htmlspecialchars($autor_name, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '"></script>';
            //добавить проверку существует ли игра(на данный момент по input_items_search можно "найти" любую игру)
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
            <div class = "head_word">Игры разработчика <?= $autor_name ?></div>
            <div class = "container_items_content">
            <form class = "item items_select" action="developers.php" method="GET"> <input class = "input_items_search" type="text" id="input_items_search" name="input_items_search" placeholder="Найти разработчика"> </form>
            <div class = "item items_content">
            <?php foreach ($games as $game): ?>
                <a href = "https://k0j268qj-80.inc1.devtunnels.ms/game.php?game=<?= urlencode($game['game_name']) ?>" >
                <div class="item_rectangle">
                    <?php
                        $images = glob('game_imgs/' . $game['game_id'] . '.{png,jpg,jpeg}', GLOB_BRACE);
                        
                        if (!empty($images)) {
                            echo '<img class="img_game_main" src="' . $images[0] . '" alt="' . $game['game_name'] . '">';
                        } else {
                            echo '<img class="img_game_main" src="game_imgs/0.png" alt="' . $game['game_name'] . '">';
                        }
                    ?>
                    <div class="game_text_main"><?= $game['game_name'] ?>
                        <div class="text_game_main_description"><?= $game['genres'] ?></div>
                    </div>
                </div>
                </a>
			<?php endforeach; ?>
            
    </div>
    </div>
    </div>
</body>
</html>

