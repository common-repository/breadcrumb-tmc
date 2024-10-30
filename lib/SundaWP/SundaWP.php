<?php

/**
 * @author: przemyslaw.jaworowski@gmail.com
 * Date: 2020-07-09
 * Time: 09:03
 */


namespace sundawp\v1_0_9;

class SundaWP {

    /**
     * Return Home Page Path link
     *
     * @return string
     */

    public static function getHomePathLinkHtml( $numWords = 55, $more = null, $text = 'Home' ) {


        /** @var string[] $link */


        //  ----------------------------------------
        //  Home
        //  ----------------------------------------

	    if( null === $more ) {
		    $more = __( '&hellip;', 'breadcrumb-tmc' );
	    }

	    $numWords = ( int ) $numWords;

        $link = sprintf( '<a href="%1$s">%2$s</a>', esc_attr( get_home_url() ), wp_trim_words( $text, $numWords, $more ) );

        //  Return

        return $link;

    }

	/**
	 * Returns Archive Post Type Link
	 *
	 * @param array $args {
	 *      Optional. Array of arguments
	 *
	 *      @type int       $numWords   Number of words.Trims text to a certain number of words. Default value: 55.
	 *      @type string    $more       What to append if string needs to be trimmed. Default '…'. Default value: null.
	 *      @type string    $label      Text label inside the path
	 * }
	 *
	 * @param array $query Array or string of arguments. See WP_Term_Query::__construct() for information on accepted arguments.
	 *
	 * @return string|bool
	 */

    public static function getArchivePathLinkHtml( $args = array() ) {


        //  ----------------------------------------
        //  Post type Archive
        //  ----------------------------------------


	    $argsDefaults = array(

		    'numWords'  => 55,
		    'more'      => null,
		    'label'     => null
	    );

	    $args = wp_parse_args( $args, $argsDefaults );


	    if ( null === $args['more'] ) {
		    $args['more'] = '&hellip;';
	    }

	    $numWords = (int) $numWords;

        if( get_post_type_archive_link( get_post_type() ) ) {

	        $labels = get_post_type_labels( get_post_type_object( get_post_type() ) );

	        $label = $labels->archives;

	        if ( !($args['label'] == null) ) {

	        	$label = $args['label'];
	        }

            $link = sprintf('<a href="%1$s">%2$s</a>', get_post_type_archive_link( get_post_type() ), wp_trim_words( $label, $args['numWords'], $args['more'] ) );

            //  Return

            return $link;

        } else {

            return false;
        }
    }


	/**
	 * Returns Archive Label
	 *
	 * @return string|bool
	 */

    public static function getArchiveLabel() {


		//  ----------------------------------------
		//  Post type Archive
		//  ----------------------------------------


		if( get_post_type_labels( get_post_type_object( get_post_type() ) ) ) {

			$label = get_post_type_labels( get_post_type_object( get_post_type() ) );

			//  Return

			return $label->archives;

		} else {

			return false;
		}
	}


	/**
	 * Returns Archive Url
	 *
	 * @return string|bool
	 */

	public static function getArchiveUrl() {


		//  ----------------------------------------
		//  Post type Archive
		//  ----------------------------------------


		if( get_post_type_archive_link( get_post_type() ) ) {

			$url = get_post_type_archive_link( get_post_type() );

			//  Return

			return $url;

		} else {

			return false;
		}
	}


	/**
     * Returns Category Post Type Link
     *
     * @return string
     */

    public static function getCategoryPathLinkHtml( $numWords = 55, $more = null ) {

        /** @var string[] $link */

        //  ----------------------------------------
        //  Category Archvie
        //  ----------------------------------------

	    if( null === $more ) {

		    $more = '&hellip;';
	    }

	    $numWords = (int) $numWords;

        if ( get_category_link( get_queried_object()->term_id ) and single_term_title( '', false ) ) {

            $link = sprintf('<a href="%1$s">%2$s</a>', get_category_link( get_queried_object()->term_id ), wp_trim_words( single_term_title( '', false ), $numWords, $more ) );

            //  Return

            return $link;

        } else {

	        return false;
        }
    }


	/**
	 * Returns Category Label
	 *
	 * @return string|bool
	 */

    public static function getCategoryLabel() {

		if ( single_term_title( '', false ) ) {

			$label = single_term_title( '', false );

			return $label;

		} else {

			return false;
		}
	}

