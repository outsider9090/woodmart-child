<?php /* Template Name: Home */


/* Variables */
$excerptLength = 45;         // طول خلاصه مطلب
$Grid_catID = 8562;       // آیدی دسته بندی گریدویو    8562
$Posts_catID = 209; // آیدی دسته بندی پست ها    209
$paged_type = 'page';       // "page" in local AND "paged" in Host
$posts_per_page = 5; // تعداد پست های صفحه اصلی
/* Variables */


add_filter( 'excerpt_length', function( $content ) use ($excerptLength) {return $excerptLength;}, 999); //based words count
add_filter('excerpt_more', function (){return '  ...';});


function wp_bootstrap4_pagination( $args = array() , $cat_id, $paged_type , $posts_per_page ) {

	$text_domain = null;

	$paged = ( get_query_var( $paged_type ) ) ? get_query_var( $paged_type ) : '1';
	$args = array(
		'post_type' => 'post' ,
		'orderby' => 'date' ,
		'order' => 'DESC' ,
		'posts_per_page' => $posts_per_page,
		'cat'         => $cat_id,
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
				$echo .= sprintf( '<li class="page-item active"><a class="page-link active" href="%s" >%s</a></li>', esc_attr( get_pagenum_link($i) ), "صفحه " . $i . " از " . $count );
			} else {
				$echo .= sprintf( '<li class="page-item"><a class="page-link" href="%s" >%d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
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

get_header(); ?>


<!-- Content -->
<div class="vc_row wpb_row vc_row-fluid ">
    <div class="wpb_column cute-article ">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">

				<?php
				$random_posts_args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'nopaging' => true,
					'order' => 'ASC',
					'orderby' => 'rand',
					'cat' => $Grid_catID,
					'cache_results' => false
				)
				?>
				<?php $random_post = new WP_Query( $random_posts_args ); ?>
				<?php if ( $random_post->have_posts() ) : ?>

					<?php
					$posts_number = 0;
					$ids = [];
					?>
					<?php while ( $random_post->have_posts() && $posts_number++ < 6 ) : $random_post->the_post(); ?>
						<?php
						array_push($ids, $post->ID);
						?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>

                    <div class="grid_container">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 rightSide">
                                <div style="display: flex;flex-flow: row wrap;justify-content: center;">
                                    <div class="block big col-lg-12 col-md-12 col-sm-12">
                                        <figure class="bigImage">
											<?php echo get_the_post_thumbnail( $ids[0], '' , '' ); ?>
                                        </figure>
                                        <a href="<?php echo get_the_permalink( $ids[0], false ); ?>" class="post_link">
                                            <h4 class="post_title"><?php echo get_the_title( $ids[0] ); ?></h4>
                                        </a>
                                    </div>
                                    <div class="block small col-lg-6 col-md-6 col-sm-12">
                                        <figure class="smallImage">
											<?php echo get_the_post_thumbnail( $ids[1], array(384,170) , '' ); ?>
                                        </figure>
                                        <a href="<?php echo get_the_permalink( $ids[1], false ); ?>" class="post_link">
                                            <h4 class="post_title"><?php echo get_the_title( $ids[1] ); ?></h4>
                                        </a>
                                    </div>
                                    <div class="block small col-lg-6 col-md-6 col-sm-12">
                                        <figure class="smallImage">
											<?php echo get_the_post_thumbnail( $ids[2], array(384,170) , '' ); ?>
                                        </figure>
                                        <a href="<?php echo get_the_permalink( $ids[2], false ); ?>" class="post_link">
                                            <h4 class="post_title"><?php echo get_the_title( $ids[2] ); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 leftSide">
                                <div class="" style="display: flex;flex-flow: row wrap;justify-content: center;">
                                    <div class="block small col-lg-12 col-md-12 col-sm-12" >
                                        <figure class="smallImage">
											<?php echo get_the_post_thumbnail( $ids[3], array(384,170) , '' ); ?>
                                        </figure>
                                        <a href="<?php echo get_the_permalink( $ids[3], false ); ?>" class="post_link">
                                            <h4 class="post_title"><?php echo get_the_title( $ids[3] ); ?></h4>
                                        </a>
                                    </div>
                                    <div class="block small col-lg-12 col-md-12 col-sm-12" >
                                        <figure class="smallImage">
											<?php echo get_the_post_thumbnail( $ids[4], array(384,170) , '' ); ?>
                                        </figure>
                                        <a href="<?php echo get_the_permalink( $ids[4], false ); ?>" class="post_link">
                                            <h4 class="post_title"><?php echo get_the_title( $ids[4] ); ?></h4>
                                        </a>
                                    </div>
                                    <div class="block small col-lg-12 col-md-12 col-sm-12" >
                                        <figure class="smallImage">
											<?php echo get_the_post_thumbnail( $ids[5], array(384,170) , '' ); ?>
                                        </figure>
                                        <a href="<?php echo get_the_permalink( $ids[5], false ); ?>" class="post_link">
                                            <h4 class="post_title"><?php echo get_the_title( $ids[5] ); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php else : ?>
                    <p class="alert alert-danger text-center my-4 w-100">متاسفانه مطلبي براي نمايش وجود ندارد</p>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>


<!--Posts-->
<div class="wpb_column vc_column_container vc_col-sm-9" role="main">
    <div class="vc_column-inner">
        <div class="wpb_wrapper">
            <div class="woodmart-blog-holder blog-shortcode blog-pagination-more-btn">
				<?php
				$paged = ( get_query_var( $paged_type ) ) ? get_query_var( $paged_type ) : '1'; // Static front pages uses get_query_var( 'page' ) and not get_query_var( 'paged' ).
				$args = array(
					'post_type' => 'post' ,
					'orderby' => 'date' ,
					'order' => 'DESC' ,
					'posts_per_page' => $posts_per_page,
					'cat'         => $Posts_catID,
					'paged' => $paged,
					'post_parent' => 'parent'
				);
				$category = new WP_Query($args);
				?>

				<?php if ( $category->have_posts() ) : ?>
					<?php while ( $category->have_posts() ) : $category->the_post(); ?>

                        <article class="blog-design-default blog-post-loop blog-style-shadow post-46621 post type-post status-publish format-standard has-post-thumbnail hentry category-52 category-220 category-recommended category-85 tag--fpga">
                            <div class="article-inner">
                                <header class="entry-header">
                                    <figure id="carousel-801" class="entry-thumbnail"><div class="post-img-wrapp">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>">
												<?php the_post_thumbnail( 'large' ); ?>
                                            </a>
                                        </div>
                                        <div class="post-image-mask"> <span></span></div>
                                    </figure>

                                    <div class="post-date woodmart-post-date" onclick="">
                                        <span class="post-date-day"> <?php echo get_the_date( 'j' ); ?> </span>
                                        <span class="post-date-month"> <?php echo get_the_date( ' M ' ); ?></span>
                                    </div>
                                </header>

                                <div class="article-body-container">
                                    <div class="meta-categories-wrapp">
                                        <div class="meta-post-categories">
											<?php
											global $post;
											$post_categories = wp_get_post_categories( $post->ID );
											$cats = array();
											$counter1 = 0;
											$counter2 = 0;
											foreach($post_categories as $c){
												$counter1++;
											}
											foreach($post_categories as $c){
												$counter2++;
												$cat = get_category( $c );
												?>
                                                <a href="<?php echo get_site_url().'/category/'.$cat->slug; ?>"><?php echo $cat->name; ?></a>
												<?php
												if($counter2 < $counter1){
													echo ' , ';
												}
											}
											?>
                                        </div>
                                    </div>

                                    <h3 class="entry-title title">
                                        <a href="<?php echo esc_url(get_permalink( )); ?>" rel="bookmark">
											<?php the_title( '', '', true ); ?>
                                        </a>
                                    </h3>

                                    <div class="entry-meta woodmart-entry-meta">
                                        <ul class="entry-meta-list">
                                            <li class="meta-author"> ارسال توسط
												<?php echo get_avatar(get_the_author_meta('ID')); ?>
                                                <a href="<?php echo get_site_url().'/author/'.get_the_author_meta( 'user_login' ); ?>" rel="author">
                                                    <span class="vcard author author_name">
                                                        <span class="fn">
                                                          <?php get_the_author_meta( '',the_author() ); ?>
                                                        </span>
                                                    </span>
                                                </a>
                                                <span class="post-date"> <?php echo 'در '. get_the_date( 'j-M-Y' ); ?> </span>
                                            </li>
                                            <li>
                                                <span class="meta-reply">
                                                    <a href="<?php esc_url(the_permalink()); ?>#respond">
                                                        <span class="replies-count"><?php echo get_comments_number(); ?></span>
                                                        <span class="replies-count-label">دیدگاه</span></a>
                                                </span>
                                            </li>

                                        </ul>
                                    </div>

<!--                                    <div class="hovered-social-icons">-->
<!--                                        <div class="wd-social-icons woodmart-social-icons text-center icons-design-default icons-size-small color-scheme-light social-share social-form-circle">-->
<!--                                            <a rel="noopener noreferrer nofollow" href="https://www.facebook.com/sharer/sharer.php?u=--><?php //esc_url(the_permalink()); ?><!--" target="_blank" class=" wd-social-icon social-facebook"> <span class="wd-icon"></span></a>-->
<!--                                            <a rel="noopener noreferrer nofollow" href="https://twitter.com/share?url=--><?php //esc_url(the_permalink()); ?><!--" target="_blank" class=" woodmart-social-icon social-twitter"> <span class="wd-icon"></span> </a>-->
<!--                                            <a rel="noopener noreferrer nofollow" href="mailto:?subject=Check%20this%20--><?php //esc_url(the_permalink()); ?><!--" target="_blank" class=" woodmart-social-icon social-email"> <span class="wd-icon"></span> </a>-->
<!--                                            <a rel="noopener noreferrer nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=--><?php //esc_url(the_permalink()); ?><!--" target="_blank" class=" woodmart-social-icon social-linkedin"> <span class="wd-icon"></span> </a>-->
<!--                                            <a rel="noopener noreferrer nofollow" href="https://wa.me/?text=--><?php //esc_url(the_permalink()); ?><!--" target="_blank" class="whatsapp-desktop woodmart-social-icon social-whatsapp"> <span class="wd-icon"></span> </a>-->
<!--                                            <a rel="noopener noreferrer nofollow" href="https://telegram.me/share/url?url=--><?php //esc_url(the_permalink()); ?><!--" target="_blank" class=" woodmart-social-icon social-tg"> <span class="wd-icon"></span> </a>-->
<!--                                        </div>-->
<!--                                    </div>-->

                                    <div class="entry-content woodmart-entry-content">
										<?php the_excerpt(); ?>
                                    </div>
                                </div>
                        </article>

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
							) , $Posts_catID , $paged_type, $posts_per_page); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
