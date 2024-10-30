<?php

/**
 * @author: przemyslaw.jaworowski@gmail.com
 * Date: 2021-08-29
 * Time: 21:02
 */


use breadcrumb_tmc\v1_4_0\Breadcrumb;

if ( ! class_exists( 'pathnode\PathNode' ) ) {
    require __DIR__ . '/models/PathNode.php';
}

if ( ! class_exists( 'BreadcrumbGenerator' ) ) {
    require __DIR__ . '/Breadcrumb.php';
}


function breadcrumb_tmc_addShortCode()
{

    Breadcrumb::createShortcode( 'breadcrumb-tmc' );
}

add_action( 'init', 'breadcrumb_tmc_addShortCode' );


function breadcrumb_tmc_getPrintStructuredData()
{

    Breadcrumb::initBreadcrumbNode();
    printf( '<script type="application/ld+json" class="breadcrumb-tmc-schema-graph">%1$s</script>', Breadcrumb::getJSON() );

}

add_action( 'wp_head', 'breadcrumb_tmc_getPrintStructuredData');


function breadcrumb_tmc_wp_enqueue_style()
{

	$enqueueStyles  =  apply_filters( 'enqueueStyles' , true ); /* Deprecated */
	$enqueueStyles  =  apply_filters( 'breadcrumbTmc/enqueueStyles' , $enqueueStyles );

	if ( $enqueueStyles )
	{

        wp_enqueue_style( 'breadcrumb-tmc', dirname( plugin_dir_url( __FILE__ ) ) . "/assets/css/style.css", array(), '1.0.1' );
	}
}

add_action( 'wp_enqueue_scripts', 'breadcrumb_tmc_wp_enqueue_style' );