	/**
	 * Returns Category Url
	 *
	 * @return string|bool
	 */

	public static function getCategoryUrl() {

		if ( get_category_link( get_queried_object()->term_id ) ) {

			$url = get_category_link( get_queried_object()->term_id );

			return $url;

		} else {

			return false;
		}
	}

	/**
     * Return Tag Post Type Link
     *
     * @return string
     */

    public static function getTagPathLinkHtml( $numWords = 55, $more = null ) {

        /** @var string[] $link */


        //  ----------------------------------------
        //  Tag Archvie
        //  ----------------------------------------

	    if( null === $more ) {

		    $more =  '&hellip;';
	    }

	    $numWords = (int) $numWords;

        if( get_tag_link(get_queried_object()->term_id) and single_term_title('', false) ) {

            $link = sprintf('<a href="%1$s">%2$s</a>', get_tag_link(get_queried_object()->term_id), wp_trim_words( single_term_title('', false), $numWords, $more ) );

            //  Return

            return $link;

        } else {

	        return false;
        }

    }

	/**
	 * Returns Tag Label
	 *
	 * @return string|bool
	 */

	public static function getTagLabel() {


        //  ----------------------------------------
        //  Tag Archvie
        //  ----------------------------------------


        if( single_term_title( '', false ) ) {

            $label = single_term_title( '', false );

            //  Returns

            return $label;

        } else {

	        return false;
        }

    }

	/**
	 * Returns Archive Tag Url
	 *
	 * @return string|bool
	 */

	public static function getTagUrl() {


	    //  ----------------------------------------
		//  Tag Archvie
		//  ----------------------------------------

        $url = false;

        if( get_tag_link( get_queried_object()->term_id ) ) {

            $url = get_tag_link(get_queried_object()->term_id);
        }

        return $url;
	}


	public static function getSinglePathLinkHtml( $numWords = 55, $more = null ) {


	    /** @var string[] $link */

	    //  ----------------------------------------
	    //  Single post
	    //  ----------------------------------------

	    if( null === $more )
	    {
		    $more = __( '&hellip;', 'breadcrumb-tmc' );
	    }

	    $numWords = (int) $numWords;

	    if( get_the_permalink() and get_the_title() )
	    {


            $link = sprintf('<a href="%1$s">%2$s</a>', esc_attr(get_the_permalink()), wp_trim_words( get_the_title(), $numWords, $more ) );

            //  Return

            return $link;

        } else {

            return false;

        }

    }

	/**
	 * Returns Single Post Label
	 *
	 * @return string|bool
	 */

	public static function getSingleLabel()
    {

		//  ----------------------------------------
		//  Single post
		//  ----------------------------------------

        $label = false;

		if( get_the_title() )
		{

			$label = get_the_title();
		}

		return $label;

	}

	/**
	 * Returns Single Post Url
	 *
	 * @return string|bool
	 */

	public static function getSingleUrl()
    {


		//  ----------------------------------------
		//  Single post
		//  ----------------------------------------

        $url =  false;

		if( get_the_permalink() )
		{

			$url = get_the_permalink();

		}

        return $url;

    }

    /**
     * @param int $numWords
     * @param null $more
     * @return bool|string|string[]
     */

	public static function getParentPathLinkHtml( $numWords = 55, $more = null )
    {

		global $post;

		/** @var string[] $link */

		//  ----------------------------------------
		//  Parent post
		//  ----------------------------------------

        $link = false;

		if( null === $more )
		{

			$more = __( '&hellip;', 'breadcrumb-tmc' );

		}

		$numWords = (int) $numWords;

		if( $post and get_the_title() and wp_get_post_parent_id( $post->ID )  )
		{

			$postParentId = wp_get_post_parent_id( $post->ID );
			$link = sprintf('<a href="%1$s">%2$s</a>', esc_attr(get_the_permalink( $postParentId ) ), wp_trim_words(  get_the_title( $postParentId ), $numWords, $more ) );

		}

        return $link;

	}

    /**
     * @param int $numWords
     * @param null $more
     * @return string|string[]
     */

