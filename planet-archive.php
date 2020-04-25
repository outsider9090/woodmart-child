<?php
/*
Template Name: Planet Archives
*/
?>

<?php get_header() ; ?>


<div class="wpb_column vc_column_container vc_col-sm-9" role="main">
	<div class="vc_column-inner">
		<div class="wpb_wrapper">
			<h2 class="text-center">آرشیو Planet</h2>
			<?php
			$args = array(
				'taxonomy' => 'zcategory',
				'orderby' => 'date',
				'order'   => 'ASC',
				'date_query' => array(
					array(
						'before' => '20 hour ago',
					)
				),
			);

			$cats = get_categories($args);
			foreach($cats as $cat) {
				?>
				<a href="<?php echo get_category_link( $cat->term_id ) ?>">
					<?php echo $cat->name; ?>
				</a>
				<?php
			}
			?>
		</div>

        <p><strong>Tags Cloud:</strong></p>
		<?php wp_tag_cloud(); ?>

        <h2>Archives by Week:</h2>
        <ul>
			<?php wp_get_archives('type=weekly'); ?>
        </ul>
	</div>
</div>

<?php  get_sidebar(); ?>
<?php get_footer(); ?>



