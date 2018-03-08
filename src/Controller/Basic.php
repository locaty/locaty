<?php

namespace Locaty\Controller;

use Locaty\Transfer\Response;
use Locaty\Component\Template;

abstract class Basic {

    /**
     * @param string $name
     * @return callable|array
     */
    public static function action(string $name) {
        return [get_called_class(), $name . 'Action'];
    }

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
     * @return Template\Engine\Basic
     */
    abstract protected function _getTemplateEngine(): Template\Engine\Basic;
}
