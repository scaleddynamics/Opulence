<?php
/**
 * Copyright (C) 2014 David Young
 *
 * Tests the user factory
 */
namespace RDev\Application\Shared\Models\Users\Factories;
use RDev\Application\Shared\Models\Users;

class UserFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserFactory The user factory to test */
    private $userFactory = null;

    /**
     * Sets up the test
     */
    public function setUp()
    {
        $this->userFactory = new UserFactory();
    }

    /**
     * Tests creating a user
     */
    public function testCreatingUser()
    {
        $user = $this->userFactory->createUser(1, "foo", "foo@bar.com", new \DateTime("1776-07-04 12:34:56", new \DateTimeZone("UTC")), "David", "Young");
        $this->assertInstanceOf("RDev\\Application\\Shared\\Models\\Users\\User", $user);
    }
} 