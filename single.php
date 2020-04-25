<?php

get_header(); ?>

<?php
// Get content width and sidebar position
$content_class = woodmart_get_content_class();
?>


<div class="site-content <?php echo esc_attr( $content_class ); ?>" role="main">

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

        <div class="publish">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 support">
                        <a href="https://sisoog.com/%DA%A9%D9%85%DA%A9-%D8%A8%D9%87-%D8%B3%DB%8C%D8%B3%D9%88%DA%AF/">
                            حمایت از سیسوگ
                            <img src="<?php echo get_stylesheet_directory_uri().'/images/support.png'; ?>" alt="حمایت از سیسوگ">
                        </a>
                    </div>
                    <div class="col-md-6 telegramJoin">
                        <a href="https://t.me/sisoog">
                            عضویت در کانال تلگرام سیسوگ
                            <img src="<?php echo get_stylesheet_directory_uri().'/images/telegram.png'; ?>" alt="عضویت در کانال تلگرام سیسوگ">
                        </a>
                    </div>
                </div>
            </div>
            <div class="publish_right">
                <p class="publish_text">
                    <strong>انتشار مطالب با ذکر نام و آدرس
                        <a href="https://sisoog.com">وب سایت سیسوگ</a>، بلامانع است.
                    </strong>
                </p>
                <p class="publish_text">
                    <strong>شما نیز میتوانید&nbsp;یکی از نویسندگان&nbsp;سیسوگ باشید.&nbsp;&nbsp;
                        <a href="https://sisoog.com/%D9%87%D9%85%DA%A9%D8%A7%D8%B1%DB%8C-%D8%A8%D8%A7-%D8%B3%DB%8C%D8%B3%D9%88%DA%AF/" target="_blank" rel="noopener">
                            همکاری با سیسوگ</a>
                    </strong>
                </p>
            </div>
        </div>


        <div class="woodmart-single-footer"><?php if( get_the_tag_list( '', ', ' ) ): ?>
                <div class="single-meta-tags">
                    <span class="tags-title"><?php esc_html_e('Tags', 'woodmart'); ?>:</span>
                    <div class="tags-list">
						<?php echo get_the_tag_list( '', ', ' ); ?>
                    </div>
                </div>
			<?php endif; ?><?php if ( woodmart_get_opt( 'blog_share' ) && woodmart_is_social_link_enable( 'share' ) ): ?>
                <div class="single-post-social">
					<?php if( function_exists( 'woodmart_shortcode_social' ) ) echo woodmart_shortcode_social(array('type' => 'share', 'tooltip' => 'yes', 'style' => 'colored')) ?>
                </div>
			<?php endif ?>
        </div>


		<?php if ( woodmart_get_opt( 'blog_navigation' ) ) woodmart_posts_navigation(); ?>
		<?php
		if ( woodmart_get_opt( 'blog_related_posts' ) ) {
			$args = woodmart_get_related_posts_args( $post->ID );

			$query = new WP_Query( $args );

			if( function_exists( 'woodmart_generate_posts_slider' ) ) echo woodmart_generate_posts_slider(array(
				'title' => esc_html__('Related Posts', 'woodmart'),
				'blog_design' => 'carousel',
				'blog_carousel_design' => 'masonry',
				'el_class' => 'related-posts-slider',
				'slides_per_view' => 2
			), $query);
		}
		?>


		<?php comments_template(); ?>

	<?php endwhile; ?>

</div><!-- .site-content -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>
