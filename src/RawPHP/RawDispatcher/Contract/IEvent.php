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

use DateTime;

/**
 * Interface IEvent
 *
 * @package RawPHP\RawDispatcher\Contract
 */
interface IEvent
{
    /**
     * Get the event name.
     *
     * @return string
     */
    public function getEventName();

    /**
     * Set the event name.
     *
     * @param string $name
     *
     * @return IEvent
     */
    public function setEventName( $name );

    /**
     * Get the dispatcher.
     *
     * @return IDispatcher
     */
    public function getDispatcher();

    /**
     * Set the dispatcher.
     *
     * @param IDispatcher $dispatcher
     *
     * @return IEvent
     */
    public function setDispatcher( IDispatcher $dispatcher );

    /**
     * Get the date time of the event.
     *
     * @return DateTime
     */
    public function getDateTime();

    /**
     * @param DateTime $date
     *
     * @return IEvent
     */
    public function setDateTime( DateTime $date = NULL );

    /**
     * See if event propagation has been stopped.
     *
     * @return bool
     */
    public function isPropagationStopped();

    /**
     * Stop event propagation.
     *
     * @return IEvent
     */
    public function stopPropagation();

    /**
     * Convert event to string.
     *
     * @return string
     */
    public function __toString();
}
