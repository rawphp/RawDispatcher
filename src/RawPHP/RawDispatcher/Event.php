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

use DateTime;
use RawPHP\RawDispatcher\Contract\IDispatcher;
use RawPHP\RawDispatcher\Contract\IEvent;

class Event implements IEvent
{
    /** @var string */
    protected $name;
    /** @var DateTime */
    protected $date;
    /** @var IDispatcher */
    protected $dispatcher;
    /** @var bool */
    protected $stopped;

    /**
     * Get the event name.
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->name;
    }

    /**
     * Set the event name.
     *
     * @param string $name
     *
     * @return IEvent
     */
    public function setEventName( $name )
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the dispatcher.
     *
     * @return IDispatcher
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * Set the dispatcher.
     *
     * @param IDispatcher $dispatcher
     *
     * @return IEvent
     */
    public function setDispatcher( IDispatcher $dispatcher )
    {
        $this->dispatcher = $dispatcher;

        return $this;
    }

    /**
     * Get the date time of the event.
     *
     * @return DateTime
     */
    public function getDateTime()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     *
     * @return IEvent
     */
    public function setDateTime( DateTime $date = NULL )
    {
        $this->date = $date ?: new DateTime();

        return $this;
    }

    /**
     * See if event propagation has been stopped.
     *
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->stopped;
    }

    /**
     * Stop event propagation.
     *
     * @return IEvent
     */
    public function stopPropagation()
    {
        $this->stopped = TRUE;

        return $this;
    }
}
