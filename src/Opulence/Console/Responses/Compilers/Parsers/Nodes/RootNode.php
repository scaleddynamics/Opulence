<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Console\Responses\Compilers\Parsers\Nodes;

/**
 * Defines a root node
 */
class RootNode extends Node
{
    public function __construct()
    {
        parent::__construct(null);
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isTag()
    {
        return false;
    }
}