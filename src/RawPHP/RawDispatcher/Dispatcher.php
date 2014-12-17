<?php

/**
 * This file is part of RawDispatcher library.
 *
 * Copyright (c) 2014 Tom Kaczocha
 *
 * This Source Code is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, you can obtain one at http://mozilla.org/MPL/2.0/.
 *
 * PHP version 5.4
 *
 * @category  PHP
 * @package   RawPHP\RawDispatcher
 * @author    Tom Kaczocha <tom@crazydev.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://crazydev.org/licenses/mpl.txt MPL
 * @link      http://crazydev.org/
 */

namespace RawPHP\RawDispatcher;

use RawPHP\RawDispatcher\Contract\IDispatcher;
use RawPHP\RawDispatcher\Contract\IEvent;
use RawPHP\RawDispatcher\Contract\IListener;

/**
 * Class Dispatcher
 *
 * @package RawPHP\RawDispatcher
 */
class Dispatcher implements IDispatcher
{
    /** @var  array */
    protected $listeners = [ ];
    /** @var  array */
    private $_sorted = [ ];

    /**
     * Fire an event.
     *
     * @param string $eventName
     * @param IEvent $event
     *
     * @return IDispatcher
     */
    public function fire( $eventName, IEvent $event = NULL )
    {
        if ( !isset( $this->listeners[ $eventName ] ) )
        {
            return $this;
        }

        if ( NULL === $event )
        {
            $event = new Event();
        }

        $event->setDispatcher( $this )
            ->setEventName( $eventName )
            ->setDateTime();

        foreach ( $this->getListeners( $eventName ) as $listener )
        {
            call_user_func( [ $listener, 'handle' ], $event, $eventName, $this );

            if ( $event->isPropagationStopped() )
            {
                break;
            }
        }

        return $this;
    }

    /**
     * Add a listener for an event.
     *
     * @param string    $eventName
     * @param IListener $listener
     * @param int       $priority The higher this value, the earlier an event
     *                            listener will be triggered in the chain (defaults to 0)
     *
     * @return IDispatcher
     */
    public function addListener( $eventName, IListener $listener, $priority = 0 )
    {
        $this->listeners[ $eventName ][ $priority ][ ] = $listener;

        unset( $this->_sorted[ $eventName ] );
    }

    /**
     * Remove a listener from an event.
     *
     * @param string    $eventName
     * @param IListener $listener
     *
     * @return IDispatcher
     */
    public function removeListener( $eventName, IListener $listener )
    {
        if ( !isset( $this->listeners[ $eventName ] ) )
        {
            return $this;
        }

        foreach ( $this->listeners[ $eventName ] as $priority => $listeners )
        {
            if ( FALSE !== ( $key = array_search( $listener, $listeners, TRUE ) ) )
            {
                unset( $this->listeners[ $eventName ][ $priority ][ $key ], $this->_sorted[ $eventName ] );
            }
        }

        return $this;
    }

    /**
     * Get all listeners or just for an event.
     *
     * @param string $eventName
     *
     * @return array
     */
    public function getListeners( $eventName = NULL )
    {
        if ( NULL !== $eventName )
        {
            if ( !isset( $this->_sorted[ $eventName ] ) )
            {
                $this->sortListeners( $eventName );
            }

            return $this->_sorted[ $eventName ];
        }

        foreach ( array_keys( $this->listeners ) as $eventName )
        {
            if ( !isset( $this->_sorted[ $eventName ] ) )
            {
                $this->sortListeners( $eventName );
            }
        }

        return array_filter( $this->_sorted );
    }

    /**
     * Check if dispatcher has any listeners or just for a specific event.
     *
     * @param string $eventName
     *
     * @return bool
     */
    public function hasListeners( $eventName = NULL )
    {
        return ( bool ) count( $this->getListeners( $eventName ) );
    }

    /**
     * Sorts listeners for an event.
     *
     * @param string $eventName
     */
    protected function sortListeners( $eventName )
    {
        $this->_sorted[ $eventName ] = [ ];

        if ( isset( $this->listeners[ $eventName ] ) )
        {
            krsort( $this->listeners[ $eventName ] );
            $this->_sorted[ $eventName ] = call_user_func_array( 'array_merge', $this->listeners[ $eventName ] );
        }
    }
}
