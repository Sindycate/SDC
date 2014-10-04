<?php

session_start();
//conection:
$link = mysqli_connect("localhost","root","","personal_page") or die("Error " . mysqli_error($link));

//consultation:
$table_name = "new_article";

if (isset($_GET['page_num'])) {
	$current_page = $_GET['page_num'];
}
else {
	$current_page = 1;
}
$articles_num = 1;
// $start_pos = ($_GET['page_num'] * 5) ? $_GET['page_num'] * 5 : 0;
$start_pos = ($current_page - 1) * $articles_num;

$query = "SELECT * FROM $table_name ORDER BY `new_article_date` LIMIT $start_pos , $articles_num";
$query2 = "SELECT * FROM $table_name";
//execute the query.

$result2 = $link->query($query2);
$result2 = (mysqli_num_rows($result2));
$result = $link->query($query);

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Personal-Page</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/normalize.css">
</head>
<body>
	<div class="wrapper command-module">
		<div class="navbar">
			<div class="nav_panel">
				<a  class="logo" href="/SDC/index.php">
					<div class="title-string">indycate</div>
				</a>

				<?php
				// Проверяем, пусты ли переменные логина и id пользователя
				if (empty($_SESSION['login']) or empty($_SESSION['id']))
				{
					?>
					<a href="#" >
						<div class="enter" onclick="open_profile()">

						</div>
					</a>
					<div id="open_id" class="sign_in hidden">
					<form action="/SDC/php/sign_in.php" method="post">
						<input name="login" type="text" placeholder="login" />
						<input name="password" type="password" placeholder="password" />
						<input class="Sign_in" type="submit" value="Войти">
						<a href = "registration.html">Зарегестрироваться</a>
					</form>
					<?php
					/*echo "Вы вошли на сайт, как гость.<br>";*/
				}
				else
				{
					?>
					<a href="#" >
						<div class="profile" onclick="open_profile()">

						</div>
					</a>
					<div id="open_id" class="open_profile hidden">
					<?php
					echo "Вы вошли на сайт, как ".$_SESSION['login'].".";
					?>
					<a href="/SDC/php/endsession.php">Exit</a>
					<?php
				}
				?>

				</div>

				<script type="text/javascript">
					function inArray(value, array)
					{
						for(var i = 0; i < array.length; i++)
						{
							if(array[i] == value)
								return true;
						}
						return false;
					}

					function open_profile() {
						var openId = document.getElementById("open_id");
						if (inArray("hidden", openId.classList)) {
							openId.classList.remove("hidden");
						}
						else {
							openId.classList.add("hidden");
						}
					}
				</script>

				<a href="#" >
					<div class="posts">

					</div>
				</a>
				<?php
					if ((!empty($_SESSION['id'])) && ($_SESSION['permission'] == "admin")) {
				?>
					<a href="new_article.html" >
						<div class="add_post">
									<!-- <a href = ><input class="addArticle" type="submit" value="Добавить новость"></a> -->
						</div>
					</a>
				<?php
					}
				?>
			</div>
		</div>
		<div class="inner">
			<div class="page_head">
				Все новости
			</div>
			<div class="content_left">
				<div class="menu">

				</div>
				<div class="posts_list">
					<?php
						while($row = mysqli_fetch_array($result)) {
					?>
					<div class="post">
						<div class="date"><?php echo $row["new_article_date"]; ?></div>
						<h1 class="title-line expand"><a href="./news.php?id=<?php echo $row["id"]; ?>"><?php echo $row["new_article_title"]; ?></a></h1>
						<div class="category"><?php echo $row["new_article_category"]; ?></div>
						<p class="content"><?php echo $row["new_article_preview_text"]; ?></p>
					</div>
					<a href="./news.php?id=<?php echo $row["id"]; ?>" class="read-full expand">Читать полностью</a>
					<hr class="dividing_line">
					<?php } ?>
				</div>
			</div>
			<div class="sidebar_right">
				<div class="block">
					<div class="block_title">
						Популярное за месяц
					</div>
					<div class="block_posts_list">
						<div class="block_post_item">
							<a href="#">Айн Рэнд "Атлант расправил плечи"</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page_nav">
				<ul class="next_prev">
				<?php if ($current_page > 1) {?>
					<li><a href="index.php?page_num=<?php echo ($current_page - 1); ?> ">Назад</a></li>
				<?php } else { ?>
					<li>Назад</li>
				<?php } ?>
				<?php if ((($result2 / $articles_num) + (($result2 % $articles_num) ? 1 : 0)) >= ($current_page + 1)) {?>
					<li><a href="index.php?page_num=<?php echo ($current_page + 1); ?> ">Вперёд</a></li>
				<?php } else { ?>
					<li>Вперёд</li>
				<?php } ?>
				</ul>
				<ul id="nav_pages">
				<?php if ($current_page > 1) {?>
					<li><a href="./index.php?page_num=<?php echo ($current_page - 1); ?>"><?php echo ($current_page - 1); ?></a></li>
				<?php } ?>
					<li><a href="./index.php?page_num=<?php echo ($current_page); ?>"><?php echo $current_page; ?></a></li>
				<?php if ((($result2 / $articles_num) + (($result2 % $articles_num) ? 1 : 0)) >= ($current_page + 1)) {?>
					<li><a href="./index.php?page_num=<?php echo ($current_page + 1); ?>"><?php echo ($current_page + 1); ?></a></li>
				<?php } ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="page_buffer"></div>
	</div>
	<div class="footer_panel">
		<div class="footer">
			2014 Sindycate
		</div>
		<div class="footer_logos">
		</div>
	</div>
	<script src="./js/main.js"></script>
</body>
</html>
