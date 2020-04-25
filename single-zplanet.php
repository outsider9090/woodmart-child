<?php
/* Variables */
$loginUrl = 'https://sisoog.com/login/';      // آدرس صفحه ورود برای ریدایرکت شدن کاربر وارد نشده بعد از لایک
/* Variables */
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  get_header(); ?>



<div class="site-content col-lg-9 col-12 col-md-9" role="main">

    <input type="hidden" id="url_redirect" data-url="<?php echo $loginUrl; ?>">

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article style="position:relative;" class="post-single-page post-46943 post type-post status-publish format-standard has-post-thumbnail hentry category-quectel- category-simcom category-49 category-recommended">
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
 <div class="entry-meta woodmart-entry-meta">
    <ul class="entry-meta-list">
     <!--  <li class="modified-date"><time class="updated" datetime="۱۳۹۸/۱۲/۵ ۸:۵۳:۲۱">اسفند ۵, ۱۳۹۸</time></li> -->
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
                <span class="source-link">لینک منبع:</span>
                <a href="<?php echo get_post_meta($post->ID, "zplanet-link", true); ?>" rel="nofollow" target="_blank"><?php echo $link; ?>
            </a>
        </div>
        <?php
    }else{
        ?>
        <div class="user-link">
            <a href="#" id="pp_like<?php echo $post->ID ?>" class="like_btn" data-id="<?php echo $post->ID; ?>" style="margin-left: 16px;">
                <i class="fa fa-heart"></i>
                <span class="sliked" style="left: 16px;"><?php echo $total_like; ?></span>
            </a>
        </div>
        <?php
    }
}
?>

</div>
<div class="social-left">
    <div class="woodmart-social-icons icons-design-default icons-size-default color-scheme-dark social-share social-form-circle">
        <a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-facebook">
            <i class="fa fa-facebook"></i>
            <span class="woodmart-social-icon-name">Facebook</span>
        </a>
        <a rel="nofollow" href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-twitter">
            <i class="fa fa-twitter"></i>
            <span class="woodmart-social-icon-name">Twitter</span>
        </a>
        <a rel="nofollow" href="mailto:?subject=Check%20this%20<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-email">
            <i class="fa fa-envelope"></i>
            <span class="woodmart-social-icon-name">Email</span>
        </a>

        <a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-linkedin">
            <i class="fa fa-linkedin"></i>
            <span class="woodmart-social-icon-name">linkedin</span>
        </a>
        <a rel="nofollow" href="https://wa.me/?text=<?php esc_url(the_permalink()); ?>" target="_blank" class="whatsapp-desktop woodmart-social-icon social-whatsapp">
            <i class="fa fa-whatsapp"></i>
            <span class="woodmart-social-icon-name">WhatsApp</span>
        </a>
        <a rel="nofollow" href="https://telegram.me/share/url?url=<?php esc_url(the_permalink()); ?>" target="_blank" class=" woodmart-social-icon social-tg">
            <i class="fa fa-telegram"></i>
            <span class="woodmart-social-icon-name">Telegram</span>
        </a>
    </div>
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

<?php  get_sidebar(); ?>
<?php get_footer(); ?>
