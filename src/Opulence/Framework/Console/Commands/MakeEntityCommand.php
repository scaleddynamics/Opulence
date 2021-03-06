<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Framework\Console\Commands;

/**
 * Makes an entity class
 */
class MakeEntityCommand extends MakeCommand
{
    /**
     * @inheritdoc
     */
    protected function define()
    {
        parent::define();

        $this->setName("make:entity")
            ->setDescription("Creates an entity class");
    }

    /**
     * @inheritdoc
     */
    protected function getFileTemplatePath()
    {
        return __DIR__ . "/templates/Entity.template";
    }
}