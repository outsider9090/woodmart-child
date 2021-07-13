<?php
/* Variables */
$loginUrl = get_option('ztools_planet_loginUrl',''); // آدرس صفحه ورود برای ریدایرکت شدن کاربر وارد نشده بعد از لایک
/* Variables */
?>


<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<?php  get_header(); ?>



<div class="site-content col-lg-9 col-12 col-md-9" role="main">

    <input type="hidden" id="url_redirect" data-url="<?php echo $loginUrl; ?>">

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php global $post; ?>
            <article style="position:relative;" id="<?php echo $post->ID; ?>"
                     class="post-single-page post type-post status-publish format-standard has-post-thumbnail hentry category-quectel- category-simcom category-49 category-recommended">
                <div class="article-cover">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>

                <div class="article-inner">
					<?php
					global $post;
					$post_categories = wp_get_post_terms($post->ID, 'zcategory');
					if ($post_categories){
						?>
                        <div class="meta-post-categories">
							<?php
							$cats = array();
							$counter1 = 0;
							$counter2 = 0;
							foreach($post_categories as $cat){
								$counter1++;
							}
							foreach($post_categories as $cat){
								$counter2++;
								?>
                                <a href="<?php echo get_site_url().'/planet-category/'.$cat->slug; ?>"><?php echo $cat->name; ?></a>
								<?php
								if($counter2 < $counter1){
									echo ' , ';
								}
							}
							?>
                        </div>
						<?php
					}
					?>
                    <h1 class="entry-title"><?php the_title( '', '', true ); ?></h1>
                    <div class="entry-meta wd-entry-meta">
                        <ul class="entry-meta-list">
                            <li class="meta-author"> ارسال توسط
								<?php echo get_avatar(get_the_author_meta('ID')); ?>
                                <a href="<?php echo get_site_url().'/author/'.get_the_author_meta( 'user_login' ); ?>" rel="author">
                                     <span class="vcard author author_name">
                                         <span class="fn"><?php get_the_author_meta( '',the_author() ); ?></span>
                                     </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <header class="entry-header">
						<?php
						if ( has_post_thumbnail() ) {
							?>
                            <figure class="entry-thumbnail">
                                <img width="900" height="431" src="<?php echo get_the_post_thumbnail_url($post->ID , 'large') ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php the_title(); ?>" sizes="(max-width: 900px) 100vw, 900px">
                            </figure>
                            <div class="post-date woodmart-post-date">
                                <span class="post-date-day"> <?php echo get_the_date( 'j' ); ?> </span>
                                <span class="post-date-month"> <?php echo get_the_date( ' M ' ); ?></span>
                            </div>
							<?php
						}
						?>
                    </header>

                    <div class="article-body-container">
                        <div class="entry-content woodmart-entry-content">
                            <div style="display:block;">
                                <div class="social">
                                    <div class="social-right">
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
										$input = get_post_meta($post->ID, "zplanet-link", true);
										$link = secureLink($input , $post ,'zplanet-link');
										if (! $row1){
											if ($link !== 0){
												?>
                                                <div class="user-link">
                                                    <a href="#" id="pp_like<?php echo $post->ID ?>" class="like_btn" data-id="<?php echo $post->ID; ?>"
                                                       style="margin-left: 16px;">
                                                        <i class="fa fa-heart-o"></i>
                                                        <span class="snotliked" style="left: 20px;"><?php echo $total_like; ?></span>
                                                    </a>
                                                    <span class="source-link"> تاریخ ارسال: <?php echo get_the_date( 'j-M-Y' , $post ) . ' | '; ?></span>
                                                    <span class="source-link">لینک منبع:</span>
                                                    <a href="<?php echo get_post_meta($post->ID, "zplanet-link", true); ?>" rel="nofollow" target="_blank"><?php echo $link; ?>
                                                    </a>
                                                </div>
												<?php
											}else{
												?>
                                                <div class="user-link">
                                                    <a href="#" id="pp_like<?php echo $post->ID ?>" class="like_btn" data-id="<?php echo $post->ID; ?>"
                                                       style="margin-left: 16px;">
                                                        <i class="fa fa-heart-o"></i>
                                                        <span class="snotliked" style="left: 16px;"><?php echo $total_like; ?></span>
                                                    </a>
                                                    <span class="source-link"> تاریخ ارسال: <?php echo get_the_date( 'j-M-Y' , $post ) ; ?></span>
                                                </div>
												<?php
											}
										}else{
											if ($link !== 0){
												?>
                                                <div class="user-link">
                                                    <a href="#" id="pp_like<?php echo $post->ID ?>" class="like_btn" data-id="<?php echo $post->ID; ?>" style="margin-left: 16px;">
                                                        <i class="fa fa-heart"></i>
                                                        <span class="sliked" style="left: 20px;"><?php echo $total_like; ?></span>
                                                    </a>
                                                    <span class="source-link"> تاریخ ارسال: <?php echo get_the_date( 'j-M-Y' , $post ) . ' | '; ?></span>
                                                    <span class="source-link">لینک منبع:</span>
                                                    <a href="<?php echo get_post_meta($post->ID, "zplanet-link", true); ?>" rel="nofollow" target="_blank"><?php echo $link; ?></a>
                                                </div>
												<?php
											}else{
												?>
                                                <div class="user-link">
                                                    <a href="#" id="pp_like<?php echo $post->ID ?>" class="like_btn" data-id="<?php echo $post->ID; ?>" style="margin-left: 16px;">
                                                        <i class="fa fa-heart"></i>
                                                        <span class="sliked" style="left: 16px;"><?php echo $total_like; ?></span>
                                                    </a>
                                                    <span class="source-link"> تاریخ ارسال: <?php echo get_the_date( 'j-M-Y' , $post ) ; ?></span>
                                                </div>
												<?php
											}
										}
										?>

                                    </div>
                                </div>

                            </div>
                            <div style="clear:both;"></div>


                            <div class="article-content">
                                <p class="text-justify"><?php the_content(); ?></p>
                            </div>

                        </div>
                    </div>
            </article>


            <div class="publish">

                <div class="post-share-container">
                    <div class="woodmart-single-footer" style="width: 100%;">
                        <div class="post-share">
	                        <?php if ( woodmart_get_opt( 'blog_share' ) && woodmart_is_social_link_enable( 'share' ) ): ?>
                                <div class="single-post-social">
			                        <?php if( function_exists( 'woodmart_shortcode_social' ) ) echo woodmart_shortcode_social(
				                        array('type' => 'share', 'tooltip' => 'no', 'style' => 'colored', 'page_link' => wp_get_shortlink( 0, 'post', true )))
			                        ?>
                                </div>
	                        <?php endif ?>
                            <div data-action="copy" class="shorturl-input">
                                <a onclick="myFunction()" class="woodmart-tooltip" data-original-title="لینک کوتاه" title="لینک کوتاه" style="cursor: pointer;" >
                                    <span class="shortUrl-text"><?php echo  wp_get_shortlink( 0, 'post', true ); ?></span>
                                    <i class="fa fa-copy fa-lg"></i>
                                </a>
                                <input type ="hidden" value="<?php echo  wp_get_shortlink( 0, 'post', true ); ?>" id="short_link" >
                                <span id="shorturl-msg">کپی شد</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6 support">
                            <a href="https://www.payping.ir/sisoog">
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



            <div class="woodmart-single-footer">
                <div class="single-meta-tags">
                    <span class="tags-title">برچسب ها:</span>
                    <div class="tags-list">
						<?php
						$tags = get_the_term_list( get_the_ID(), 'ztags', '', ',' );
						echo gettype($tags);
						if ( ! empty( $tags ) ) {
							echo $tags;
						}
						?>
                    </div>
                </div>
            </div>
		<?php endwhile; ?>
	<?php else : ?>
        <p class="alert alert-danger text-center my-4 w-100">مطلبی برای نمایش وجود ندارد!</p>
	<?php endif; ?>


    <!-- Comments -->
	<?php
	comments_template( '/comments.php', false );
	?>

</div>


<audio id="audio" src="<?php echo get_stylesheet_uri().'/../assets/beep.wav';
?>" ></audio>

<!--  Custom tooltip  -->
<div id="tooltip" class="arrow_box">
    <a href="#" id="twitter_intent"><i class="fa fa-twitter"></i></a>
</div>
<p id="selTxt" class=""></p>


<?php  get_sidebar(); ?>
<?php get_footer(); ?>



<script type="text/javascript">
    function copyStringToClipboard (str) {
        var el = document.createElement('textarea');
        el.value = str;
        el.setAttribute('readonly', '');
        el.style = {position: 'absolute', left: '-9999px'};
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    }
    function myFunction() {
        var copyText = document.getElementById("short_link");
        copyStringToClipboard(copyText.value);
        var sound = document.getElementById("audio");
        sound.play();
        document.getElementById('shorturl-msg').style.display = "block";
        setTimeout(function() {
            document.getElementById('shorturl-msg').style.display = "none";
        }, 2000);
    }
</script>
