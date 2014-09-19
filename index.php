<?php

session_start();
//conection:
$link = mysqli_connect("localhost","root","","personal_page") or die("Error " . mysqli_error($link));

//consultation:
$table_name = "new_article";
$query = "SELECT * FROM $table_name ORDER BY `new_article_date`";

//execute the query.

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
					Последнее обновление: 20 сентября
				</div>
				<div class="posts_list">
					<?php
						while($row = mysqli_fetch_array($result)) {
					?>
					<div class="post">
						<h1 class="title-line expand"><a href="./news.php?id=<?php echo $row["id"]; ?>"><?php echo $row["new_article_title"]; ?></a></h1>
						<div class="information">
							<div class="date"><?php echo $row["new_article_date"]; ?></div>
							<div class="category"><?php echo $row["new_article_category"]; ?></div>
						</div>
						<p class="content"><?php echo $row["new_article_preview_text"]; ?></p>
					</div>
					<a href="./news.php?id=<?php echo $row["id"]; ?>" class="read-full expand">Читать полностью</a>
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
			<div class="clear"></div>
			<div class="footer_panel">
				<div class="footer">
					2014 Sindycate
				</div>
				<div class="footer_logos">

				</div>
			</div>
		</div>
		<!-- <div class="footer">Подвал сайта</div> -->
	</div>
	<script src="./js/main.js"></script>
</body>
</html>
