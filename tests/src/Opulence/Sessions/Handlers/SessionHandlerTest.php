<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Sessions\Handlers;

use LogicException;
use Opulence\Cryptography\Encryption\EncryptionException;
use Opulence\Cryptography\Encryption\IEncrypter;

/**
 * Tests the base session handler
 */
class SessionHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var SessionHandler|\PHPUnit_Framework_MockObject_MockObject The session handler to use in tests */
    private $handler = null;
    /** @var IEncrypter|\PHPUnit_Framework_MockObject_MockObject The encrypter to use in tests */
    private $encrypter = null;

    /**
     * Sets up the tests
     */
    public function setUp()
    {
        $this->handler = $this->getMockForAbstractClass(SessionHandler::class);
        $this->encrypter = $this->getMock(IEncrypter::class);
    }

    /**
     * Tests that an empty string is written when the encrypter fails
     */
    public function testEmptyStringIsWrittenWhenEncrypterFails()
    {
        $this->handler->useEncryption(true);
        $this->handler->setEncrypter($this->encrypter);
        $this->handler->expects($this->any())->method("doWrite")->with("theId", "");
        $this->encrypter->expects($this->any())->method("decrypt")
            ->will($this->throwException(new EncryptionException));
        $this->handler->write("theId", "foo");
    }

    /**
     * Tests that an exception is thrown when reading and the encrypter is not set
     */
    public function testExceptionIsThrownWhenReadingWithEncrypterNotSet()
    {
        $this->setExpectedException(LogicException::class);
        $this->handler->useEncryption(true);
        $this->handler->expects($this->any())->method("doRead")->will($this->returnValue("foo"));
        $this->handler->read("baz");
    }

    /**
     * Tests that an exception is thrown when writing and the encrypter is not set
     */
    public function testExceptionIsThrownWhenWritingWithEncrypterNotSet()
    {
        $this->setExpectedException(LogicException::class);
        $this->handler->useEncryption(true);
        $this->handler->read("baz");
    }

    /**
     * Tests that data being read is not decrypted when not using an encrypter
     */
    public function testReadDataIsNotDecryptedWhenNotUsingEncrypter()
    {
        $this->handler->expects($this->any())->method("doRead")->will($this->returnValue("bar"));
        $this->assertEquals("bar", $this->handler->read("foo"));
    }

    /**
     * Tests reading encrypted data
     */
    public function testReadingEncryptedData()
    {
        $this->handler->useEncryption(true);
        $this->handler->setEncrypter($this->encrypter);
        $this->handler->expects($this->any())->method("doRead")->will($this->returnValue("foo"));
        $this->encrypter->expects($this->any())->method("decrypt")->will($this->returnValue("bar"));
        $this->assertEquals("bar", $this->handler->read("baz"));
    }

    /**
     * Tests that a serialized empty array is returned when the encrypter fails to read the data
     */
    public function testSerializedEmptyArrayReturnedWhenEncrypterFailsToReadData()
    {
        $this->handler->useEncryption(true);
        $this->handler->setEncrypter($this->encrypter);
        $this->handler->expects($this->any())->method("doRead")->will($this->returnValue("foo"));
        $this->encrypter->expects($this->any())->method("decrypt")
            ->will($this->throwException(new EncryptionException));
        $this->assertEquals(serialize([]), $this->handler->read("bar"));
    }

    /**
     * Tests writing encrypted data
     */
    public function testWritingEncryptedData()
    {
        $this->handler->useEncryption(true);
        $this->handler->setEncrypter($this->encrypter);
        $this->handler->expects($this->any())->method("doWrite")->with("theId", "bar");
        $this->encrypter->expects($this->any())->method("encrypt")->will($this->returnValue("bar"));
        $this->handler->write("theId", "foo");
    }

    /**
     * Tests that data being written is not encrypted when not using an encrypter
     */
    public function testWrittenDataIsNotEncryptedWhenNotUsingEncrypter()
    {
        $this->handler->expects($this->any())->method("doWrite")->with("theId", "foo");
        $this->handler->write("theId", "foo");
    }
}