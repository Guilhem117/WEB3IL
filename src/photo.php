<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php
			session_start();
			include('affich.inc.php');
		?>
		<link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="scripts.js"></script>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo $ini["meta-description"];?>" />
		<meta name="keywords" content="<?php echo $ini["meta-keywords"];?>" />
		
		<meta name="author" content="Guilhem SERENE">
		

        <title>Photos - <?php echo $ini["titre"];?></title>   
		
    </head>
	
	<header>
		<h1><?php echo $ini["titre"];?></h1>
		
		<!-- Barre de menu -->   
		<div class="menu">
		
		<span> <a href="index.php">Blog </a> </span>
		<span> Photos </span>		
		
		<?php
		
			if (!isset($_SESSION['login'])){
				echo '<span> <a href="admin.php">Connexion</a> </span>';
			} else {
				echo '<span> <a href="deconnexion.php?redirectTo=photo.php">Deconnexion</a> </span>';
			}
			
			

		?>	
		<br/>
		</div>
		
		
	</header>		
		
	<footer>
		<span class="credits"><?php echo $ini["credits"];?></span>
	</footer>
</html>