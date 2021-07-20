<?php
/**
 * The Header template for our theme
 */

global $my_custom_title;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="./fonts/font-awesome/css/font-awesome.min.css">

    <?php if ($my_custom_title !== null){echo "<title>".$my_custom_title."</title>";} ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'woodmart_after_body_open' ); ?>
	
	<div class="website-wrapper">

		<?php if ( woodmart_needs_header() ): ?>

			<!-- HEADER -->
			<header <?php woodmart_get_header_classes(); // location: inc/functions.php ?>>

                <div class="top_banner">
                    <a href="#">
<!--                        <img src="--><?php //echo get_stylesheet_directory_uri() . './images/sample-banner.jpg' ?><!--" alt="">-->
                    </a>
                </div>

                <?php whb_generate_header(); ?>


                <div class="progress" id="scroll-bar">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>


			</header><!--END MAIN HEADER-->
			
			<?php woodmart_page_top_part(); ?>

		<?php endif ?>


<?php


