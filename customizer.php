<?php
add_action( 'customize_register', 'kadima_customizer' );
function kadima_customizer( $wp_customize ) {
	wp_enqueue_style('customizr', WL_TEMPLATE_DIR_URI .'/css/customizr.css');
    $count12 = array('One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'TEN', 'ELEVEN', 'TWELVE');
	/* Genral section */
	$wp_customize->add_panel( 'kadima_theme_option', array(
        'title' => __( 'Theme Options','kadima' ),
        'priority' => 1, // Mixed with top-level-section hierarchy.
    ) );
    $wp_customize->add_section(
        'general_sec',
        array(
            'title' => __( 'Theme General Options','kadima' ),
            'description' => 'Here you can customize Your theme\'s general Settings',
			'panel'=>'kadima_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
        )
    );
	$wl_theme_options = kadima_get_options();
	$wp_customize->add_setting(
		'kadima_options[_frontpage]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['_frontpage'],
			'sanitize_callback'=>'kadima_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'kadima_front_page', array(
		'label'        => __( 'Show Front Page', 'kadima' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'kadima_options[_frontpage]',
	) );
    /* Logo */
	$wp_customize->add_setting(
		'kadima_options[upload_image_logo]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['upload_image_logo'],
			'sanitize_callback'=>'esc_url_raw',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting(
		'kadima_options[height]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['height'],
			'sanitize_callback'=>'kadima_sanitize_integer',
			'capability'        => 'edit_theme_options'
		)
	);
	$wp_customize->add_setting(
		'kadima_options[width]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['width'],
			'sanitize_callback'=>'kadima_sanitize_integer',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kadima_upload_image_logo', array(
		'label'        => __( 'Website Logo', 'kadima' ),
		'section'    => 'general_sec',
		'settings'   => 'kadima_options[upload_image_logo]',
	) ) );
	$wp_customize->add_control( 'kadima_logo_height', array(
		'label'        => __( 'Logo Height', 'kadima' ),
		'type'=>'number',
		'section'    => 'general_sec',
		'settings'   => 'kadima_options[height]',
	) );
	$wp_customize->add_control( 'kadima_logo_width', array(
		'label'        => __( 'Logo Width', 'kadima' ),
		'type'=>'number',
		'section'    => 'general_sec',
		'settings'   => 'kadima_options[width]',
	) );
	$wp_customize->add_setting(
		'kadima_options[upload_image_favicon]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['upload_image_favicon'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kadima_upload_image_favicon', array(
		'label'        => __( 'Custom favicon', 'kadima' ),
		'section'    => 'general_sec',
		'settings'   => 'kadima_options[upload_image_favicon]',
	) ) );
	$wp_customize->add_setting(
	   'kadima_options[custom_css]',
		array(
		'default'=>esc_attr($wl_theme_options['custom_css']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'custom_css', array(
		'label'        => __( 'Custom CSS', 'kadima' ),
		'type'=>'textarea',
		'section'    => 'general_sec',
		'settings'   => 'kadima_options[custom_css]'
	) );
	/* Slider options */
	$wp_customize->add_section(
        'slider_section',
        array(
            'title' =>  __( 'Theme Slider Options','kadima' ),
			'panel'=>'kadima_theme_option',
            'description' => 'Here you can add slider images',
			'capability'=>'edit_theme_options',
            'priority' => 35,
			'active_callback' => 'is_front_page',
        )
    );
    for($i=1;$i<=12;$i++){
        $wp_customize->add_setting(
            'kadima_options[slide_image_'.$i.']',
            array(
                'type' => 'option',
                'default' => $wl_theme_options['slide_image_'.$i],
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        $wp_customize->add_setting(
    		'kadima_options[slide_title_'.$i.']',
    		array(
    			'type' => 'option',
    			'default' => $wl_theme_options['slide_title_'.$i],
    			'capability' => 'edit_theme_options',
    			'sanitize_callback' => 'kadima_sanitize_text',
    		)
    	);
    	$wp_customize->add_setting(
    		'kadima_options[slide_desc_'.$i.']',
    		array(
    			'type'    => 'option',
    			'default' => $wl_theme_options['slide_desc_'.$i],
    			'capability' => 'edit_theme_options',
    			'sanitize_callback' => 'kadima_sanitize_text',
    		)
    	);
    	$wp_customize->add_setting(
    		'kadima_options[slide_btn_text_'.$i.']',
    		array(
    			'type'    => 'option',
    			'default' => $wl_theme_options['slide_btn_text_'.$i],
    			'capability' => 'edit_theme_options',
    			'sanitize_callback' => 'kadima_sanitize_text',
    		)
    	);
    	$wp_customize->add_setting(
    		'kadima_options[slide_btn_link_'.$i.']',
    		array(
    			'type'    => 'option',
    			'default' => $wl_theme_options['slide_btn_link_'.$i],
    			'capability' => 'edit_theme_options',
    			'sanitize_callback' => 'esc_url_raw',
    		)
    	);
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kadima_slider_image_'.$i, array(
    		'label'      => __( 'Slider Image '.$count12[$i-1], 'kadima' ),
    		'section'    => 'slider_section',
    		'settings'   => 'kadima_options[slide_image_'.$i.']'
    	) ) );
    	$wp_customize->add_control( 'slide_title_'.$i, array(
    		'label'      => __( 'Slider Title '.$count12[$i-1], 'kadima' ),
    		'type'       => 'text',
    		'section'    => 'slider_section',
    		'settings'   => 'kadima_options[slide_title_'.$i.']'
    	) );
        $wp_customize->add_control( 'slide_desc_'.$i, array(
    		'label'      => __( 'Slider Description '.$count12[$i-1], 'kadima' ),
    		'type'       => 'text',
    		'section'    => 'slider_section',
    		'settings'   => 'kadima_options[slide_desc_'.$i.']'
    	) );
        $wp_customize->add_control( 'slide_btn_'.$i, array(
    		'label'      => __( 'Slider Button Text '.$count12[$i-1], 'kadima' ),
    		'type'       => 'text',
    		'section'    => 'slider_section',
    		'settings'   => 'kadima_options[slide_btn_text_'.$i.']'
    	) );
        $wp_customize->add_control( 'slide_btnlink_'.$i, array(
    		'label'      => __( 'Slider Button Link '.$count12[$i-1], 'kadima' ),
    		'type'       => 'url',
    		'section'    => 'slider_section',
    		'settings'   => 'kadima_options[slide_btn_link_'.$i.']'
    	) );
    }
	/* Service Options */
	$wp_customize->add_section('service_section',array(
    	'title'=>__("Service Options",'kadima'),
    	'panel'=>'kadima_theme_option',
    	'capability'=>'edit_theme_options',
        'priority' => 35,
    	'active_callback' => 'is_front_page',
	));
	$wp_customize->add_setting(
		'kadima_options[service_home]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['service_home'],
			'sanitize_callback'=>'kadima_sanitize_checkbox',
			'capability' => 'edit_theme_options'
		)
	);
    $wp_customize->add_control(
        'kadima_show_service',
        array(
    		'label'        => __( 'Enable Service on Home', 'kadima' ),
    		'type'=>'checkbox',
    		'section'    => 'service_section',
    		'settings'   => 'kadima_options[service_home]'
    	)
    );
	$wp_customize->add_setting(
	   'kadima_options[service_heading]',
		array(
    		'default'=>esc_attr($wl_theme_options['service_heading']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'service_heading', array(
		'label'        => __( 'Home Service Title', 'kadima' ),
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'kadima_options[service_heading]'
	) );
    for($i=1;$i<=12;$i++){
    	$wp_customize->add_setting(
    	   'kadima_options[service_icons_'.$i.']',
    		array(
        		'default'=>esc_attr($wl_theme_options['service_icons_'.$i]),
        		'type'=>'option',
        		'capability'=>'edit_theme_options',
        		'sanitize_callback'=>'kadima_sanitize_text',
    		)
    	);
        $wp_customize->add_setting(
    	   'kadima_options[service_img_'.$i.']',
    		array(
        		'default'=>esc_attr($wl_theme_options['service_img_'.$i]),
        		'type'=>'option',
        		'capability'=>'edit_theme_options',
        		'sanitize_callback'=>'kadima_sanitize_text',
    		)
    	);
        $wp_customize->add_setting(
    	   'kadima_options[service_title_'.$i.']',
    		array(
        		'default'=>esc_attr($wl_theme_options['service_title_'.$i]),
        		'type'=>'option',
        		'capability'=>'edit_theme_options',
        		'sanitize_callback'=>'kadima_sanitize_text',
    		)
    	);
        $wp_customize->add_setting(
    	   'kadima_options[service_text_'.$i.']',
    		array(
        		'default'=>esc_attr($wl_theme_options['service_text_'.$i]),
        		'type'=>'option',
        		'sanitize_callback'=>'kadima_sanitize_text',
        		'capability'=>'edit_theme_options',
    		)
    	);
        $wp_customize->add_setting(
    	   'kadima_options[service_link_'.$i.']',
    		array(
        		'default'=>esc_attr($wl_theme_options['service_link_'.$i]),
        		'type'=>'option',
        		'capability'=>'edit_theme_options',
        		'sanitize_callback'=>'esc_url_raw',
    		)
        );
        $wp_customize->add_control(
            new kadima_Customize_Misc_Control(
                $wp_customize,
                'service_options'.$i.'-line',
                array(
                    'section'  => 'service_section',
                    'type'     => 'line'
                )
            )
        );
        $wp_customize->add_control( 'service_title_'.$i, array(
    		'label'        => __( 'Service '.$count12[$i-1].' Title', 'kadima' ),
    		'type'=>'text',
    		'section'    => 'service_section',
    		'settings'   => 'kadima_options[service_title_'.$i.']'
    	) );
    	$wp_customize->add_control( 'kadima_options[service_icons_'.$i.']',
            array(
        		'label'        => __( 'Service Icon '.$count12[$i-1], 'kadima' ),
        		'description'=>__('<a href="http://fontawesome.bootstrapcheatsheets.com">FontAwesome Icons</a>','kadima'),
                'section'  => 'service_section',
        		'type'=>'text',
        		'settings'   => 'kadima_options[service_icons_'.$i.']'
            )
        );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kadima_service_img_'.$i, array(
            'label'        => __( 'Service '.$count12[$i-1].' Image', 'kadima' ),
            'section'    => 'service_section',
            'settings'   => 'kadima_options[service_img_'.$i.']'
        ) ) );
    	$wp_customize->add_control( 'service_text_'.$i, array(
    		'label'        => __( 'Service '.$count12[$i-1].' Text', 'kadima' ),
    		'type'=>'text',
    		'section'    => 'service_section',
    		'settings'   => 'kadima_options[service_text_'.$i.']'
    	) );
    	$wp_customize->add_control( 'service_link_'.$i, array(
    		'label'        => __( 'Service '.$count12[$i-1].' Link', 'kadima' ),
    		'type'=>'url',
    		'section'    => 'service_section',
    		'settings'   => 'kadima_options[service_link_'.$i.']'
    	) );
    }
    /* Portfolio Section */
	$wp_customize->add_section(
        'portfolio_section',
        array(
            'title' => __('Portfolio Options','kadima'),
            'description' => __('Here you can add Portfolio title,description and even portfolios','kadima'),
			'panel'=>'kadima_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
        )
    );
	$wp_customize->add_setting(
		'kadima_options[portfolio_home]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['portfolio_home'],
			'sanitize_callback'=>'kadima_sanitize_checkbox',
			'capability' => 'edit_theme_options'
		)
	);
	$wp_customize->add_setting(
		'kadima_options[port_heading]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['port_heading'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_setting(
		'kadima_options[port_description]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['port_description'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
    $wp_customize->add_control( 'show_portfolio', array(
        'label'        => __( 'Enable Portfolio on Home', 'kadima' ),
        'type'=>'checkbox',
        'section'    => 'portfolio_section',
        'settings'   => 'kadima_options[portfolio_home]'
    ) );
    $wp_customize->add_control( 'portfolio_title', array(
        'label'        => __( 'Portfolio Heading', 'kadima' ),
        'type'=>'text',
        'section'    => 'portfolio_section',
        'settings'   => 'kadima_options[port_heading]'
    ) );
    $wp_customize->add_control( 'portfolio_description', array(
        'label'        => __( 'Portfolio Description', 'kadima' ),
        'type'=>'textarea',
        'section'    => 'portfolio_section',
        'settings'   => 'kadima_options[port_description]'
    ) );
    for($i=1;$i<=12;$i++){
		$wp_customize->add_setting(
			'kadima_options[port_img_'.$i.']',
			array(
				'type'    => 'option',
				'default' => $wl_theme_options['port_img_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'esc_url_raw',
			)
		);
		$wp_customize->add_setting(
			'kadima_options[port_title_'.$i.']',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['port_title_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'kadima_sanitize_text',
			)
		);
		$wp_customize->add_setting(
			'kadima_options[port_description_'.$i.']',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['port_description_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'kadima_sanitize_text',
			)
		);
		$wp_customize->add_setting(
			'kadima_options[port_link_'.$i.']',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['port_link_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'esc_url_raw',
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kadima_portfolio_img_'.$i, array(
    		'label'      => __( 'Portfolio Image'.$count12[$i-1], 'kadima' ),
    		'section'    => 'portfolio_section',
    		'settings'   => 'kadima_options[port_img_'.$i.']'
    	) ) );
    	$wp_customize->add_control( 'kadima_portfolio_title_'.$i, array(
    		'label'      => __( 'Portfolio Title '.$count12[$i-1], 'kadima'),
    		'type'       => 'text',
    		'section'    => 'portfolio_section',
    		'settings'   => 'kadima_options[port_title_'.$i.']'
    	) );
		$wp_customize->add_control( 'kadima_portfolio_description_'.$i, array(
    		'label'      => __( 'Portfolio Description '.$count12[$i-1], 'kadima'),
    		'type'       =>'textarea',
    		'section'    => 'portfolio_section',
    		'settings'   => 'kadima_options[port_description_'.$i.']'
    	) );
    	$wp_customize->add_control( 'kadima_portfolio_link_'.$i, array(
    		'label'      => __( 'Portfolio Link '.$count12[$i-1], 'kadima' ),
    		'type'       => 'url',
    		'section'    => 'portfolio_section',
    		'settings'   => 'kadima_options[port_link_'.$i.']'
    	) );
	}
	/* Blog Option */
	$wp_customize->add_section('blog_section',array(
    	'title'=>__('News Options','kadima'),
    	'panel'=>'kadima_theme_option',
    	'capability'=>'edit_theme_options',
        'priority' => 35
	));
	$wp_customize->add_setting(
	   'kadima_options[show_blog]',
		array(
		'default'=>esc_attr($wl_theme_options['show_blog']),
		'type'=>'option',
		'sanitize_callback'=>'kadima_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'show_blog',
        array(
    		'label'        => __( 'Enable Latest News in Header', 'kadima' ),
    		'type'=>'checkbox',
    		'section'    => 'blog_section',
    		'settings'   => 'kadima_options[show_blog]'
    	)
    );
	$wp_customize->add_setting(
		'kadima_options[blog_title]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['blog_title'],
			'sanitize_callback'=>'kadima_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'blog_title',
        array(
    		'label'      => __( 'News Title', 'kadima' ),
    		'type'       =>'text',
    		'section'    => 'blog_section',
    		'settings'   => 'kadima_options[blog_title]',
    	)
    );
	/* About Option */
	$wp_customize->add_section('about_section',array(
    	'title'=>__('About Options','kadima'),
    	'panel'=>'kadima_theme_option',
    	'capability'=>'edit_theme_options',
        'priority' => 35
	) );
	$wp_customize->add_setting(
	   'kadima_options[show_about]',
		array(
		'default'=>esc_attr($wl_theme_options['show_about']),
		'type'=>'option',
		'sanitize_callback'=>'kadima_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'show_about',
        array(
    		'label'        => __( 'Enable About in Header', 'kadima' ),
    		'type'=>'checkbox',
    		'section'    => 'about_section',
    		'settings'   => 'kadima_options[show_about]'
    	)
    );
	$wp_customize->add_setting(
		'kadima_options[about_title]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['about_title'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'about_title',
        array(
    		'label'        => __( 'About Title', 'kadima' ),
    		'type'=>'text',
    		'section'    => 'about_section',
    		'settings'   => 'kadima_options[about_title]',
    	)
    );
	$wp_customize->add_setting(
		'kadima_options[about_description]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['about_description'],
			'sanitize_callback'=>'kadima_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'about_description', array(
		'label'        => __( 'About Description', 'kadima' ),
		'type'=>'textarea',
		'section'    => 'about_section',
		'settings'   => 'kadima_options[about_description]'
	) );
    for($i=1;$i<=12;$i++){
        $wp_customize->add_setting(
			'kadima_options[about_slide_img_'.$i.']',
			array(
				'type'    => 'option',
				'default'=> $wl_theme_options['about_slide_img_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'esc_url_raw',
			)
		);
		$wp_customize->add_setting(
			'kadima_options[about_slide_title_'.$i.']',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['about_slide_title_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'kadima_sanitize_text',
			)
		);
		$wp_customize->add_setting(
			'kadima_options[about_slide_desc_'.$i.']',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['about_slide_desc_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'kadima_sanitize_text',
			)
		);
		$wp_customize->add_setting(
			'kadima_options[about_slide_link_'.$i.']',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['about_slide_link_'.$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'esc_url_raw',
			)
		);
    	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'about_slide_img_'.$i, array(
    		'label'        => __( 'About Slide Image '.$count12[$i-1], 'kadima' ),
    		'section'    => 'about_section',
    		'settings'   => 'kadima_options[about_slide_'.$i.'_img]'
    	) ) );
    	$wp_customize->add_control( 'about_slide_title_'.$i, array(
    		'label'      => __( 'About Slide Title '.$count12[$i-1], 'kadima'),
    		'type'       =>'text',
    		'section'    => 'about_section',
    		'settings'   => 'kadima_options[about_slide_'.$i.'_title]'
    	) );
		$wp_customize->add_control( 'about_slide_description_'.$i, array(
    		'label'      => __( 'About Slide Description '.$count12[$i-1], 'kadima'),
    		'type'       =>'textarea',
    		'section'    => 'about_section',
    		'settings'   => 'kadima_options[about_slide_'.$i.'_description]'
    	) );
    	$wp_customize->add_control( 'about_slide_link_'.$i, array(
    		'label'      => __( 'About Slide Link '.$count12[$i-1], 'kadima' ),
    		'type'       =>'url',
    		'section'    => 'about_section',
    		'settings'   => 'kadima_options[about_slide_'.$i.'_link]'
    	) );
	}
	/* Social options */
	$wp_customize->add_section('social_section',array(
    	'title'=>__("Social Options",'kadima'),
    	'panel'=>'kadima_theme_option',
    	'capability'=>'edit_theme_options',
        'priority' => 35
	));
	$wp_customize->add_setting(
	   'kadima_options[header_social_media_in_enabled]',
		array(
		'default'=>esc_attr($wl_theme_options['header_social_media_in_enabled']),
		'type'=>'option',
		'sanitize_callback'=>'kadima_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'header_social_media_in_enabled',
        array(
    		'label'        => __( 'Enable Social Media Icons in Header', 'kadima' ),
    		'type'=>'checkbox',
    		'section'    => 'social_section',
    		'settings'   => 'kadima_options[header_social_media_in_enabled]'
    	)
    );
	$wp_customize->add_setting(
	   'kadima_options[footer_section_social_media_enbled]',
		array(
    		'default'=>esc_attr($wl_theme_options['footer_section_social_media_enbled']),
    		'type'=>'option',
    		'sanitize_callback'=>'kadima_sanitize_checkbox',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'footer_section_social_media_enbled',
        array(
    		'label'        => __( 'Enable Social Media Icons in Footer', 'kadima' ),
    		'type'=>'checkbox',
    		'section'    => 'social_section',
    		'settings'   => 'kadima_options[footer_section_social_media_enbled]'
    	)
    );
	$wp_customize->add_setting(
	   'kadima_options[email_id]',
		array(
    		'default'=>esc_attr($wl_theme_options['email_id']),
    		'type'=>'option',
    		'sanitize_callback'=>'sanitize_email',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'email_id', array(
		'label'      =>  __('Email ID', 'kadima' ),
		'type'=>'email',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[email_id]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[phone_no]',
		array(
    		'default'=>esc_attr($wl_theme_options['phone_no']),
    		'type'=>'option',
    		'sanitize_callback'=>'kadima_sanitize_text',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'phone_no', array(
		'label'        =>  __('Phone Number', 'kadima' ),
		'type'=>'text',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[phone_no]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[twitter_link]',
		array(
    		'default'=>esc_attr($wl_theme_options['twitter_link']),
    		'type'=>'option',
    		'sanitize_callback'=>'esc_url_raw',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'twitter_link', array(
		'label'        =>  __('Twitter', 'kadima' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[twitter_link]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[fb_link]',
		array(
    		'default'=>esc_attr($wl_theme_options['fb_link']),
    		'type'=>'option',
    		'sanitize_callback'=>'esc_url_raw',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'fb_link', array(
		'label'        => __( 'Facebook', 'kadima' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[fb_link]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[linkedin_link]',
		array(
    		'default'=>esc_attr($wl_theme_options['linkedin_link']),
    		'type'=>'option',
    		'sanitize_callback'=>'esc_url_raw',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'linkedin_link', array(
		'label'        => __( 'LinkedIn', 'kadima' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[linkedin_link]'
	) );
	$wp_customize->add_setting(
        'kadima_options[gplus]',
    		array(
    		'default'=>esc_attr($wl_theme_options['gplus']),
    		'type'=>'option',
    		'sanitize_callback'=>'esc_url_raw',
    		'capability'=>'edit_theme_options'
    		)
	);
	$wp_customize->add_control( 'gplus', array(
		'label'        => __( 'Goole+', 'kadima' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[gplus]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[youtube_link]',
		array(
		'default'=>esc_attr($wl_theme_options['youtube_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'youtube_link', array(
		'label'        => __( 'Youtube', 'kadima' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[youtube_link]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[instagram]',
		array(
    		'default'=>esc_attr($wl_theme_options['instagram']),
    		'type'=>'option',
    		'sanitize_callback'=>'esc_url_raw',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'instagram', array(
		'label'        => __( 'Instagram', 'kadima' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'kadima_options[instagram]'
	) );
	/* Footer callout */
	$wp_customize->add_section('callout_section',array(
    	'title'=>__("Footer Call-Out Options",'kadima'),
    	'panel'=>'kadima_theme_option',
    	'capability'=>'edit_theme_options',
        'priority' => 35
	));
	$wp_customize->add_setting(
	   'kadima_options[fc_home]',
		array(
    		'default'=>esc_attr($wl_theme_options['fc_home']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_home', array(
		'label'        => __( 'Enable Footer callout on HOme', 'kadima' ),
		'type'=>'checkbox',
		'section'    => 'callout_section',
		'settings'   => 'kadima_options[fc_home]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[fc_title]',
		array(
        	'default'=>esc_attr($wl_theme_options['fc_title']),
        	'type'=>'option',
        	'capability'=>'edit_theme_options',
        	'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_title', array(
		'label'        => __( 'Footer callout Title', 'kadima' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'kadima_options[fc_title]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[fc_btn_txt]',
		array(
    		'default'=>esc_attr($wl_theme_options['fc_btn_txt']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_btn_txt', array(
		'label'        => __( 'Footer callout Button Text', 'kadima' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'kadima_options[fc_btn_txt]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[fc_btn_link]',
		array(
    		'default'=>esc_attr($wl_theme_options['fc_btn_link']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_btn_link', array(
		'label'        => __( 'Footer callout Button Link', 'kadima' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'kadima_options[fc_btn_link]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[fc_icon]',
		array(
    		'default'=>esc_attr($wl_theme_options['fc_icon']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_icon', array(
		'label'        => __( 'Footer callout Icon', 'kadima' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'kadima_options[fc_icon]'
	) );
	/* Footer Options */
	$wp_customize->add_section('footer_section',array(
    	'title'=>__("Footer Options",'kadima'),
    	'panel'=>'kadima_theme_option',
    	'capability'=>'edit_theme_options',
        'priority' => 35
	) );
	$wp_customize->add_setting(
	   'kadima_options[footer_customizations]',
		array(
    		'default'=>esc_attr($wl_theme_options['footer_customizations']),
    		'type'=>'option',
    		'sanitize_callback'=>'kadima_sanitize_text',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'footer_customizations', array(
		'label'        => __( 'Footer Customization Text', 'kadima' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'kadima_options[footer_customizations]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[info_copyright]',
		array(
    		'default'=>esc_attr($wl_theme_options['info_copyright']),
    		'type'=>'option',
    		'sanitize_callback'=>'kadima_sanitize_text',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'info_copyright', array(
		'label'        => __( 'Copyright', 'kadima' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'kadima_options[info_copyright]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[info_tel]',
		array(
    		'default'=>esc_attr($wl_theme_options['info_tel']),
    		'type'=>'option',
    		'sanitize_callback'=>'kadima_sanitize_text',
    		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'info_tel', array(
		'label'        => __( 'Tel', 'kadima' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'kadima_options[info_tel]'
	) );
	$wp_customize->add_setting(
	   'kadima_options[info_fax]',
		array(
    		'default'=>esc_attr($wl_theme_options['info_fax']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'info_fax', array(
		'label'        => __( 'Fax', 'kadima' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'kadima_options[info_fax]'
	) );
    $wp_customize->add_setting(
	   'kadima_options[info_mail]',
		array(
    		'default'=>esc_attr($wl_theme_options['info_mail']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'info_mail', array(
		'label'        => __( 'Mail', 'kadima' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'kadima_options[info_mail]'
	) );
    $wp_customize->add_setting(
	   'kadima_options[info_support]',
		array(
    		'default'=>esc_attr($wl_theme_options['info_support']),
    		'type'=>'option',
    		'capability'=>'edit_theme_options',
    		'sanitize_callback'=>'kadima_sanitize_text',
		)
	);
	$wp_customize->add_control( 'info_support', array(
		'label'        => __( 'Power by', 'kadima' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'kadima_options[info_support]'
	) );
}
function kadima_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function kadima_sanitize_checkbox( $input ) {
    return $input;
}
function kadima_sanitize_integer( $input ) {
    return (int)($input);
}
/* Custom Control Class */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'kadima_Customize_Misc_Control' ) ) :
class kadima_Customize_Misc_Control extends WP_Customize_Control {
    public $settings = 'blogname';
    public $description = '';
    public function render_content() {
        switch ( $this->type ) {
            default:

            case 'heading':
                echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
                break;

            case 'line' :
                echo '<hr />';
                break;

        }
    }
}
endif;
?>
