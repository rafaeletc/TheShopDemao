<?php
/**
 * TheShop Theme Customizer
 *
 * @package TheShopDemao
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theshop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section( 'title_tagline' )->priority     = '9';
    $wp_customize->get_section( 'title_tagline' )->title        = __('Site branding', 'theshopdemao');
    $wp_customize->get_section( 'title_tagline' )->panel        = 'theshop_header_panel';
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );

    //Titles
    class TheShop_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border-bottom:1px solid;padding:5px;color:#111;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }

    //___General___//
    $wp_customize->add_section(
        'theshop_general',
        array(
            'title' => __('General', 'theshopdemao'),
            'priority' => 9,
        )
    );
    //___Preloader___//
    $wp_customize->add_setting(
        'preloader_text',
        array(
            'sanitize_callback' => 'theshop_sanitize_text',
            'default' => __('Loading&hellip;','theshopdemao'),
        )
    );
    $wp_customize->add_control(
        'preloader_text',
        array(
            'label' => __( 'Preloader text', 'theshopdemao' ),
            'section' => 'theshop_general',
            'type' => 'text',
            'priority' => 11
        )
    );

    //___Header area___//
    $wp_customize->add_panel( 'theshop_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header area', 'theshopdemao'),
    ) );
    //Logo Upload
    $wp_customize->add_setting(
        'site_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',

        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
               'label'          => __( 'Upload your logo', 'theshopdemao' ),
               'type'           => 'image',
               'section'        => 'title_tagline',
               'settings'       => 'site_logo',
               'priority'       => 11,
            )
        )
    );
    //Logo size
    $wp_customize->add_setting(
        'logo_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '80',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'logo_size', array(
        'type'        => 'number',
        'priority'    => 12,
        'section'     => 'title_tagline',
        'label'       => __('Logo size', 'theshopdemao'),
        'description' => __('Max-height for the logo. Default 80px', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 50,
            'max'   => 600,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );

    //___Promo boxes___//
    $wp_customize->add_section(
        'theshop_header_boxes',
        array(
            'title'     => __('Promo boxes', 'theshopdemao'),
            'priority'  => 11,
            'panel'     => 'theshop_header_panel',
            'description' => '<em>' . __('You can find a full set of available icons ', 'theshopdemao') . '<a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">' . __('here', 'theshopdemao') . '</a></em>'
        )
    );
    //Box 1
    $wp_customize->add_setting(
        'block_icon_1',
        array(
            'default' => 'fa-rocket',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'block_icon_1',
        array(
            'label' => __( 'Box 1 icon', 'theshopdemao' ),
            'section' => 'theshop_header_boxes',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'block_text_1',
        array(
            'default' => __( 'Free shipping', 'theshopdemao' ),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'block_text_1',
        array(
            'label' => __( 'Box 1 text', 'theshopdemao' ),
            'section' => 'theshop_header_boxes',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Box 2
    $wp_customize->add_setting(
        'block_icon_2',
        array(
            'default' => 'fa-money',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'block_icon_2',
        array(
            'label' => __( 'Box 2 icon', 'theshopdemao' ),
            'section' => 'theshop_header_boxes',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'block_text_2',
        array(
            'default' => __( 'Friendly prices', 'theshopdemao' ),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'block_text_2',
        array(
            'label' => __( 'Box 2 text', 'theshopdemao' ),
            'section' => 'theshop_header_boxes',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Box 3
    $wp_customize->add_setting(
        'block_icon_3',
        array(
            'default' => 'fa-clock-o',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'block_icon_3',
        array(
            'label' => __( 'Box 3 icon', 'theshopdemao' ),
            'section' => 'theshop_header_boxes',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'block_text_3',
        array(
            'default' => __( 'Always on time', 'theshopdemao' ),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'block_text_3',
        array(
            'label' => __( 'Box 3 text', 'theshopdemao' ),
            'section' => 'theshop_header_boxes',
            'type' => 'text',
            'priority' => 10
        )
    );
    //___Header type___//
    $wp_customize->add_section(
        'theshop_header_type',
        array(
            'title'     => __('Header type', 'theshopdemao'),
            'priority'  => 11,
            'panel'     => 'theshop_header_panel',
        )
    );
    $wp_customize->add_setting(
        'header_active_front',
        array(
            'default'           => 'full',
            'sanitize_callback' => 'theshop_sanitize_header_style',
        )
    );
    $wp_customize->add_control(
        'header_active_front',
        array(
            'type'          => 'radio',
            'priority'      => 11,
            'label'         => __('Homepage header type', 'theshopdemao'),
            'description'   => __('Please note that this applies only when you have set a static front page.', 'theshopdemao'),
            'section'       => 'theshop_header_type',
            'choices'       => array(
                'top-bar'       => __('Only top bar', 'theshopdemao'),
                'full'          => __('Full header area (top bar, side menu, slider)', 'theshopdemao'),
            ),
        )
    );
    $wp_customize->add_setting(
        'header_active_site',
        array(
            'default'           => 'top-bar',
            'sanitize_callback' => 'theshop_sanitize_header_style',

        )
    );
    $wp_customize->add_control(
        'header_active_site',
        array(
            'type'          => 'radio',
            'priority'      => 11,
            'label'         => __('Site header type', 'theshopdemao'),
            'description'   => __('Applies to all pages except the homepage.', 'theshopdemao'),
            'section'       => 'theshop_header_type',
            'choices'       => array(
                'top-bar'       => __('Only top bar', 'theshopdemao'),
                'full'          => __('Full header area (top bar, side menu, slider)', 'theshopdemao'),
            ),
        )
    );



    //___Menu style___//
    $wp_customize->add_section(
        'theshop_menu_style',
        array(
            'title'         => __('Menu style', 'theshopdemao'),
            'priority'      => 15,
            'panel'         => 'theshop_header_panel',
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'inline',
            'sanitize_callback' => 'theshop_sanitize_menu_style',
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu style', 'theshopdemao'),
            'section'   => 'theshop_menu_style',
            'choices'   => array(
                'inline'     => __('Inline', 'theshopdemao'),
                'centered'   => __('Centered', 'theshopdemao'),
            ),
        )
    );
    //Padding
    $wp_customize->add_setting(
        'branding_padding',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
        )
    );
    $wp_customize->add_control( 'branding_padding', array(
        'type'        => 'number',
        'priority'    => 14,
        'section'     => 'theshop_menu_style',
        'label'       => __('Top bar padding', 'theshopdemao'),
        'description' => __('Top&amp;bottom padding for the top bar. Default: 30px', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ),
    ) );

    //___Side menu___//
    $wp_customize->add_section(
        'theshop_slider',
        array(
            'title'         => __('Slider', 'theshopdemao'),
            'priority'      => 16,
            'panel'         => 'theshop_header_panel',
            'description'   => '<em>' . __('The slider supports up to five images. Recommended sizes: 830 X 550px (if the side menu is enabled) and 1140 X 600px (if the side menu is disabled)', 'theshopdemao') . '</em>',
        )
    );
    //Image 1
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new theshop_Info( $wp_customize, 's1', array(
        'label' => __('First slide', 'theshopdemao'),
        'section' => 'theshop_slider',
        'settings' => 'theshop_options[info]',
        'priority' => 10
        ) )
    );
    $wp_customize->add_setting(
        'slider_image_1',
        array(
            'default' => get_template_directory_uri() . '/images/1.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_1',
            array(
               'label'          => __( 'Slider image 1', 'theshopdemao' ),
               'type'           => 'image',
               'section'        => 'theshop_slider',
               'priority'       => 10,
            )
        )
    );
    //Link
    $wp_customize->add_setting(
        'slider_link_1',
        array(
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_link_1',
        array(
            'label' => __( 'Link for this slide', 'theshopdemao' ),
            'section' => 'theshop_slider',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Image 2
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new theshop_Info( $wp_customize, 's2', array(
        'label' => __('Second slide', 'theshopdemao'),
        'section' => 'theshop_slider',
        'settings' => 'theshop_options[info]',
        'priority' => 10
        ) )
    );
    $wp_customize->add_setting(
        'slider_image_2',
        array(
            'default' => get_template_directory_uri() . '/images/2.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_2',
            array(
               'label'          => __( 'Slider image 2', 'theshopdemao' ),
               'type'           => 'image',
               'section'        => 'theshop_slider',
               'priority'       => 10,
            )
        )
    );
    //Link
    $wp_customize->add_setting(
        'slider_link_2',
        array(
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_link_2',
        array(
            'label' => __( 'Link for this slide', 'theshopdemao' ),
            'section' => 'theshop_slider',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Image 3
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new theshop_Info( $wp_customize, 's3', array(
        'label' => __('Third slide', 'theshopdemao'),
        'section' => 'theshop_slider',
        'settings' => 'theshop_options[info]',
        'priority' => 10
        ) )
    );
    $wp_customize->add_setting(
        'slider_image_3',
        array(
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_3',
            array(
               'label'          => __( 'Slider image 3', 'theshopdemao' ),
               'type'           => 'image',
               'section'        => 'theshop_slider',
               'priority'       => 10,
            )
        )
    );
    //Link
    $wp_customize->add_setting(
        'slider_link_3',
        array(
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_link_3',
        array(
            'label' => __( 'Link for this slide', 'theshopdemao' ),
            'section' => 'theshop_slider',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Image 4
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new theshop_Info( $wp_customize, 's4', array(
        'label' => __('Fourth slide', 'theshopdemao'),
        'section' => 'theshop_slider',
        'settings' => 'theshop_options[info]',
        'priority' => 10
        ) )
    );
    $wp_customize->add_setting(
        'slider_image_4',
        array(
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_4',
            array(
               'label'          => __( 'Slider image 4', 'theshopdemao' ),
               'type'           => 'image',
               'section'        => 'theshop_slider',
               'priority'       => 10,
            )
        )
    );
    //Link
    $wp_customize->add_setting(
        'slider_link_4',
        array(
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_link_4',
        array(
            'label' => __( 'Link for this slide', 'theshopdemao' ),
            'section' => 'theshop_slider',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Image 5
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new theshop_Info( $wp_customize, 's5', array(
        'label' => __('Fifth slide', 'theshopdemao'),
        'section' => 'theshop_slider',
        'settings' => 'theshop_options[info]',
        'priority' => 10
        ) )
    );
    $wp_customize->add_setting(
        'slider_image_5',
        array(
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_5',
            array(
               'label'          => __( 'Slide image 5', 'theshopdemao' ),
               'type'           => 'image',
               'section'        => 'theshop_slider',
               'priority'       => 10,
            )
        )
    );
    //Link
    $wp_customize->add_setting(
        'slider_link_5',
        array(
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_link_5',
        array(
            'label' => __( 'Link for this slide', 'theshopdemao' ),
            'section' => 'theshop_slider',
            'type' => 'text',
            'priority' => 10
        )
    );

    //___Side menu___//
    $wp_customize->add_section(
        'theshop_secondary_menu',
        array(
            'title'         => __('Side menu', 'theshopdemao'),
            'priority'      => 17,
            'panel'         => 'theshop_header_panel',
            'description'   => '<em><p>' . __('To configure your side menu, go to Appearance > Menus, create a menu and assign it to the Side Menu position.', 'theshopdemao') . '</p><p>' . __('Notes: <br> 1. the side menu only shows up if your slider is active; <br> 2. hiding the menu makes the slider full width.', 'theshopdemao') . '</p></em>',
        )
    );
    $wp_customize->add_setting(
        'side_menu',
        array(
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'side_menu',
        array(
            'type'      => 'checkbox',
            'label'     => __('Hide the side menu?', 'theshopdemao'),
            'section'   => 'theshop_secondary_menu',
            'priority'  => 10,
        )
    );

    //___Sections___//
    $wp_customize->add_panel( 'theshop_sections', array(
        'priority'       => 12,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Homepage sections', 'theshopdemao'),
    ) );

    //___Content___//
    $wp_customize->add_section(
        'sections_content',
        array(
            'title'     => __('Sections content', 'theshopdemao'),
            'priority'  => 10,
            'panel'     => 'theshop_sections'
        )
    );
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'sectionc1', array(
        'label'     => __('Latest products', 'theshopdemao'),
        'section'   => 'sections_content',
        'settings'  => 'theshop_options[info]',
        'priority'  => 10
        ) )
    );
    //Activate
    $wp_customize->add_setting(
        'products_activate',
        array(
            'default'           => 1,
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'products_activate',
        array(
            'type'      => 'checkbox',
            'label'     => __('Activate this section?', 'theshopdemao'),
            'section'   => 'sections_content',
            'priority'  => 11,
        )
    );
    //Title
    $wp_customize->add_setting(
        'products_title',
        array(
            'default'           => __('Latest products', 'theshopdemao'),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'products_title',
        array(
            'label'     => __( 'Section title', 'theshopdemao' ),
            'section'   => 'sections_content',
            'type'      => 'text',
            'priority'  => 12
        )
    );
    //Number
    $wp_customize->add_setting(
        'products_number',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '4',
        )
    );
    $wp_customize->add_control( 'products_number', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'sections_content',
        'label'       => __('Number of products', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 1,
            'max'   => 20,
            'step'  => 1,
            'style' => 'padding: 5px 10px;',
        ),
    ) );

    //CTA
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'sectionc2', array(
        'label'     => __('Call to action', 'theshopdemao'),
        'section'   => 'sections_content',
        'settings'  => 'theshop_options[info]',
        'priority'  => 14
        ) )
    );
    //Activate
    $wp_customize->add_setting(
        'cta_activate',
        array(
            'default'           => 1,
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'cta_activate',
        array(
            'type'      => 'checkbox',
            'label'     => __('Activate this section?', 'theshopdemao'),
            'section'   => 'sections_content',
            'priority'  => 15,
        )
    );
    //Text
    $wp_customize->add_setting(
        'cta_text',
        array(
            'default'           => __('Are you ready to see more?', 'theshopdemao'),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'cta_text',
        array(
            'label'     => __( 'Text', 'theshopdemao' ),
            'section'   => 'sections_content',
            'type'      => 'text',
            'priority'  => 16
        )
    );
    //Button
    $wp_customize->add_setting(
        'cta_button_title',
        array(
            'default'           => __('VISIT OUR SHOP', 'theshopdemao'),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'cta_button_title',
        array(
            'label'     => __( 'Button title', 'theshopdemao' ),
            'section'   => 'sections_content',
            'type'      => 'text',
            'priority'  => 17
        )
    );
    $wp_customize->add_setting(
        'cta_button_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'cta_button_url',
        array(
            'label'     => __( 'Button URL', 'theshopdemao' ),
            'section'   => 'sections_content',
            'type'      => 'text',
            'priority'  => 18
        )
    );


    //Cats
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'sectionc3', array(
        'label'     => __('Product categories', 'theshopdemao'),
        'section'   => 'sections_content',
        'settings'  => 'theshop_options[info]',
        'priority'  => 19
        ) )
    );
    //Activate
    $wp_customize->add_setting(
        'cats_activate',
        array(
            'default'           => 1,
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'cats_activate',
        array(
            'type'      => 'checkbox',
            'label'     => __('Activate this section?', 'theshopdemao'),
            'section'   => 'sections_content',
            'priority'  => 20,
        )
    );
    //Title
    $wp_customize->add_setting(
        'cats_title',
        array(
            'default'           => __('Product categories', 'theshopdemao'),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'cats_title',
        array(
            'label'     => __( 'Section title', 'theshopdemao' ),
            'section'   => 'sections_content',
            'type'      => 'text',
            'priority'  => 21
        )
    );
    //Number
    $wp_customize->add_setting(
        'cats_number',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '3',
        )
    );
    $wp_customize->add_control( 'cats_number', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'sections_content',
        'label'       => __('Number of categories', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 1,
            'max'   => 20,
            'step'  => 1,
            'style' => 'padding: 5px 10px;',
        ),
    ) );
    //Posts
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'sectionc4', array(
        'label'     => __('Latest posts', 'theshopdemao'),
        'section'   => 'sections_content',
        'settings'  => 'theshop_options[info]',
        'priority'  => 23
        ) )
    );
    //Activate
    $wp_customize->add_setting(
        'posts_activate',
        array(
            'default'           => 1,
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'posts_activate',
        array(
            'type'      => 'checkbox',
            'label'     => __('Activate this section?', 'theshopdemao'),
            'section'   => 'sections_content',
            'priority'  => 24,
        )
    );
    //Title
    $wp_customize->add_setting(
        'posts_title',
        array(
            'default'           => __('Latest posts', 'theshopdemao'),
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'posts_title',
        array(
            'label'     => __( 'Section title', 'theshopdemao' ),
            'section'   => 'sections_content',
            'type'      => 'text',
            'priority'  => 25
        )
    );


    //___Order___//
    $wp_customize->add_section(
        'sections_order',
        array(
            'title'     => __('Sections order', 'theshopdemao'),
            'priority'  => 10,
            'panel'     => 'theshop_sections'
        )
    );

    $section_types = array(
        'products'  => __('Latest products', 'theshopdemao'),
        'cta'       => __('Call to action', 'theshopdemao'),
        'cats'      => __('Product categories', 'theshopdemao'),
        'posts'     => __('Latest posts', 'theshopdemao'),
    );

    $i = 1;
    foreach ($section_types as $key => $section) {
        $wp_customize->add_setting(
            'section_' . $i,
            array(
                'default' => $key,
                'sanitize_callback' => 'theshop_sanitize_section_order',
            )
        );
        $wp_customize->add_control(
            'section_' . $i,
            array(
                'type'      => 'select',
                'priority'  => 10,
                'label'     => __('Section ', 'theshopdemao') . $i,
                'section'   => 'sections_order',
                'choices'   => $section_types
            )
        );
        $i++;
    }


    //___Styling___//
    $wp_customize->add_section(
        'sections_styles',
        array(
            'title'     => __('Sections styling', 'theshopdemao'),
            'priority'  => 10,
            'panel'     => 'theshop_sections'
        )
    );

    $bg_defaults     = array('#fff', '#2C292A', '#f7f7f7', '#fff');
    $color_defaults  = array('#8C8F94', '#fff', '#8C8F94', '#8C8F94');

    $i = 1;
    foreach ($section_types as $key => $section) {

        $wp_customize->add_control( new TheShop_Info( $wp_customize, 'sectionstyles' . $i, array(
            'label'     => $section,
            'section'   => 'sections_styles',
            'settings'  => 'theshop_options[info]',
            'priority'  => 10
            ) )
        );
        //Background color
        $wp_customize->add_setting(
            $key . '_bg_color',
            array(
                'default'           => $bg_defaults[$i-1],
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $key . '_bg_color',
                array(
                    'label'         => __('Background color', 'theshopdemao'),
                    'section'       => 'sections_styles',
                    'priority'      => 10
                )
            )
        );
        //Color
        $wp_customize->add_setting(
            $key . '_color',
            array(
                'default'           => $color_defaults[$i-1],
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $key . '_color',
                array(
                    'label'         => __('Text color', 'theshopdemao'),
                    'section'       => 'sections_styles',
                    'priority'      => 10
                )
            )
        );

    $i++;
    }

    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'theshopdemao'),
            'priority' => 13,
        )
    );
    // Blog layout
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'theshopdemao'),
        'section' => 'blog_options',
        'settings' => 'theshop_options[info]',
        'priority' => 10
        ) )
    );
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'theshopdemao'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'content', array(
        'label' => __('Excerpt', 'theshopdemao'),
        'section' => 'blog_options',
        'settings' => 'theshop_options[info]',
        'priority' => 13
        ) )
    );
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '35',
        )
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt lenght', 'theshopdemao'),
        'description' => __('Excerpt length [default: 55 words]', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ),
    ) );
    //Meta
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'meta', array(
        'label' => __('Meta', 'theshopdemao'),
        'section' => 'blog_options',
        'settings' => 'theshop_options[info]',
        'priority' => 17
        ) )
    );
    //Hide meta index
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'theshop_sanitize_checkbox',
        'default' => 0,
      )
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on index, archives?', 'theshopdemao'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );
    //Hide meta single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
        'sanitize_callback' => 'theshop_sanitize_checkbox',
        'default' => 0,
      )
    );
    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on single posts?', 'theshopdemao'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );
    //Featured images
    $wp_customize->add_setting('theshop_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new TheShop_Info( $wp_customize, 'images', array(
        'label' => __('Featured images', 'theshopdemao'),
        'section' => 'blog_options',
        'settings' => 'theshop_options[info]',
        'priority' => 21
        ) )
    );
    //Index images
    $wp_customize->add_setting(
        'index_feat_image',
        array(
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'index_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Hide featured images on index, archives?', 'theshopdemao'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );
    //Post images
    $wp_customize->add_setting(
        'post_feat_image',
        array(
            'sanitize_callback' => 'theshop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'post_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Hide featured images on single posts?', 'theshopdemao'),
            'section' => 'blog_options',
            'priority' => 23,
        )
    );

    //___Fonts___//
    $wp_customize->add_section(
        'theshop_fonts',
        array(
            'title' => __('Fonts', 'theshopdemao'),
            'priority' => 15,
            'description' => __('You can use any Google Fonts you want for the heading and/or body. See the fonts here: google.com/fonts. See the documentation if you need help with this: athemes.com/documentation/theshop', 'theshopdemao'),
        )
    );
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => 'Open+Sans:400,400italic,600,600italic',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Body font name/style/sets', 'theshopdemao' ),
            'section' => 'theshop_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => '\'Open Sans\', serif',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Body font family', 'theshopdemao' ),
            'section' => 'theshop_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => 'Oswald:300,400,700',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Headings font name/style/sets', 'theshopdemao' ),
            'section' => 'theshop_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => '\'Oswald\', sans-serif',
            'sanitize_callback' => 'theshop_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Headings font family', 'theshopdemao' ),
            'section' => 'theshop_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'theshop_fonts',
        'label'       => __('Site title', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'theshop_fonts',
        'label'       => __('Site description', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'theshop_fonts',
        'label'       => __('H1 font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'theshop_fonts',
        'label'       => __('H2 font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '24',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'theshop_fonts',
        'label'       => __('H3 font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'theshop_fonts',
        'label'       => __('H4 font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'theshop_fonts',
        'label'       => __('H5 font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '12',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'theshop_fonts',
        'label'       => __('H6 font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'theshop_fonts',
        'label'       => __('Body font size', 'theshopdemao'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );

    //___Colors___//
    //Primary color
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#9FAFF1',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'theshopdemao'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 12
            )
        )
    );
    //Menu
    $wp_customize->add_setting(
        'menu_bg',
        array(
            'default'           => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg',
            array(
                'label'         => __('Menu background', 'theshopdemao'),
                'section'       => 'colors',
                'settings'      => 'menu_bg',
                'priority'      => 13
            )
        )
    );
    //Menu items
    $wp_customize->add_setting(
        'menu_color',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_color',
            array(
                'label'         => __('Menu items', 'theshopdemao'),
                'section'       => 'colors',
                'settings'      => 'menu_color',
                'priority'      => 14
            )
        )
    );
    //Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'theshopdemao'),
                'section' => 'colors',
                'settings' => 'site_title_color',
                'priority' => 18
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#a9a9a9',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'theshopdemao'),
                'section' => 'colors',
                'priority' => 19
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#444',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'theshopdemao'),
                'section' => 'colors',
                'settings' => 'body_text_color',
                'priority' => 22
            )
        )
    );

    //___Footer___//
    $wp_customize->add_section(
        'theshop_footer',
        array(
            'title'         => __('Footer widgets', 'theshopdemao'),
            'priority'      => 18,
        )
    );
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'theshop_sanitize_fwidgets',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'theshopdemao'),
            'section'     => 'theshop_footer',
            'description' => __('Choose the number of widget areas in the footer, then go to Appearance > Widgets and add your widgets.', 'theshopdemao'),
            'choices' => array(
                '1'     => __('One', 'theshopdemao'),
                '2'     => __('Two', 'theshopdemao'),
                '3'     => __('Three', 'theshopdemao'),
            ),
        )
    );

}
add_action( 'customize_register', 'theshop_customize_register' );

/**
* Sanitize
*/
//Text
function theshop_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Checkboxes
function theshop_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
//Footer widget areas
function theshop_sanitize_fwidgets( $input ) {
    if ( in_array( $input, array( '1', '2', '3' ), true ) ) {
        return $input;
    }
}
//Menu style
function theshop_sanitize_menu_style( $input ) {
    if ( in_array( $input, array( 'inline', 'centered' ), true ) ) {
        return $input;
    }
}
//Sections order
function theshop_sanitize_section_order( $input ) {
    if ( in_array( $input, array( 'products', 'cta', 'cats', 'posts' ), true ) ) {
        return $input;
    }
}
//Header type
function theshop_sanitize_header_style( $input ) {
    if ( in_array( $input, array( 'full', 'top-bar' ), true ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theshop_customize_preview_js() {
	wp_enqueue_script( 'theshop_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'theshop_customize_preview_js' );
