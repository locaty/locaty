<?php

namespace Locaty\Controller;

use Locaty\SL;
use Locaty\Transfer\Response;

abstract class Basic {

    /**
     * @param string $name
     * @return callable
     */
    public static function action(string $name): callable {
        return [get_called_class(), $name . 'Action'];
    }

    /**
     * @param string $template
     * @param array $params
     * @return Response\Html
     */
    protected function _createTemplateResponse(string $template, array $params = []): Response\Html {
        $content = SL::template()->render($this->_generateTemplateFileName($template), $params);
        return new Response\Html($content);
    }

    /**
     * @param string $template
     * @return string
     */
    protected function _generateTemplateFileName(string $template): string {
        return $this->_getTemplateDir() . '/' . $template . '.php';
    }

    /**
     * @return string
     */
    abstract protected function _getTemplateDir(): string;
}
