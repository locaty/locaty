<?php

namespace Locaty\Component\Template;

use Locaty\Service;

class Facade extends Service\Basic {

    /**
     * @param string $fileName
     * @param array $vars
     * @return string
     */
    public function render(string $fileName, array $vars = []): string {
        foreach ($vars as $k => $v) {
            $$k = $v;
        }
        ob_start();
        /** @noinspection PhpIncludeInspection */
        require $fileName;
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}
