<?php

/**
 * @author: przemyslaw.jaworowski@gmail.com
 * Date: 2021-06-02
 * Time: 21:49
 */


namespace pathnode;

class PathNode
{

	private $_label;
	private $_tag;
	private $_href;
	private $_name;
	private $_separator;
	private $_priority;


	public function setLabel( $label )
    {

		$this->_label = $label;

	}


	public function setTag( $tag )
    {

		$this->_tag = $tag;

	}


	public function setName( $name )
    {

		$this->_name = $name;

	}


    public function setHref( $href ){

		$this->_href = $href;

	}

	public function setSeparator( $separator )
    {

		$this->_separator = $separator;

	}

	public function setPriority( $priority ){

		$this->_priority = $priority;

	}

    public function getPriority( $priority ){

       return $this->_priority;

    }


    public function getName( )
    {

		return $this->_name;

	}


    public function getTag( )
    {

        return $this->_tag?: 'a';

    }


    public function getHref( )
    {

        return $this->_href;

    }


    public function getLabel( )
    {

        return $this->_label;

    }

    public function getSeparator( )
    {

        return $this->_separator;

    }


	public function getDisplay()
    {

		$hrefString = '';

		if ( ( $this->getHref() ) and ( strcmp( $this->getTag(), "a") == 0 ) )
		{

			$hrefString = sprintf('href="%1$s"', $this->getHref());
		}

		return sprintf( '<%1$s %2$s>%3$s</%1$s>', $this->getTag(), $hrefString, $this->getLabel() );

	}

}