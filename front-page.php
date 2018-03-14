<?php
/**
 * Genesis Sample.
 *

 */

// Add landing page body class to the head.
// add_filter( 'body_class', 'genesis_sample_add_body_class' );
// function genesis_sample_add_body_class( $classes ) {

//     $classes[] = 'landing-page';

//     return $classes;

// }

// Remove Skip Links.
// remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script.
// add_action( 'wp_enqueue_scripts', 'genesis_sample_dequeue_skip_links' );
// function genesis_sample_dequeue_skip_links() {
//     wp_dequeue_script( 'skip-links' );
// }
// remove_action('genesis_after_header', 'genesis_do_nav');
// add_action( 'genesis_header', 'genesis_do_nav' );
// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove default page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Add class to .site-container
add_filter('genesis_attr_site-header', 'fnsa_attr_home_page');
function fnsa_attr_home_page($attributes) {
    $attributes['class'] .= ' home-page';
    return $attributes;
}




add_action( 'genesis_after_header', 'fnsa_hero_entry_header' );

function fnsa_hero_entry_header() {

    $hero = get_field('hero_section');

    if( $hero ): ?>
        <div class="hero-content">
            <div class="hero-copy container-fluid">
                <div class="row">
                    <div class="col-lg-12"><?php echo $hero['heading'] ?></div>
                    <div class="button-group col-lg-12">
                        <a class="button" href="<?php echo get_permalink( get_page_by_path( 'register' ) ) ?>">register</a>
                        <a class="button" href="<?php echo wp_login_url( $redirect ); ?>">Login</a>
                    </div>
                </div>
            </div>
            <div class="hero-image-container">
                <img class="bg-image-desktop above-post-hero" src="<?php echo $hero['background_image']['url']; ?>" alt="<?php echo $hero['background_image']['alt']; ?>" />
                <img class="bg-image-mobile above-post-hero" src="<?php echo $hero['background_image']['sizes']['mobile']; ?>" alt="<?php echo $hero['background_image']['alt']; ?>" />
            </div>

        </div>

    <?php endif;
}

add_action('genesis_entry_content', 'fnsa_entry_content');

function fnsa_entry_content() {
 ?>
    <section class="main-content container">
        <div class="full-main-heading row">
            <div class="special-heading col-lg-12"><?php the_field('heading'); ?></div>
            <i class="special-heading-credit col-lg-12">-<?php the_field('heading_credit'); ?></i>
        </div>
        <?php
        // check if the repeater field has rows of data
        if( have_rows('information') ):
            ?>
            <div class="row">
            <?php
            // loop through the rows of data
            while ( have_rows('information') ) : the_row();
            ?>
                <div class="col-lg-6">
                    <?php the_sub_field('copy'); ?>
                </div>
                <?php

            endwhile;

            else :

            // no rows found
            ?>
            </div>
            <?php
        endif;
         ?>
    </section>

    <?php
}

add_action('genesis_before_footer', 'fnsa_action_entry_content');

function fnsa_action_entry_content() {

$action = get_field('call_to_action_section');

    if( $action ): ?>
        <div class="hero-content">
            <div class="hero-copy container-fluid">
                <div class="row">
                    <div class="hero-image-container">
                        <img class="bg-image-desktop above-post-hero" src="<?php echo $action['background_image']['url']; ?>" alt="<?php echo $action['background_image']['alt']; ?>" />
                        <img class="bg-image-mobile above-post-hero" src="<?php echo $action['background_image']['sizes']['mobile']; ?>" alt="<?php echo $action['background_image']['alt']; ?>" />
                    </div>
                    <div class="col-lg-12"><?php echo $action['heading'] ?></div>
                    <div class="col-lg-12 button-group">
                        <a class="button" href="<?php echo get_permalink( get_page_by_path( 'register' ) ) ?>">register</a>
                        <a class="button" href="<?php echo wp_login_url( $redirect ); ?>">Login</a>
                    </div>

                </div>
            </div>

        </div>
    <?php endif;
}




// Remove site header elements.
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation.
// remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove footer widgets.
// remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Remove site footer elements.
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
