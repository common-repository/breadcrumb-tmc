<?php

/**
 * @author: przemyslaw.jaworowski@gmail.com
 * Date: 2020-05-18
 * Time: 17:04
 */

namespace sundawp\v1_0_9;

class SundaWP_requirementChecker {

    protected $currentVersionPHP;
    protected $currentVersionWP;
    protected $warnings = array();


    /**
     * @return boolean
     */

    public function __construct() {

        $this->currentVersionPHP = phpversion();
        $this->currentVersionWP = $GLOBALS[ 'wp_version' ];

        add_action( 'admin_notices', array( $this, 'printAdminNotices' ) );
    }


    public function checkVersionPHP( $requiredVersionPHP, $errorMsg = null, $args = 'updated notice is-dismissible' ) {

        $msgArgs = array(

            'message'  => $errorMsg,
            'class'    => $args
        );


        //  ----------------------------------------
        //   Compare PHP versions
        //  ----------------------------------------


        $versionComparePHP = version_compare( $this->currentVersionPHP, $requiredVersionPHP );

        switch ( $versionComparePHP ) {

            case 0:
            case 1:
                $isSatisfied = true;
                break;

            case -1:
                $isSatisfied = false;
                $this->addWarning( $msgArgs );
                break;
        }


        //  ----------------------------------------
        //   Return
        //  ----------------------------------------


        return $isSatisfied;
    }


    public function checkVersionWP( $requiredVersionWP, $errorMsg = null, $args = 'updated notice is-dismissible' ) {

        $msgArgs = array(

            'message'  => $errorMsg,
            'class'    => $args
        );


        //  ----------------------------------------
        //   Compare WP versions
        //  ----------------------------------------


        $versionCompareWP = version_compare( $this->currentVersionWP, $requiredVersionWP );

        switch ( $versionCompareWP ) {

            case 0:
            case 1:
                $isSatisfied = true;
                break;

            case -1:
                $isSatisfied = false;
                $this->addWarning( $msgArgs );
                break;
        }


        //  ----------------------------------------
        //   Return
        //  ----------------------------------------


        return $isSatisfied;
    }


    public function addWarning( $msg ) {

        $this->warnings[] = $msg;
    }


    public function printAdminNotices(){

        foreach ( $this->warnings as $warning ) {

            printf( '<div class="%1$s"><p>%2$s</p></div>', $warning['class'], $warning['message'] );
        }
    }
}