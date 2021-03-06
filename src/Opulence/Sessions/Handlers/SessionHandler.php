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
use SessionHandlerInterface;

/**
 * Defines the base session handler
 */
abstract class SessionHandler implements IEncryptableSessionHandler, SessionHandlerInterface
{
    /** @var bool Whether or not this handler encrypts the session when storing it */
    protected $usesEncryption = false;
    /** @var IEncrypter The encrypter to use for encrypted sessions */
    protected $encrypter = null;

    /**
     * @inheritdoc
     */
    public function read($sessionId)
    {
        return $this->prepareForUnserialization($this->doRead($sessionId));
    }

    /**
     * @inheritdoc
     */
    public function setEncrypter(IEncrypter $encrypter)
    {
        $this->encrypter = $encrypter;
    }

    /**
     * @inheritdoc
     */
    public function useEncryption($useEncryption)
    {
        $this->usesEncryption = (bool)$useEncryption;
    }

    /**
     * @inheritdoc
     */
    public function write($sessionId, $sessionData)
    {
        return $this->doWrite($sessionId, $this->prepareForWrite($sessionData));
    }

    /**
     * Actually performs the reading of the session data from storage
     *
     * @param string $sessionId The Id of the session to read
     * @return string The unserialized session data
     */
    abstract protected function doRead($sessionId);

    /**
     * Actually performs the writing of the session data to storage
     *
     * @param string $sessionId The Id of the session
     * @param string $sessionData The session data to write
     * @return bool True on success, otherwise false on failure
     */
    abstract protected function doWrite($sessionId, $sessionData);

    /**
     * Prepares data that is about to be unserialized
     *
     * @param string $data The data to be unserialized
     * @return string The data to be unserializd
     * @throws LogicException Thrown if using encryption but an encrypter has not been set
     */
    protected function prepareForUnserialization($data)
    {
        if ($this->usesEncryption) {
            if ($this->encrypter === null) {
                throw new LogicException("Encrypter not set on session handler");
            }

            try {
                return $this->encrypter->decrypt($data);
            } catch (EncryptionException $ex) {
                return serialize([]);
            }
        } else {
            return $data;
        }
    }

    /**
     * Prepares data to be written to storage
     *
     * @param string $data The data to prepare
     * @return string The prepared data
     * @throws LogicException Thrown if using encryption but an encrypter has not been set
     */
    protected function prepareForWrite($data)
    {
        if ($this->usesEncryption) {
            if ($this->encrypter === null) {
                throw new LogicException("Encrypter not set on session handler");
            }

            try {
                return $this->encrypter->encrypt($data);
            } catch (EncryptionException $ex) {
                return "";
            }
        } else {
            return $data;
        }
    }
}