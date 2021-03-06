<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\Framework\Debug\Exceptions\Handlers\Http;

use Opulence\Debug\Exceptions\Handlers\IExceptionRenderer as IBaseRenderer;
use Opulence\Http\Requests\Request;
use Opulence\Http\Responses\Response;
use Opulence\Views\Compilers\ICompiler;
use Opulence\Views\Factories\IViewFactory;

/**
 * Defines the interface for HTTP exception renderers to implement
 */
interface IExceptionRenderer extends IBaseRenderer
{
    /**
     * Gets the last response
     *
     * @return Response The last response
     */
    public function getResponse();

    /**
     * Sets the HTTP request
     *
     * @param Request $request The current request
     */
    public function setRequest(Request $request);

    /**
     * Sets the view compiler
     *
     * @param ICompiler $viewCompiler The view compiler
     */
    public function setViewCompiler(ICompiler $viewCompiler);

    /**
     * Sets the view factory
     *
     * @param IViewFactory $viewFactory The view factory
     */
    public function setViewFactory(IViewFactory $viewFactory);
}