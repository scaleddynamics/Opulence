<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Views\Caching;

use Opulence\Views\IView;

/**
 * Defines the interface for view caches to implement
 */
interface ICache
{
    /** The default lifetime of a cached view */
    const DEFAULT_LIFETIME = 3600;
    /** The default chance that garbage collection will be run in this instance */
    const DEFAULT_GC_CHANCE = 1;
    /** The default number the chance will be divided by to calculate the probability */
    const DEFAULT_GC_DIVISOR = 1000;

    /**
     * Flushes all of the compiled views from cache
     */
    public function flush();

    /**
     * Performs garbage collection of expired views
     */
    public function gc();

    /**
     * Gets the compiled view contents
     *
     * @param IView $view The view whose cached contents we want
     * @return string|null The compiled view contents if it existed, otherwise null
     */
    public function get(IView $view);

    /**
     * Gets whether or not the cache has the compiled contents for the input view
     *
     * @param IView $view The view to check
     * @return bool True if the cache has an unexpired compiled view, otherwise false
     */
    public function has(IView $view);

    /**
     * Stores a compiled view to cache
     *
     * @param IView $view The view whose compiled contents we're caching
     * @param string $compiledContents The compiled view contents
     * @return bool True if successful, otherwise false
     */
    public function set(IView $view, $compiledContents);

    /**
     * Sets the chance that garbage collection will be run
     * For example, passing (123, 1000) means you will have a 123/1000 chance of having to perform garbage collection
     *
     * @param int $chance The chance (out of the total) that garbage collection will be run
     * @param int $divisor The number the chance will be divided by to calculate the probability
     */
    public function setGCChance($chance, $divisor = 100);
}