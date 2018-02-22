<?php

namespace Locaty\Component\Controller;

abstract class AbstractController {

    /**
     * @param string $name
     * @return ControllerMethodAction
     */
    public static function action(string $name): ControllerMethodAction {
        return new ControllerMethodAction(get_called_class(), $name . 'Action');
    }
}
