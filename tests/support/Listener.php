<?php

/**
 * This file is part of Step in Deals application.
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
 * @package   RawPHP\RawDispatcher\Support
 * @author    Tom Kaczocha <tom@crazydev.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://crazydev.org/licenses/mpl.txt MPL
 * @link      http://crazydev.org/
 */

namespace RawPHP\RawDispatcher\Support;

use RawPHP\RawDispatcher\Contract\IDispatcher;
use RawPHP\RawDispatcher\Contract\IEvent;
use RawPHP\RawDispatcher\Contract\IListener;

/**
 * Class Listener
 *
 * @package RawPHP\RawDispatcher\Support
 */
class Listener implements IListener
{
    /**
     * @param IEvent      $event
     * @param string      $name
     * @param IDispatcher $dispatcher
     */
    public function handle( IEvent $event, $name, IDispatcher $dispatcher )
    {
        // TODO: Implement handle() method.
    }
}