<?php

/* Variables */
$paged_type = 'paged';         // "page" in local AND "paged" in Host
$excerptLength = get_option('ztools_excerptLen','');  //  (کلمه) طول خلاصه مطلب
$posts_per_page = get_option('ztools_planet_cat_postPP',''); // تعداد پست های صفحه اصلی
$loginUrl = get_option('ztools_planet_loginUrl',''); // آدرس صفحه ورود برای ریدایرکت شدن کاربر وارد نشده بعد از لایک
/* Variables */



add_filter( 'excerpt_length', function( $content ) use ($excerptLength) {return $excerptLength;}, 999); //based words count
add_filter('excerpt_more', function (){return '  ...';});

function wp_bootstrap4_pagination( $args = array() , $paged_type , $posts_per_page ) {

	$text_domain = null;

	$paged = ( get_query_var( $paged_type ) ) ? get_query_var( $paged_type ) : '1';
	$category = get_queried_object();
	$args = array(
		'post_type' => 'zplanet' ,
		'orderby' => 'date' ,
		'order' => 'DESC' ,
		'posts_per_page' => $posts_per_page,
		'tax_query' => array(
			array(
				'taxonomy' => $category->taxonomy,
				'field' => 'slug',
				'terms' => $category->slug,
			),
		),
		'paged' => $paged,
	);
	$query = new WP_Query($args);

	$defaults = array(
		'range'           => 4,
		'custom_query'    => $query,
		'previous_string' => __( 'قبلی', 'woodmart-child' ),
		'next_string'     => __( 'بعدی', 'woodmart-child' ),
		'first_string'    => __( '<i class="fa fa-angle-right"></i>', 'woodmart-child'),
		'last_string'     => __( '<i class="fa fa-angle-left"></i>', 'woodmart-child'),
		'before_output'   => '<ul class="pagination">',
		'after_output'    => '</ul>'
	);

	wp_reset_postdata();

	$args = wp_parse_args(
		$args,
		apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
	);

	$args['range'] = (int) $args['range'] - 1;
	if ( !$args['custom_query'] )
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int) $args['custom_query']->max_num_pages;
	$page  = intval( get_query_var( $paged_type ) );
	$ceil  = ceil( $args['range'] / 2 );

	if ( $count <= 1 )
		return FALSE;

	if ( !$page )
		$page = 1;

	if ( $count > $args['range'] ) {
		if ( $page <= $args['range'] ) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ( $page >= ($count - $ceil) ) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}

	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr( get_pagenum_link($previous) );

	$firstpage = esc_attr( get_pagenum_link(1) );
	if ( $firstpage && (1 != $page || true) )
		$echo .= '<li class="page-item previous'.($page == 1 ? ' disabled' : '').'"><a class="page-link" href="' . $firstpage . '" aria-label="'.__( 'First', 'woodmart-child' ).'" title="صفحه اول">' . $args['first_string'] . '</a></li>';
	if ( $previous && (1 != $page || true) )
		$echo .= '<li'.($page == 1 ? ' class="page-item disabled"' : '').'><a class="page-link" href="' . $previous . '" title="' . __( 'صفحه قبلی', 'woodmart-child') . '" aria-label="' . __( 'previous', 'woodmart-child') . '">' . $args['previous_string'] . '</a></li>';


	if ( !empty($min) && !empty($max) ) {
		for( $i = $min; $i <= $max; $i++ ) {
			if ($page == $i) {
				$echo .= sprintf( '<li class="page-item active"><a class="page-link active" href="%s">%s</a></li>', esc_attr( get_pagenum_link($i) ), "صفحه " . $i . " از " . $count );
			} else {
				$echo .= sprintf( '<li class="page-item"><a class="page-link" href="%s">%d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
			}
		}
	}

	$next = intval($page) +1;
	$next = esc_attr( get_pagenum_link($next) );
	if ($next && ($count != $page || true) )
		$echo .= '<li'.($page == $count ? ' class="page-item disabled"' : '').'><a class="page-link" href="' . $next . '" title="' . __( 'صفحه بعدی', 'woodmart-child') . '" aria-label="' . __( 'next', 'woodmart-child') . '">' . $args['next_string'] . '</a></li>';

	$lastpage = esc_attr( get_pagenum_link($count) );
	if ( $lastpage ) {
		$echo .= '<li class="page-item next'.($page == $count ? ' disabled' : '').'"><a class="page-link" href="' . $lastpage . '" aria-label="' . __( 'Last', 'woodmart-child') . '" title="صفحه آخر">' . $args['last_string'] . '</a></li>';
	}
	if ( isset($echo) )
		echo $args['before_output'] . $echo . $args['after_output'];
}

