<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Authorization\ErrorHandler;

use Oryzone\Bundle\OauthBundle\Authorization\Error\ErrorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class RenderTemplateErrorHandler
 * @package Oryzone\Bundle\OauthBundle\Authorization\ErrorHandler
 */
class RenderTemplateErrorHandler implements ErrorHandlerInterface
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface $engine
     */
    protected $engine;

    /**
     * @var string $template
     */
    protected $template;

    /**
     * Constructor
     *
     * @param EngineInterface $engine
     * @param string          $template
     */
    public function __construct(EngineInterface $engine, $template)
    {
        $this->engine = $engine;
        $this->template = $template;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ErrorInterface $error)
    {
        $rendered = $this->engine->render($this->template, array('error' => $error));

        return new Response($rendered);
    }

}
