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
 * Makes an HTTP middleware class
 */
class MakeHttpMiddlewareCommand extends MakeCommand
{
    /**
     * @inheritdoc
     */
    protected function define()
    {
        parent::define();

        $this->setName("make:httpmiddleware")
            ->setDescription("Creates an HTTP middleware class");
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "\\Http\\Middleware";
    }

    /**
     * @inheritdoc
     */
    protected function getFileTemplatePath()
    {
        return __DIR__ . "/templates/HttpMiddleware.template";
    }
}