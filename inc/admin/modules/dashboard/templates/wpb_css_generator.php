<?php
wp_enqueue_script( 'wd-generator', OMNIVERSE_ASSETS . '/js/css-generator.js', array(), OMNIVERSE_VERSION, true );

DN\Registry::getInstance()->wpbcssgenerator->form();
