<!DOCTYPE html>
<html lang="ru">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталог игр</title>
    <link rel="stylesheet" href="static/base_styles.css">
    <link rel="stylesheet" href="static/game_styles.css">
    <link rel="stylesheet" href="static/bread_crumbs.css">
</head>



<body>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['game']))
        {
            require_once 'query_func.php';
            $game_name = $_GET['game'];
            $result = get_query_answer("game_category_genre", $game_name);
            if (!$result)
            {
                die('Ошибка соединения');
                exit();
            }
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

        <?php

            $referer = $_SERVER['HTTP_REFERER'] ?? '';
            $currentPage = "игра ". $result["game_name"]; // Название страницы

            if($referer){
                $parsed = parse_url($referer);
        
                // Получаем путь с параметрами
                $path_with_query = $parsed['path'] ?? '';
                if (isset($parsed['query'])) {
                    $path_with_query .= '?' . $parsed['query'];
                }
            }

            if(!empty($referer)){

                echo '<div class="breadcrumbs">';
                echo '<a href="/" class="breadcrumb">Главная</a> <span class ="arrow">→</span> ';

                if (strpos($referer, '/games_search.php') !== false) {//открытие через поиск игр
                    echo '<a href="/games_search.php" class="breadcrumb">Список игр</a> <span class ="arrow">→</span> ';
                } elseif (strpos($referer, "/developers_games.php") !== false) {//открытие страницы через разработчика 
                    echo '<a href="/developers.php" class="breadcrumb">Разработчики</a> <span class ="arrow">→</span> ';
                    echo '<a href='.$path_with_query.' class="breadcrumb">Разработчик '.$result["autor_name"].'</a> <span class ="arrow">→</span> ';
                } elseif (strpos($referer, 'genre.php') !== false) {//открытие через жанры
                    echo '<a href="/genre.php" class="breadcrumb">Жанры игр</a> <span class ="arrow">→</span> ';
                } elseif (strpos($referer, '/categories.php') !== false) {//открытие через категории
                    echo '<a href="/categories.php" class="breadcrumb">Категории игр</a> <span class ="arrow">→</span> ';
                }
                elseif (strpos($referer, '/') !== false) {//открытие через главное меню
                    null;    
                }

                echo '<span class="breadcrumb current">' . $currentPage . '</span>';
                echo '</div>';
            }
        ?>



        <div class = "head_word">
            <?php echo $result['game_name']; ?> </br>
                Разработчик: <a href="https://k0j268qj-80.inc1.devtunnels.ms/developers_games.php?input_items_search=<?php echo urlencode($result['autor_name']); ?>">
                <?php echo $result['autor_name']; ?></a>
        </div>
        <div class = container_main_page_content><!-- блоки игр -->
            
            <?php 
                $image_path = null;
                $extensions = ['png', 'jpg', 'jpeg'];

                foreach ($extensions as $ext) {
                    if (file_exists('game_imgs/' . $result['game_id'] . '.' . $ext)) {
                        $image_path = 'game_imgs/' . $result['game_id'] . '.' . $ext;
                        break;
                    }
                }
			?>
        
            <?php if ($image_path): ?>
                <img class="img_game" src="<?= $image_path ?>" alt="<?= $result['game_name'] ?>">
            <?php endif; ?>
            <div class = "game_text_description_game">
                <br><?php echo nl2br($result['game_description']); ?>
            </div>



            <!-- Блок для отображения жанров и категорий -->
            <div class="game_info">
                <?php if (!empty($result['genres'])): ?>
                    <div class="genres_block">
                        <span class = "head_cat_gen">Жанры:</span>
                        <div class = "item_block">
                            <?php 
                                $genres_array = is_array($result['genres']) ? $result['genres'] : explode(',', $result['genres']);
                                foreach($genres_array as $genre): 
                                    $genre = trim($genre);
                                    if (!empty($genre)):
                            ?>
                                <span class = "item_game_info">
                                    <?php echo htmlspecialchars($genre); ?>
                                </span>
                            <?php 
                                    endif;
                                endforeach; 
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="game_info">    
                <?php if (!empty($result['categories'])): ?>
                    <div class="categories_block">
                        <span class = "head_cat_gen">Категории:</span>
                        <div class = "item_block">
                            <?php 
                                $categories_array = is_array($result['categories']) ? $result['categories'] : explode(',', $result['categories']);
                                foreach($categories_array as $category): 
                                    $category = trim($category);
                                    if (!empty($category)):
                            ?>
                                <span class = "item_game_info">
                                    <?php echo htmlspecialchars($category); ?>
                                </span>
                            <?php 
                                    endif;
                                endforeach; 
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>