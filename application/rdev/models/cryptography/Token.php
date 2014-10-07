<?php
/**
 * Copyright (C) 2014 David Young
 *
 * Defines a cryptographic token used for security
 */
namespace RDev\Models\Cryptography;

class Token implements IToken
{
    /** @var int The database Id of this token */
    protected $id = -1;
    /** @var string The hashed value */
    protected $hashedValue = "";
    /** @var \DateTime The valid-from date */
    protected $validFrom = null;
    /** @var \DateTime The valid-to date */
    protected $validTo = null;
    /** @var bool Whether or not this token is active */
    protected $isActive = false;

    /**
     * @param int $id The database Id of this token
     * @param string $hashedValue The hashed value
     * @param \DateTime $validFrom The valid-from date
     * @param \DateTime $validTo The valid-to date
     * @param bool $isActive Whether or not this token is active
     */
    public function __construct($id, $hashedValue, \DateTime $validFrom, \DateTime $validTo, $isActive)
    {
        $this->id = $id;
        $this->hashedValue = $hashedValue;
        $this->validFrom = $validFrom;
        $this->validTo = $validTo;
        $this->isActive = $isActive;
    }

    /**
     * {@inheritdoc}
     */
    public function deactivate()
    {
        $this->isActive = false;
    }

    /**
     * {@inheritdoc}
     */
    public function getHashedValue()
    {
        return $this->hashedValue;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive()
    {
        $now = new \DateTime("now", new \DateTimeZone("UTC"));

        return $this->isActive && $this->validFrom <= $now && $now < $this->validTo;
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }
} 