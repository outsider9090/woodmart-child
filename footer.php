<?php
/**
 * The template for displaying the footer
 *
 */
?>
<?php if ( woodmart_needs_footer() ): ?>
	<?php if ( ! woodmart_is_woo_ajax() ): ?>
		</div><!-- .main-page-wrapper --> 
	<?php endif ?>
		</div> <!-- end row -->
	</div> <!-- end container -->
	<?php
		$page_id = woodmart_page_ID();
		$disable_prefooter = get_post_meta( $page_id, '_woodmart_prefooter_off', true );
		$disable_footer_page = get_post_meta( $page_id, '_woodmart_footer_off', true );
		$disable_copyrights_page = get_post_meta( $page_id, '_woodmart_copyrights_off', true );
	?>
	<?php if ( ! $disable_prefooter && woodmart_get_opt( 'prefooter_area' ) ): ?>
		<div class="woodmart-prefooter">
			<div class="container">
				<?php echo do_shortcode( woodmart_get_opt( 'prefooter_area' ) ); ?>
			</div>
		</div>
	<?php endif ?>
	
	<!-- FOOTER -->
	<footer class="footer-container color-scheme-<?php echo esc_attr( woodmart_get_opt( 'footer-style' ) ); ?>">

		<?php
			if ( ! $disable_footer_page && woodmart_get_opt( 'disable_footer' ) ) {
				get_sidebar( 'footer' );
			}
		 ?>
		<?php if ( !$disable_copyrights_page && woodmart_get_opt( 'disable_copyrights' ) ): ?>
			<div class="copyrights-wrapper copyrights-<?php echo esc_attr( woodmart_get_opt( 'copyrights-layout' ) ); ?>">
				<div class="container">
					<div class="min-footer">
						<div class="col-left reset-mb-10">
							<?php if ( woodmart_get_opt( 'copyrights' ) != '' ): ?>
								<?php echo do_shortcode( woodmart_get_opt( 'copyrights' ) ); ?>
							<?php else: ?>
								<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'All rights reserved', 'woodmart' ) ?></p>
							<?php endif ?>
						</div>
						<?php if ( woodmart_get_opt( 'copyrights2' ) != '' ): ?>
							<div class="col-right reset-mb-10">
								<?php echo do_shortcode( woodmart_get_opt( 'copyrights2' ) ); ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endif ?>


        <!--  start Show author_donations link -->
		<?php
		if (is_user_logged_in()){
			$user_id = get_current_user_id();
			$user = get_userdata($user_id);

			$allowed_roles = array('editor', 'administrator', 'author');
		if( array_intersect($allowed_roles, $user->roles ) ) {
			?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('.wd-sub-menu.sub-menu').append('<li id="menu-item-999999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-999999 item-level-1"><a href="https://sisoog.com/author_donations/" class="woodmart-nav-link">حمایت های انجام شده از شما</a></li>');
                })
            </script>
		<?php
		}
		} else {
		?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    const elm = $('#menu-item-999999');
                    if(elm == null){
                        $('.wd-sub-menu.sub-menu').remove('<li id="menu-item-999999"</li>');
                    }
                })
            </script>
			<?php
		}
		?>
        <!--  start Show author_donations link -->


    </footer>


    <!-- Notify Modal -->
    <div class="modal_container" role="document">
        <!--Body-->
        <div class="modal_body">
            <div class="row">
                <img src="<?php echo get_stylesheet_directory_uri() . '/images/isee-logo.png'  ; ?>" alt="آی سی سیسوگ">
                <a href="https://isee.sisoog.com/" target="_blank" id="notify_link">آی سی Isee - موتور جستجو قطعات الکترونیکی</a>
            </div>
            <div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">
                            <i class="fa fa-arrow-left"></i>
                        </span>
                </button>
            </div>
        </div>
    </div>
    <!-- Notify Modal -->


<?php endif ?>
</div> <!-- end wrapper -->
<div class="woodmart-close-side"></div>
<?php do_action( 'woodmart_before_wp_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
