<?php

/**
 * @author: przemyslaw.jaworowski@gmail.com
 * Date: 2024-06-10
 * Time: 06:06
 */

namespace breadcrumb_tmc\v1_4_0;
use pathnode\PathNode;
use sundawp\v1_0_9\SundaWP;


if ( !class_exists( 'sundawp\v1_0_9\SundaWP' ) )
{

    require dirname( plugin_dir_path( __FILE__ ) ) . '/lib/SundaWP/SundaWP.php';

}

class Breadcrumb
{

    private static $_JSON;
    private static $_breadcrumbNode;


    public static function getPrepareData() {


        $current_url = home_url( $_SERVER['REQUEST_URI'] );

        /** @var string[] $nodes */
        $nodes = array();

        //  Apply filter - Trim Words
        $trimWords         = apply_filters( 'breadcrumbTmc/trimWords', 55 );

	    //  Apply filter - Ending Character
	    $endingCharacter   = apply_filters( 'breadcrumbTmc/endingCharacter', '&hellip;' );

        //  Apply filter Separator Mark
        $separatorMark    = apply_filters( 'separatorMark_breadcrumbTmc' , '»' ); /* deprecated */
        $separatorMark    = apply_filters( 'breadcrumbTmc/separatorMark' , $separatorMark );


	    //  ----------------------------------------
	    //  Home
	    //  ----------------------------------------


	    if ( SundaWP::getHomePathLinkHtml() )
	    {

		    $homeText  = apply_filters( 'homeText', __( 'Home', 'breadcrumb-tmc' ) ); /* Deprecated */
		    $homeText  = apply_filters( 'breadcrumbTmc/homeLabel', $homeText );

		    $homeNode  = new PathNode();
	        $homeNode->setLabel( $homeText );
	        $homeNode->setHref( get_home_url() );
	        $homeNode->setPriority( 100 );
	        $homeNode->setSeparator( $separatorMark );
            $nodes[]   = $homeNode;

        }



        //  ----------------------------------------
        //  Post Type Archive
        //  ----------------------------------------

        if ( ( ( is_archive() || is_single() || is_home() ) and !is_front_page() ) and SundaWP::getArchiveUrl() )
        {

	        $archiveLabel = apply_filters( 'breadcrumbTmc/archiveLabel', __( null, 'breadcrumb-tmc' ) );

	        if ( !$archiveLabel )
	        {

		        $archiveLabel = SundaWP::getArchiveLabel();

	        }

	        $archiveNode = new PathNode();
	        $archiveNode->setLabel( wp_trim_words( $archiveLabel, $trimWords, $endingCharacter ) );
	        $archiveNode->setHref( SundaWP::getArchiveUrl() );
	        $archiveNode->setName( 'archiveNode' );
	        $archiveNode->setPriority( 200 );
	        $archiveNode->setSeparator( $separatorMark );
            $nodes[]     = apply_filters( 'breadcrumbTmc/archiveNode', $archiveNode );

	        //  Clear array from null elements
	        $nodes = array_filter( $nodes );

        }


        //  ----------------------------------------
        //  Taxonomy Archive
        //  ----------------------------------------


        if (  ( is_tax() || is_category() ) and SundaWP::getCategoryUrl() )
        {

		    $categoryNode = new PathNode();
	        $categoryNode->setLabel( wp_trim_words( SundaWP::getCategoryLabel(), $trimWords, $endingCharacter ) );
	        $categoryNode->setHref( SundaWP::getCategoryUrl() );
	        $categoryNode->setPriority( 300 );
	        $categoryNode->setSeparator( $separatorMark );
	        $nodes[]      = $categoryNode;

        }


        //  ----------------------------------------
        //  Tag archive
        //  ----------------------------------------

        if ( is_tag() and SundaWP::getTagUrl() ) {

	        $tagNode    = new PathNode();
	        $tagNode->setLabel( wp_trim_words( SundaWP::getTagLabel(), $trimWords, $endingCharacter ) );
	        $tagNode->setHref( SundaWP::getTagUrl() );
	        $tagNode->setPriority( 300 );
	        $tagNode->setSeparator( $separatorMark );
	        $nodes[]    = $tagNode;

        }


        //  ----------------------------------------
        //  Author
        //  ----------------------------------------

        if ( is_author() and get_author_posts_url( get_the_author_meta( 'ID' ) ) )
        {

            $authorNode = new PathNode();
            $authorNode->setLabel( wp_trim_words( get_the_author_meta( 'display_name' ), $trimWords, $endingCharacter ) );
            $authorNode->setHref( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
            $authorNode->setPriority( 300 );
            $authorNode->setSeparator( $separatorMark );
            $nodes[]    = $authorNode;
        }


        //  ----------------------------------------
        //  Single post
        //  ----------------------------------------

        if ( ( ( is_single() || is_page() ) and !is_front_page() ) and SundaWP::getSingleUrl() )
        {

	        $parentNodes  = array(); //  Parent nodes in natural order.
	        $postParentId = wp_get_post_parent_id( get_queried_object_id() );

	        while( $postParentId )
            {

		        $parentNode = new PathNode();
		        $parentNode->setLabel( get_the_title( $postParentId ) );
		        $parentNode->setHref( get_permalink( $postParentId ) );
		        $parentNode->setPriority( 400 );
		        $parentNode->setSeparator( $separatorMark );

		        $parentNodes[] = $parentNode;
		        $postParentId  = wp_get_post_parent_id( $postParentId );
	        }

	        
	        // Switch order and merge.
	        $parentNodes    = array_reverse( $parentNodes );
	        $nodes          = array_merge( $nodes, $parentNodes );


            // Terms of post

            $termsTaxonomy = apply_filters( 'breadcrumbTmc/termsNode/taxonomyName', false );

            if ( !taxonomy_exists( $termsTaxonomy ) )
            {

                $termsTaxonomy = false;
            }

            $terms = get_the_terms( get_queried_object_id(), $termsTaxonomy );

            if ( $terms )
            {

                $termsNodes = array();

                foreach( $terms as $term ){

                    $termsLink = get_term_link( $term->term_id, $termsTaxonomy );
                    $termsName = $term->name;

                    $termsNode    = new PathNode();
                    $termsNode->setLabel( $termsName );
                    $termsNode->setHref( $termsLink );
                    $termsNode->setPriority( 500 );
                    $termsNode->setSeparator( $separatorMark );
                    $termsNodes[] = $termsNode;
                }

                $nodes = array_merge( $nodes, $termsNodes );

            }


            $singleNode = new PathNode();
	        $singleNode->setLabel( wp_trim_words( SundaWP::getSingleLabel(), $trimWords, $endingCharacter ) );
	        $singleNode->setHref( SundaWP::getSingleUrl() );
	        $singleNode->setPriority( 600 );
	        $singleNode->setSeparator( $separatorMark );
            $nodes[]    = $singleNode;

        }


	    //  ----------------------------------------
	    //  404 page
	    //  ----------------------------------------

	    if ( is_404() )
	    {

		    $pageNotFoundNode = new PathNode();
		    $pageNotFoundNode->setLabel( wp_trim_words( __( '404','breadcrumb-tmc' ), $trimWords, $endingCharacter ) );
		    $pageNotFoundNode->setHref( SundaWP::getPageNotFoundUrl() );
		    $pageNotFoundNode->setPriority( 700 );
		    $pageNotFoundNode->setSeparator( $separatorMark );
	        $nodes[]          = $pageNotFoundNode;

	    }


        //  ----------------------------------------
        //  Search
        //  ----------------------------------------

        if ( is_search() )
        {

            $searchNode = new PathNode();
            $searchNode->setLabel( wp_trim_words( __( 'Search results','breadcrumb-tmc' ), $trimWords, $endingCharacter ) );
            $searchNode->setHref(  $current_url );
            $searchNode->setPriority( 800 );
            $searchNode->setSeparator( $separatorMark );
            $nodes[]    = $searchNode;
        }

		$numOfArrayElements = count( $nodes );

	    //  Apply filter lastNode
	    $nodes[$numOfArrayElements - 1] = apply_filters( 'breadcrumbTmc/lastNode', $nodes[$numOfArrayElements - 1] );

	    //  Apply filter allNodes
	    $nodes = apply_filters( 'breadcrumbTmc/allNodes', $nodes );

	    //  Clear array from null elements
	    $nodes = array_filter( $nodes );

        $numOfArrayElements = count( $nodes );

        //  Preparing array to folding JSON-LD data

        $jsonArray  = array(

            '@context'          => 'https://schema.org',
            '@type'             => 'BreadcrumbList',
            'itemListElement'  => ''
        );

        $itemListElementArray = array();


        //  Folding individual crumbs
        $i = 0;

		foreach ( $nodes as $node )
		{

		    $i++;

		    $nodeElement    = sprintf( '<li>%1$s</li>', $node->getDisplay() );
		    $nodeSeparator  = sprintf( '<span class="breadcrumb-tmc-separator"> %1$s </span>', $node->getSeparator() );

            //  Folding JSON-LD data
            $itemListElementArray [] = array(

                '@type'          => 'ListItem',
                'position'      => $i,
                'item'           => array(
                    '@id'           => $node->getHref(),
                    'name'          => $node->getLabel()
                )
            );

		    if ( $i == $numOfArrayElements )
		    {

                //  Last crumb must have empty separator
                $nodeSeparator = '';
            }

            $nodesString[] = $nodeElement.$nodeSeparator;
		}


        $htmlNode                      = sprintf( '<ol class="breadcrumb-tmc">%1$s</ol>', implode( '', $nodesString ) );
        $jsonArray['itemListElement']  = $itemListElementArray;
        self::$_JSON                   = json_encode( $jsonArray);
        self::$_breadcrumbNode         = $htmlNode;

    }


    public static function initBreadcrumbNode()
    {

        self::getPrepareData();

    }

    /**
     * @param string $tag (string) (Required) Shortcode tag to be searched in post content.
     */

    public static function createShortcode( $tag = 'breadcrumb-tmc' )
    {

        add_shortcode( $tag,  array( self::class, 'getBreadcrumbNode') );

    }


    public static function getBreadcrumbNode()
    {

        self::initBreadcrumbNode();
        return self::$_breadcrumbNode;

    }


    public static function getJSON()
    {

        return self::$_JSON;

    }

}