<?php
/*
Template Name: Main Archive
*/
?>

<?php get_header() ; ?>


<div class="wpb_column vc_column_container vc_col-sm-9" role="main">
	<div class="vc_column-inner">
		<div class="wpb_wrapper">
			<h2 class="text-center">آرشیو Planet</h2>

			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div>
	</div>
</div>

<?php  get_sidebar(); ?>
<?php get_footer(); ?>



