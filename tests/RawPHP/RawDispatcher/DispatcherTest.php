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
 * @package   RawPHP\RawDispatcher\Tests
 * @author    Tom Kaczocha <tom@crazydev.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://crazydev.org/licenses/mpl.txt MPL
 * @link      http://crazydev.org/
 */

namespace RawPHP\RawDispatcher\Tests;

require_once SUPPORT_DIR . 'Listener.php';
require_once SUPPORT_DIR . 'FiredEvent.php';

use PHPUnit_Framework_TestCase;
use RawPHP\RawDispatcher\Contract\IDispatcher;
use RawPHP\RawDispatcher\Contract\IEvent;
use RawPHP\RawDispatcher\Contract\IListener;
use RawPHP\RawDispatcher\Dispatcher;
use RawPHP\RawDispatcher\Support\FiredEvent;
use RawPHP\RawDispatcher\Support\Listener;

/**
 * Class DispatcherTest
 *
 * @package RawPHP\RawDispatcher\Tests
 */
class DispatcherTest extends PHPUnit_Framework_TestCase implements IListener
{
    /** @var  IDispatcher */
    protected $dispatcher;
    /** @var  bool */
    protected $fired = FALSE;

    /**
     * Setup before each test.
     */
    public function setUp()
    {
        parent::setUp();

        $this->dispatcher = new Dispatcher();
    }

    /**
     * Cleanup after each test.
     */
    public function tearDown()
    {
        parent::tearDown();

        $this->fired = FALSE;
    }

    /**
     * Test instantiating dispatcher.
     */
    public function testDispatcherConstruction()
    {
        $this->assertNotNull( $this->dispatcher );
    }

    /**
     * Test adding an event listener.
     */
    public function testAddEventListener()
    {
        $this->dispatcher->addListener( self::EVENT_TEST, new Listener() );

        $this->assertCount( 1, $this->dispatcher->getListeners() );
    }

    /**
     * Test getting all listeners.
     */
    public function testGetListeners()
    {
        $this->dispatcher->addListener( self::EVENT_TEST, new Listener() );

        $this->assertCount( 1, $this->dispatcher->getListeners() );
    }

    /**
     * Test removing a listener.
     */
    public function testRemoveListener()
    {
        $listener = new Listener();

        $this->dispatcher->addListener( self::EVENT_TEST, $listener );

        $this->assertCount( 1, $this->dispatcher->getListeners() );

        $this->dispatcher->removeListener( self::EVENT_TEST, $listener );

        $this->assertCount( 0, $this->dispatcher->getListeners() );
    }

    /**
     * Test has listeners.
     */
    public function testHasListeners()
    {
        $this->assertFalse( $this->dispatcher->hasListeners() );

        $this->dispatcher->addListener( self::EVENT_TEST, new Listener() );

        $this->assertTrue( $this->dispatcher->hasListeners() );
    }

    /**
     * Test fire event.
     */
    public function testFireEvent()
    {
        $this->assertFalse( $this->fired );

        $this->dispatcher->addListener( self::EVENT_FIRED, $this );

        $this->dispatcher->fire( self::EVENT_FIRED, new FiredEvent() );

        $this->assertTrue( $this->fired );
    }

    /**
     * @param IEvent      $event
     * @param string      $name
     * @param IDispatcher $dispatcher
     */
    public function handle( IEvent $event, $name, IDispatcher $dispatcher )
    {
        if ( $event instanceof FiredEvent )
        {
            $this->setFired();
        }
    }

    /**
     * Helper method to test event fired.
     */
    public function setFired()
    {
        $this->fired = TRUE;
    }

    const EVENT_TEST = 'event.test';
    const EVENT_FIRED = 'event.fired';
}