<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Validation\Rules;

use InvalidArgumentException;

/**
 * Tests the equals rule
 */
class EqualsRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that equal values pass
     */
    public function testEqualValuesPass()
    {
        $rule = new EqualsRule();
        $rule->setArgs(["foo"]);
        $this->assertTrue($rule->passes("foo"));
    }

    /**
     * Tests getting the slug
     */
    public function testGettingSlug()
    {
        $rule = new EqualsRule();
        $this->assertEquals("equals", $rule->getSlug());
    }

    /**
     * Tests passing an empty arg array
     */
    public function testPassingEmptyArgArray()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $rule = new EqualsRule();
        $rule->setArgs([]);
    }

    /**
     * Tests that unequal values fail
     */
    public function testUnequalValuesFail()
    {
        $rule = new EqualsRule();
        $rule->setArgs(["foo"]);
        $this->assertFalse($rule->passes("bar"));
    }
}