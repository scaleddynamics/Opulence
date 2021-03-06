<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Validation\Rules;

/**
 * Defines the integer rule
 */
class IntegerRule implements IRule
{
    /**
     * @inheritdoc
     */
    public function getSlug()
    {
        return "integer";
    }

    /**
     * @inheritdoc
     */
    public function passes($value, array $allValues = [])
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }
}