<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Sessions\Handlers;

/**
 * Defines the array session handler, which is useful for testing
 */
class ArraySessionHandler extends SessionHandler
{
    /** @var array The local storage */
    private $storage = [];

    /**
     * @inheritdoc
     */
    public function close()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function destroy($sessionId)
    {
        $this->storage = [];
    }

    /**
     * @inheritdoc
     */
    public function gc($maxLifetime)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function open($savePath, $sessionId)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function doRead($sessionId)
    {
        if (array_key_exists($sessionId, $this->storage)) {
            return $this->storage[$sessionId];
        }

        return "";
    }

    /**
     * @inheritdoc
     */
    protected function doWrite($sessionId, $sessionData)
    {
        $this->storage[$sessionId] = $sessionData;
    }
}