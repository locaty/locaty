<?php

namespace Locaty\Transfer;

use Locaty\Exception;

class Request {

    /**
     * @var array
     */
    private $_serverData;

    /**
     * @var array
     */
    private $_uriParams;

    /**
     * @var array
     */
    private $_postData;

    /**
     * @var string
     */
    private $_body;

    /**
     * @var mixed
     */
    private $_jsonBody;

    /**
     * @param array $uriParams
     * @param array $postData
     * @param string $body
     * @param array $serverData
     */
    public function __construct(array $uriParams, array $postData, string $body, array $serverData) {
        $this->_serverData = $serverData;
        $this->_uriParams = $uriParams;
        $this->_postData = $postData;
        $this->_body = $body;
    }

    /**
     * @return string
     * @throws Exception\BadRequest
     */
    public function method(): string {
        if (!array_key_exists('REQUEST_METHOD', $this->_serverData)) {
            throw new Exception\BadRequest('Server param REQUEST_METHOD not found');
        }
        return $this->_serverData['REQUEST_METHOD'];
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, $default = null) {
        return array_key_exists($name, $this->_uriParams) ? $this->_uriParams[$name] : $default;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception\BadRequest
     */
    public function requireGet(string $name) {
        $result = $this->get($name);
        if ($result === null) {
            throw new Exception\BadRequest("GET param '{$name}' is required");
        }

        return $result;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function post(string $name, $default = null) {
        return array_key_exists($name, $this->_postData) ? $this->_postData[$name] : $default;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception\BadRequest
     */
    public function requirePost(string $name) {
        $result = $this->post($name);
        if ($result === null) {
            throw new Exception\BadRequest("POST param '{$name}' is required");
        }

        return $result;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function body(string $name, $default = null) {
        $body = $this->getBodyJson();
        if ($body === null) {
            return $default;
        }

        return array_key_exists($name, $body) ? $body[$name] : $default;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception\BadRequest
     */
    public function requireBody(string $name) {
        $result = $this->body($name);
        if ($result === null) {
            throw new Exception\BadRequest("JSON body param '{$name}' is required");
        }

        return $result;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function param(string $name, $default = null) {
        if (array_key_exists($name, $this->_uriParams)) {
            return $this->_uriParams[$name];
        }
        if (array_key_exists($name, $this->_postData)) {
            return $this->_postData[$name];
        }
        $bodyJson = $this->getBodyJson();
        if (is_array($bodyJson) && array_key_exists($name, $bodyJson)) {
            return $bodyJson[$name];
        }
        return $default;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception\BadRequest
     */
    public function requireParam(string $name) {
        $result = $this->param($name);
        if ($result === null) {
            throw new Exception\BadRequest("Param '{$name}' is required");
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getBodyText(): string {
        return $this->_body;
    }

    /**
     * @return array
     */
    public function getBodyJson() {
        if ($this->_jsonBody === null) {
            $this->_jsonBody = json_decode($this->getBodyText(), true);
        }
        return $this->_jsonBody;
    }

    /**
     * @return array
     */
    public function getUriParams(): array {
        return $this->_uriParams;
    }
}
