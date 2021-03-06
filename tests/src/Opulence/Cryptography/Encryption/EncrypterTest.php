<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Cryptography\Encryption;

use Opulence\Cryptography\Utilities\Strings;

/**
 * Tests the encrypter
 */
class EncrypterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Encrypter The encrypter to use in tests */
    private $encrypter = null;

    /**
     * Sets up the tests
     */
    public function setUp()
    {
        $this->encrypter = new Encrypter("abcdefghijklmnoq", new Strings());
    }

    /**
     * Tests decrypting data without an IV
     */
    public function testDecryptingDataWithoutIV()
    {
        $this->setExpectedException(EncryptionException::class);
        $data = ["mac" => "foo", "value" => "bar"];
        $this->encrypter->decrypt(json_encode($data));
    }

    /**
     * Tests decrypting data without a MAC
     */
    public function testDecryptingDataWithoutMAC()
    {
        $this->setExpectedException(EncryptionException::class);
        $data = ["iv" => "foo", "value" => "bar"];
        $this->encrypter->decrypt(json_encode($data));
    }

    /**
     * Tests decrypting data without a value
     */
    public function testDecryptingDataWithoutValue()
    {
        $this->setExpectedException(EncryptionException::class);
        $data = ["mac" => "foo", "iv" => "bar"];
        $this->encrypter->decrypt(json_encode($data));
    }

    /**
     * Tests decrypting that is not valid JSON
     */
    public function testDecryptingInvalidJson()
    {
        $this->setExpectedException(EncryptionException::class);
        $this->encrypter->decrypt("foo");
    }

    /**
     * Tests encrypting and decrypting a value
     */
    public function testEncryptingAndDecryptingValue()
    {
        $decryptedValue = "foobar";
        $encryptedValue = $this->encrypter->encrypt($decryptedValue);
        $this->assertNotEquals($decryptedValue, $encryptedValue);
        $this->assertEquals($decryptedValue, $this->encrypter->decrypt($encryptedValue));
    }

    /**
     * Tests encrypting and decrypting a value using a custom cipher
     */
    public function testEncryptingAndDecryptingValueUsingCustomCipher()
    {
        $this->encrypter->setCipher("AES-256-CBC");
        $decryptedValue = "foobar";
        $encryptedValue = $this->encrypter->encrypt($decryptedValue);
        $this->assertNotEquals($decryptedValue, $encryptedValue);
        $this->assertEquals($decryptedValue, $this->encrypter->decrypt($encryptedValue));
    }

    /**
     * Tests passing a custom cipher through the constructor
     */
    public function testPassingCustomCipherThroughConstructor()
    {
        $encrypter = new Encrypter("abcdefghijklmnopq", new Strings(), "AES-256-CBC");
        $decryptedValue = "foobar";
        $encryptedValue = $encrypter->encrypt($decryptedValue);
        $this->assertNotEquals($decryptedValue, $encryptedValue);
        $this->assertEquals($decryptedValue, $encrypter->decrypt($encryptedValue));
    }

    /**
     * Tests setting an invalid cipher
     */
    public function testSettingInvalidCipher()
    {
        $this->setExpectedException(EncryptionException::class);
        $this->encrypter->setCipher("foo");
    }
}