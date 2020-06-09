<aside class="sidebar-container col-lg-3 col-md-3 col-12 sidebar-right area-mobile-menu-widgets" role="complementary">
    <div class="widget-heading">
        <a href="#" class="close-side-widget wd-cross-button wd-with-text-left">بستن (Esc)</a>
    </div>
    <div class="sidebar-inner woodmart-sidebar-scroll" style="
    width: 100%; ">
        <div class="widget-area woodmart-sidebar-content">
	        <?php
	        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('planet-sidebar')):
	        endif;
	        ?>
        </div><!-- .widget-area -->
    </div><!-- .sidebar-inner -->
</aside>