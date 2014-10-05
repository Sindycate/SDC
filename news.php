<?php

//conection:
$link = mysqli_connect("localhost","root","","personal_page") or die("Error " . mysqli_error($link));

if (isset($_GET['id']))
{
	$id = $_GET['id'];

	if ($id == '')
	{
		unset($id);
		header("Location: .");
		die();
	}
}

$table_name = "new_article";
$query = "SELECT * FROM $table_name WHERE id = '$id'";

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
				<a href="#" >
					<div class="posts">

					</div>
				</a>
				<a href="index.php" >
					<div class="home">

					</div>
				</a>
			</div>
		</div>
		<div class="inner">
			<?php
				while($row = mysqli_fetch_array($result)) {
			?>
			<div class="date"><?php echo $row["new_article_date"]; ?></div>
			<div class="page_head">
				<?php echo $row["new_article_title"]; ?>
			</div>
			<div class="category"><?php echo $row["new_article_category"]; ?></div>
			<div class="content"><?php echo $row["new_article_text"]; ?></div>
			<?php } ?>
		</div>
		<div class="page_buffer"></div>
	</div>
	<!-- <div class="footer_panel">
		<div class="footer">
			2014 Sindycate
		</div>
		<div class="footer_logos">
		</div>
	</div> -->
	<!-- <script src="./js/main.js"></script> -->
</body>
</html>