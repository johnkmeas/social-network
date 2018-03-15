<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

genesis_structural_wrap( 'site-inner', 'close' );
genesis_markup( array(
    'close'   => '</div>',
    'context' => 'site-inner',
) );

do_action( 'genesis_before_footer' );
do_action( 'genesis_footer' );
do_action( 'genesis_after_footer' );


genesis_markup( array(
    'close'   => '</div>',
    'context' => 'site-container',
) );

do_action( 'genesis_after' );
wp_footer(); // We need this for plugins.

genesis_markup( array(
    'close'   => '</body>',
    'context' => 'body',
) );

?>
</html>
