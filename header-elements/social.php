<?php
omniverse_enqueue_inline_style( 'header-elements-base' );

$params['style'] = ( ! $params['style'] ) ? 'default' : $params['style'];
$params['size']  = ( ! $params['size'] ) ? 'default' : $params['size'];

echo omniverse_shortcode_social( $params );