?>
<!-- functions -->


<?php  get_header(); ?>

<!-- Toast -->
<div class="container">
	<input type="hidden" id="url_redirect" data-url="<?php echo $loginUrl; ?>">
</div>


<!-- Content -->
<div class="wpb_column vc_column_container vc_col-sm-9" role="main">
	<div class="vc_column-inner">
		<div class="wpb_wrapper">

			<?php
			$category = get_queried_object();
			$paged = ( get_query_var( $paged_type ) ) ? get_query_var( $paged_type ) : '1'; // Static front pages uses get_query_var( 'page' ) and not get_query_var( 'paged' ).
			$args = array(
				'post_type' => 'zplanet' ,
				'orderby' => 'date' ,
				'order' => 'DESC' ,
				'posts_per_page' => $posts_per_page,
				'tax_query' => array(
					array(
						'taxonomy' => $category->taxonomy,
						'field' => 'slug',
						'terms' => $category->slug,
					),
				),
				'paged' => $paged,
			);

			$category = new WP_Query($args);
			?>


			<?php if ( $category->have_posts() ) : ?>
				<?php while ( $category->have_posts() ) : $category->the_post(); ?>

					<div class="main_container">
						<div class="loading_panel" id="loadingPanel<?php echo $post->ID ?>">
							<i class="fa fa-spinner fa-spin"></i>
						</div>

						<div class="planet_left">
							<?php
							global $wpdb;
							global $post;
							$l=0;
							$postid = $post->ID;
							$user_id = get_current_user_id();
							$row1 = $wpdb->get_results( "SELECT * FROM $wpdb->post_like_table WHERE postid = '$postid' AND userid = '$user_id'");
							if(!empty($row1)){
								$l1=1;
							}
							$totalrow1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
							$total_like = $wpdb->num_rows;
							?>

							<?php
							if (! $row1){
								?>
								<a href="#" id="pp_like<?php echo $post->ID ?>" class=" pp_like" data-id="<?php echo $post->ID; ?>">
									<i class="fa fa-heart-o"></i><br>
									<span class="notliked"><?php echo $total_like; ?></span>
								</a>
								<?php
							}else{
								?>
								<a href="#" id="pp_like<?php echo $post->ID ?>" class=" pp_like" data-id="<?php echo $post->ID; ?>">
									<i class="fa fa-heart"></i>
									<span class="liked"><?php echo $total_like; ?></span>
								</a>
								<?php
							}
							?>

							<a href="<?php esc_url(the_permalink()); ?>#respond" class="comment_btn">
								<i class="fa fa-comment-o"></i>
								<span><?php echo get_comments_number(); ?></span>
							</a>

							<div class="hovered-social-icons">
								<div class="woodmart-social-icons text-center icons-design-default icons-size-small color-scheme-light social-share social-form-circle">
									<a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-facebook"> <i class="fa fa-facebook"></i> <span class="woodmart-social-icon-name">Facebook</span></a>
									<a rel="nofollow" href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-twitter"> <i class="fa fa-twitter"></i> <span class="woodmart-social-icon-name">Twitter</span> </a>
									<a rel="nofollow" href="mailto:?subject=Check%20this%20<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-email"> <i class="fa fa-envelope"></i> <span class="woodmart-social-icon-name">Email</span> </a>
									<a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-linkedin"> <i class="fa fa-linkedin"></i> <span class="woodmart-social-icon-name">linkedin</span> </a>
									<a rel="nofollow" href="https://wa.me/?text=<?php esc_url(the_permalink()); ?>" target="_blank" class="whatsapp-desktop woodmart-social-icon social-whatsapp"> <i class="fa fa-whatsapp"></i> <span class="woodmart-social-icon-name">WhatsApp</span> </a>
									<a rel="nofollow" href="https://telegram.me/share/url?url=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-tg"> <i class="fa fa-telegram"></i> <span class="woodmart-social-icon-name">Telegram</span> </a>
								</div>
							</div>
						</div>

						<div class="planet_right">
							<article class="article_container">
								<div class="article">
									<header class="entry-header">
										<h3 class="planet-title title d-block">
											<a href="<?php echo esc_url(get_permalink( )); ?>" rel="bookmark">
												<?php the_title( '', '', true ); ?>
											</a>
										</h3>

										<div class="entry-meta">
											<ul class="entry-meta-list">
												<li class="meta-author">
													<?php echo get_avatar(get_the_author_meta('ID')); ?>
													<a href="<?php echo get_site_url().'/author/'.get_the_author_meta( 'user_login' ); ?>" rel="author">
	                                                    <span>
	                                                        <span>
	                                                          <?php get_the_author_meta( '',the_author() ); ?>
	                                                        </span>
	                                                    </span>
													</a>
												</li>

												<li>
													<?php echo ' - '; ?>
													<span class="meta-date">
		                                                <?php echo get_the_date( 'j/M/Y' ); ?>
	                                                </span>
												</li>
												<li>
	                                                <span class="meta-link">
		                                                <?php
		                                                $input = get_post_meta($post->ID, "zplanet-link", true);
		                                                $link = secureLink($input , $post ,'zplanet-link');
		                                                if ($link !== 0){
			                                                ?>
			                                                <?php echo ' - '; ?>
                                                            <a href="<?php echo get_post_meta($post->ID, "zplanet-link", true); ?>" target="_blank" rel="nofollow">
			                                                <?php echo $link ?>
		                                                </a>
			                                                <?php
		                                                }
		                                                ?>
	                                                </span>
												</li>
											</ul>
										</div>
									</header>


									<div class="article-body">
										<div class="article-thumbnail">
											<?php
											if ( !has_post_thumbnail() ) {
												?>
												<a href="<?php echo esc_url( get_permalink() ); ?>">
													<img src="<?php echo get_stylesheet_directory_uri().'/images/image_not_found.jpg'; ?>"
													     width="150" height="150" alt="">
												</a>
												<?php
											} else {
												?>
												<a href="<?php echo esc_url( get_permalink() ); ?>">
													<img src="<?php echo get_the_post_thumbnail_url($post->ID , 'thumbnail') ?>" alt="">
												</a>
												<?php
											}
											?>
										</div>
										<div class="article-excerpt">
											<?php the_excerpt(); ?>
										</div>
									</div>

							</article>

						</div>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>


			<?php else: ?>
				<div class="container">
					<div class="alert alert-danger">
						<p>متاسفانه مطلبی برای نمایش موجود ندارد!</p>
					</div>
				</div>
			<?php endif; ?>

			<div class="container">
				<div class="row">
					<div class="pagination">
						<?php wp_bootstrap4_pagination( array(
							'previous_string' => __( 'قبلی', 'woodmart-child' ),
							'next_string' => __( 'بعدی', 'woodmart-child' ),
							'first_string' => '<i class="fa fa-angle-right"></i>',
							'last_string' => '<i class="fa fa-angle-left"></i>',
							'before_output'   => '<ul class="pagination">',
							'after_output'    => '</ul>'
						)  ,$paged_type, $posts_per_page); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php get_sidebar('planet'); ?>
<?php get_footer(); ?>

