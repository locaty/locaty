<?php

namespace Locaty\Service;

class Utils extends Basic {

    /**
     * @param array $data
     * @param array $keys
     * @param $value
     * @return array
     * @throws \InvalidArgumentException
     */
    public function arraySetRecursive(array $data, array $keys, $value): array {
        $result = $data;
        $currentKey = reset($keys);
        if (count($keys) === 1) {
            $result[$currentKey] = $value;
        } else {
            $currentValue = $this->arrayGetRecursive($result, [$currentKey], []);
            if (!is_array($currentValue)) {
                throw new \InvalidArgumentException("value ${currentKey} is not an array");
            }

            $result[$currentKey] = $this->arraySetRecursive($currentValue, array_slice($keys, 1), $value);
        }

        return $result;
    }

    /**
     * @param array $data
     * @param array $keys
     * @param $value
     * @return array
     * @throws \InvalidArgumentException
     */
    public function arrayAppendRecursive(array $data, array $keys, $value): array {
        $result = $data;
        $currentKey = reset($keys);
        if (count($keys) === 1) {
            $result[$currentKey][] = $value;
        } else {
            $currentValue = $this->arrayGetRecursive($result, [$currentKey], []);
            if (!is_array($currentValue)) {
                throw new \InvalidArgumentException("value ${currentKey} is not an array");
            }

            $result[$currentKey] = $this->arrayAppendRecursive($currentValue, array_slice($keys, 1), $value);
        }

        return $result;
    }


    /**
     * @param mixed $data
     * @param array $keys
     * @param mixed $default
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function arrayGetRecursive($data, array $keys, $default = null) {
        if (!$this->arrayKeyExistRecursive($data, $keys)) {
            return $default;
        }

        /** @var mixed $tempData */
        $tempData = $data;
        foreach ($keys as $key) {
            $getMethodName = "get" . ucfirst($key);
            if (is_object($tempData) && array_key_exists($key, get_object_vars($tempData))) {
                $tempData = $tempData->$key;
            } elseif (is_object($tempData) && method_exists($tempData, $key)) {
                $tempData = $tempData->$key();
            } elseif (is_object($tempData) && method_exists($tempData, $getMethodName)) {
                $tempData = $tempData->$getMethodName();
            } elseif (is_object($tempData) && method_exists($tempData, 'getDynamic')) {
                $tempData = $tempData->getDynamic($key);
            } elseif (is_array($tempData)) {
                $tempData = $tempData[$key];
            } else {
                return $default;
            }
        }
        return $tempData;
    }

    /**
     * @param mixed $data
     * @param array $keys
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function arrayKeyExistRecursive($data, array $keys): bool {
        if (count($keys) === 0) {
            throw new \InvalidArgumentException('Keys must be a non-empty array');
        }
        /** @var mixed $tempData */
        $tempData = $data;
        foreach ($keys as $key) {
            $isValidKey = is_numeric($key) || is_string($key);
            if (is_array($tempData) && $isValidKey && array_key_exists($key, $tempData)) {
                $tempData = $tempData[$key];
            } elseif (is_object($tempData) && array_key_exists($key, get_object_vars($tempData))) {
                $tempData = $tempData->$key;
            } elseif (is_object($tempData) && method_exists($tempData, $key)) {
                $tempData = $tempData->$key();
            } elseif (is_object($tempData) && method_exists($tempData, 'getDynamic')) {
                $tempData = $tempData->getDynamic($key);
            } else {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array|Object[] $items
     * @param string[] $keyFieldList
     *
     * @return array|Object[] Indexed lists of elements, having equal $keyField
     */
    public function indexByField(array $items, array $keyFieldList): array {
        $result = [];
        foreach ($items as $item) {
            $key = $this->arrayGetRecursive($item, $keyFieldList);
            if ($key === null) {
                continue;
            }
            $result[$key] = $item;
        }
        return $result;
    }

    /**
     * @param array|Object[] $items
     * @param string[] $keyFieldList
     *
     * @return array|Object[][] Indexed lists of elements, having equal $keyField
     */
    public function buildIndexedList(array $items, array $keyFieldList): array {
        $result = [];
        foreach ($items as $item) {
            $key = $this->arrayGetRecursive($item, $keyFieldList);
            if ($key !== null) {
                if (!array_key_exists($key, $result)) {
                    $result[$key] = [];
                }
                $result[$key][] = $item;
            }
        }
        return $result;
    }

    /**
     * @param array|Object[] $items
     * @param string[] $keyFieldList
     * @return array
     */
    public function extractField(array $items, array $keyFieldList): array {
        $result = [];
        foreach ($items as $key => $item) {
            $result[$key] = $this->arrayGetRecursive($item, $keyFieldList);
        }
        return $result;
    }
}
