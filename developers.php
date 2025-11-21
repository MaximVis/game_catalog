<!DOCTYPE html>
<html lang="ru">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLGAMES- каталог игр</title>
    <link rel="stylesheet" href="static/base_styles.css">
    <link rel="stylesheet" href="static/developers_styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	
</head>



<body>

<?php

	require_once 'config.php';
	require_once 'query_func.php';
	$admin_search = false;
	if($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET['input_items_search'])))
	{
		$autor_name = htmlspecialchars($_GET['input_items_search']);
		$list_autors = get_query_answer("search_autors", $autor_name);
		echo '<script src="static/pagination.js" defer data-query="developers_post" data-query_param="' . htmlspecialchars($autor_name, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '%"></script>';
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
			$list_autors = get_query_answer("autors", 0);
			echo '<script src="static/pagination.js" defer data-query="developers_get"></script>';
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
			<div class = "head_word">Разработчики</div>

			<div class = "container_items_content">
				<form class = "item items_select" action="developers.php" method="GET">
					<input class = "input_items_search" type="text" id="input_items_search" name="input_items_search" placeholder="Найти разработчика">
					<?php if($admin_search){ echo'<input type="hidden" name="admin_search" value="true">'; }?>
				</form>
				<div class = "item items_content">
				<?php foreach ($list_autors as $autor): ?>
					
					<?php 
						$image_path = null;
						$extensions = ['png', 'jpg', 'jpeg'];

						foreach ($extensions as $ext) {
							if (file_exists('devs_imgs/' . $autor['autor_id'] . '.' . $ext)) {
								$image_path = 'devs_imgs/' . $autor['autor_id'] . '.' . $ext;
								break;
							}
						}

						if (!$image_path) {
							$image_path = 'devs_imgs/0.png';
						}
					?>

					<?php 
						$url = $admin_search 
							? 'https://k0j268qj-80.inc1.devtunnels.ms/admin_developers_page.php?input_items_search=' 
							: 'https://k0j268qj-80.inc1.devtunnels.ms/developers_games.php?input_items_search=';
						echo '<a href="' . $url . urlencode($autor['autor_name']) . '">';
					?>
						<div class="item_rectangle">
							<img class="img_game_main" src="<?= $image_path ?>" alt="<?= $autor['autor_name'] ?>">
							<div class = "game_text_main"><?= $autor['autor_name'] ?></div>
						</div>
					</a>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
