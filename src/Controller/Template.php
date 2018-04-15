<?php

namespace Locaty\Controller;

use Locaty\Component;
use Locaty\Transfer\Response;

abstract class Template extends Basic {

    /**
     * @param string $template
     * @param array $params
     * @return Response\Html
     */
    protected function _createTemplateResponse(string $template, array $params = []): Response\Html {
        $content = $this->_getTemplateEngine()->render($template, $params);
        return new Response\Html($content);
    }

    /**
     * @return Component\Template\Engine\Basic
     */
    abstract protected function _getTemplateEngine(): Component\Template\Engine\Basic;
}
