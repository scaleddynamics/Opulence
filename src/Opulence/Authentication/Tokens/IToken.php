<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Authentication\Tokens;

use DateTime;

/**
 * Defines the interface for cryptographic tokens
 */
interface IToken
{
    /**
     * Marks this token is inactive
     */
    public function deactivate();

    /**
     * Gets the hashed value of this token
     *
     * @return string The hashed value
     */
    public function getHashedValue();

    /**
     * Gets the database Id
     *
     * @return int|string The database Id
     */
    public function getId();

    /**
     * Gets the valid-from date of this token
     *
     * @return DateTime The valid-from date
     */
    public function getValidFrom();

    /**
     * Gets the valid-to date of this token
     *
     * @return DateTime The valid-to date
     */
    public function getValidTo();

    /**
     * Gets whether or not this token is active
     *
     * @return bool True if the token is active, otherwise false
     */
    public function isActive();

    /**
     * Sets the database Id of the token
     *
     * @param int|string $id The database Id
     */
    public function setId($id);
}