	public static function getPageNotFoundPathLinkHtml( $numWords = 55, $more = null ) {

		/** @var string[] $link */

		//  ----------------------------------------
		//  404 - Page Not Found
		//  ----------------------------------------

		if( null === $more )
		{

			$more = __( '&hellip;', 'breadcrumb-tmc' );

		}

		$numWords = (int) $numWords;

		$PageNotFoundText  =  apply_filters( 'PageNotFoundText' , '404' );

		$link = sprintf('<a>%1$s</a>', wp_trim_words( $PageNotFoundText, $numWords, $more ) );

		//  Return

		return $link;

	}


	/**
	 * Returns Page Not Found Url
	 *
	 * @return string|bool
	 */

	public static function getPageNotFoundUrl() {


		//  ----------------------------------------
		//  404 - Page Not Found
		//  ----------------------------------------

		$url = '#';

		//  Return

		return $url;
	}


	/**
	 * Returns Array of Path links to Terms
	 *
	 * @param array $args {
	 *      Optional. Array of arguments
	 *
	 *      @type int       $numWords       Number of words.Trims text to a certain number of words. Default value: 55.
	 *      @type string    $more           What to append if string needs to be trimmed. Default '…'. Default value: null.
	 *      @type boolean   $anchor         Show or hide href element. Default value: true.
	 *
	 * }
	 *
	 * @param array $query Array or string of arguments. See WP_Term_Query::__construct() for information on accepted arguments.
	 *
	 * @return array|bool
	 */

    public static function getTermsPathLinkHtml( $args = array(), $query = array() ) {

	    global $post;

	    $argsDefaults = array(

		    'numWords'          => 55,
		    'more'              => null,
		    'anchor'            => false,
	        'ornamentBefore'    => null
	    );

	    $args = wp_parse_args( $args, $argsDefaults );


	    $queryDefaults = array(

		    'taxonomy'      => 'category',
		    'parent'        => '',
		    'object_ids'    => $post->ID
	    );

	    $query = wp_parse_args( $query, $queryDefaults );


        //  ----------------------------------------
        //  Terms list
        //  ----------------------------------------

	    if ( null === $args['more'] ) {

		    $args['more'] = __( '&hellip;', 'breadcrumb-tmc' );
	    }


	    $link = array();

	    if( $query )
	    {

		    $query = array(
			    'taxonomy'      => 'post_tag',
			    'parent'        => '',
			    'object_ids'    => $post->ID,
		    );

		    $terms = get_terms( $query );

		    if( $terms ) {

			    foreach( $terms as $term ) {

					$anchor = $args['anchor'] ? sprintf( 'href="%1$s"', get_term_link( $term->term_id, $query['taxonomy'] ) ) : '';
			    	$link[] = sprintf('<a %1$s>%2$s</a>', $anchor, wp_trim_words( $term->name, (int) $args['numWords'], $args['more'] ) );
			    }
		    }

		    return $link;

	    } else {

	    	return false;
	    }
    }


	/**
	 * Return list of Terms Labels
	 *
	 * @return array|bool
	 */

	public static function getTermsLabel( $query = array() ) {

		global $post;

		$queryDefaults = array(

			'taxonomy'      => 'category',
			'parent'        => '',
			'object_ids'    => $post->ID
		);

		$query = wp_parse_args( $query, $queryDefaults );


		//  ----------------------------------------
		//  Terms list
		//  ----------------------------------------


		$labels = array();

		if( $query )
		{

			$query = array(
				'taxonomy'      => 'post_tag',
				'parent'        => '',
				'object_ids'    => $post->ID,
			);

			$terms = get_terms( $query );

			if( $terms ) {

				foreach( $terms as $term )
				{

					$labels[] = $term->name;
				}
			}

			return $labels;

		} else
		{

			return false;
		}
	}


	/**
	 * Return list of Terms Urls
	 *
	 * @return bool|array
	 */

	public static function getTermsUrl( $query = array() )
    {

		global $post;


		$queryDefaults = array(

			'taxonomy'      => 'category',
			'parent'        => '',
			'object_ids'    => $post->ID
		);

		$query = wp_parse_args( $query, $queryDefaults );


		//  ----------------------------------------
		//  Terms list
		//  ----------------------------------------


		$url = array();

		if( $query )
		{

			$terms = get_terms( $query );

			if( $terms )
			{

				foreach( $terms as $term ) {

					$url[] = get_term_link( $term->term_id, $query['taxonomy'] );
				}
			}

			return $url;

		} else {

			return false;
		}

	}
}