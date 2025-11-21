<!DOCTYPE html>
<html lang="ru">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталг игр</title>
    <link rel="stylesheet" href="static/base_styles.css">
    <link rel="stylesheet" href="static/game_page_styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	
</head>



<body>

	<?php
		require_once 'config.php';
		require_once "query_func.php";
		$admin_search = false;
		if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_game']))
		{
			$game_name = htmlspecialchars($_GET['search_game']);
			$games = get_query_answer("search_games", $game_name);
			echo '<script src="static/pagination.js" defer data-query="games_search_post" data-query_param="' . htmlspecialchars($game_name, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '%"></script>';
			if(isset($_GET['admin_search']))
			{
				require_once 'auth_func.php';
				
				if (!isUserLoggedIn()) {
					header('Location: auth_page.php');
					exit();
				}
				else
				{
					$admin_search = true;
				}

			}
		}
		else
		{
			if($_SERVER["REQUEST_METHOD"] == "GET")
			{
				$games = get_query_answer("main_games", 0);;
				echo '<script src="static/pagination.js" defer data-query="games_search_get"></script>';
			}
			else
			{
				header("Location: main.php");
				exit();
			}
		}
	?>


	<?php require_once 'shapka.php';?>
	<div class="container"><!-- основной контент -->
		<?php require_once 'shapka_menu.php';?>
		<div class = "head_word">Список игр</div>
		<div class = container_main_page_content><!-- блоки игр -->
			<?php foreach ($games as $game): ?>
				<?php 
					$url = $admin_search 
						? 'https://k0j268qj-80.inc1.devtunnels.ms/game_admin.php?game=' 
						: 'https://k0j268qj-80.inc1.devtunnels.ms/game.php?game=';
					echo '<a href="' . $url . urlencode($game['game_name']) . '">';
				?>
					<div class="game_rectangle">
						<?php
							$images = glob('game_imgs/' . $game['game_id'] . '.{png,jpg,jpeg,gif,webp}', GLOB_BRACE);
							
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
</body>
</html>
