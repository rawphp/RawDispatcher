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
 * @package   RawPHP\RawDispatcher\Contract
 * @author    Tom Kaczocha <tom@crazydev.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://crazydev.org/licenses/mpl.txt MPL
 * @link      http://crazydev.org/
 */

namespace RawPHP\RawDispatcher\Contract;

/**
 * Interface IDispatcher
 *
 * @package RawPHP\RawDispatcher\Contract
 */
interface IDispatcher
{
    /**
     * Fire an event.
     *
     * @param string $eventName
     * @param IEvent $event
     *
     * @return IDispatcher
     */
    public function fire( $eventName, IEvent $event = NULL );

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
    public function addListener( $eventName, IListener $listener, $priority = 0 );

    /**
     * Remove a listener from an event.
     *
     * @param string    $eventName
     * @param IListener $listener
     *
     * @return IDispatcher
     */
    public function removeListener( $eventName, IListener $listener );

    /**
     * Get all listeners or just for an event.
     *
     * @param string $eventName
     *
     * @return array
     */
    public function getListeners( $eventName = NULL );

    /**
     * Check if dispatcher has any listeners or just for a specific event.
     *
     * @param string $eventName
     *
     * @return bool
     */
    public function hasListeners( $eventName = NULL );
}
