<?php

/**
 * Plugin Name:       Breadcrumb TMC
 * Plugin URI:        https://wordpress.org/plugins/breadcrumb-tmc/
 * Description:       Agile WordPress plugin to create Breadcrumb. Quick use <code>[breadcrumb-tmc]</code> to display breadcrumb.
 * Version:           1.4.3
 * Requires at least: 5.0
 * Requires PHP:      5.6
 * Author:            JetPlugs
 * Author URI:        https://www.jetplugs.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       breadcrumb-tmc
 * Domain Path:       /languages
 **/

use sundawp\v1_0_9\SundaWP_requirementChecker;


if ( !defined( 'ABSPATH' ) )
{

    die ( 'Die, you silly human!' );
}

//  ----------------------------------------
//  Requirements
//  ----------------------------------------


if ( !class_exists( 'sundawp\v1_0_9\SundaWP_requirementChecker' ) )
{

    require __DIR__ . '/lib/SundaWP/SundaWP_requirementChecker.php';
}


$requirementChecker = new SundaWP_requirementChecker();

$checkWP   = $requirementChecker->checkVersionWP( '5.0.0', 'Breadcrumb TMC msg: Your WordPress version is too low', 'notice error is-dismissible');
$checkPHP  = $requirementChecker->checkVersionPHP( '5.6.0', 'Breadcrumb TMC msg: The PHP version installed on your server is too low. The PHP version required is at least: 5.6.0.', 'notice error is-dismissible');


if( !$checkPHP || !$checkWP ) return;


//  ----------------------------------------
//  App
//  ----------------------------------------

require __DIR__ . '/src/app.php';




