<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?></title>
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php 
	    /* Always have wp_head() just before the closing </head>
	     * tag of your theme, or you will break many plugins, which
	     * generally use this hook to add elements to <head> such
	     * as styles, scripts, and meta tags.
	     */
	    wp_head();
	 ?>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js"></script>
</head>
<body <?php body_class(); ?>>
	
<div id="container">
	<header>
		<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/logo.gif" alt="The Illustrienne" id="logo"></a>
		<?php wp_nav_menu( array( 'menu' => 'Blog', 'container' => 'nav' ) ); ?>
	</header>
	<div id="main" role="main">