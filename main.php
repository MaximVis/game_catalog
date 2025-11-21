<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталог игр</title>
    <link rel="stylesheet" href="static/styles_main_pg.css">
	<link rel="stylesheet" href="static/base_styles.css">
    <script src="static/slider.js" defer></script>
</head>

<body>
	<?php
		require_once 'query_func.php';
		$slider_games = get_query_answer("slider", 0);
		$games = get_query_answer("main_page_games", 0);
	?>


    <?php require_once 'shapka.php';?>
	<div class="container"><!-- основной контент -->
		<?php require_once 'shapka_menu.php';?>
		<div class = "head_word">Популярные игры</div>
		<div class="slider-container"><!-- слайдер (5 игр) -->
		<div class="slider">
			<?php foreach ($slider_games as $game): ?>
				<div class="slide">
					<a href="game.php?game=<?= urlencode($game['game_name']) ?>" class="slide-link">
            			<img src="game_imgs/<?= $game['game_id'] ?>.png" alt="<?= $game['game_name'] ?>">
        			</a>
				</div>
			<?php endforeach; ?>
		</div>
		<button class="prev-button" ><img src="imgs/prev_but.png"></button>
		<button class="next-button"><img src="imgs/next_but.png"></button>
		</div>

		<div class = "head_word">Новинки</div>
		<div class = container_main_page_content><!-- блоки игр -->	
			<?php foreach ($games as $game): ?>
				<a href = "https://k0j268qj-80.inc1.devtunnels.ms/game.php?game=<?= urlencode($game['game_name']) ?>">
					<div class="game_rectangle">
						<?php
							$images = glob('game_imgs/' . $game['game_id'] . '.{png,jpg,jpeg,gif,webp}', GLOB_BRACE);
							
							if (!empty($images)) {
								echo '<img class="img_game_main" src="' . $images[0] . '" alt="' . $game['game_name'] . '">';
							} else {
								echo '<img class="img_game_main" src="game_imgs/0.png" alt="' . $game['game_name'] . '">';
							}
						?>
						<div class="game_text_main"> <?= $game['game_name'] ?>
							<div class="text_game_main_description"><?= $game['genres'] ?></div>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</body>
</html>
