<?php function kadima_scripts()
    {
		wp_enqueue_style('bootstrap', '//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css');
        wp_enqueue_style('default', get_template_directory_uri() . '/css/default.css');
        wp_enqueue_style('animations', '//cdn.bootcss.com/animations/2.1/css/animations.min.css');
        //wp_enqueue_style('theme-animtae', get_template_directory_uri() . '/css/theme-animtae.css');
        wp_enqueue_style('font-awesome', '//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('font-family', get_template_directory_uri() . '/css/font-family.css');
		wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
        // Js
        wp_enqueue_script('menu', get_template_directory_uri() .'/js/menu.js', array('jquery'));
        wp_enqueue_script('bootstrap-js', '//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js');
        wp_enqueue_script('kadima-theme-script', get_template_directory_uri() .'/js/kadima_theme_script.js');
        if(is_front_page()){
            wp_enqueue_script('jquery.carouFredSel', '//cdn.bootcss.com/jquery.caroufredsel/6.2.1/jquery.carouFredSel.packed.js');
            wp_enqueue_script('photobox-js', '//cdn.bootcss.com/photobox/1.9.9/photobox/jquery.photobox.min.js');
            wp_enqueue_style('photobox', '//cdn.bootcss.com/photobox/1.9.9/photobox/photobox.min.css');
    		wp_enqueue_script('kadima-footer-script', get_template_directory_uri() .'/js/kadima-footer-script.js','','',true);
    		wp_enqueue_script('waypoints', '//cdn.bootcss.com/waypoints/4.0.1/jquery.waypoints.min.js','','',true);
    		wp_enqueue_script('scroll', get_template_directory_uri() .'/js/scroll.js','','',true);
		}
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    }
    add_action('wp_enqueue_scripts', 'kadima_scripts');
?>
