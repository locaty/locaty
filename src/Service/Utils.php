<?php

namespace Locaty\Service;

class Utils extends Basic {

    /**
     * @param array $data
     * @param array $keys
     * @param mixed $default
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function arrayGetRecursive(array $data, array $keys, $default = null) {
        if (!$this->arrayKeyExistsRecursive($data, $keys)) {
            return $default;
        }
        $result = $data;
        foreach ($keys as $key) {
            if (!is_array($result)) {
                return $default;
            }
            $result = $result[$key];
        }
        return $result;
    }

    /**
     * @param mixed $data
     * @param array $keys
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function arrayKeyExistsRecursive(array $data, array $keys): bool {
        if (count($keys) === 0) {
            throw new \InvalidArgumentException('Keys must be a non-empty array');
        }
        $result = $data;
        foreach ($keys as $key) {
            if (!is_numeric($key) && !is_string($key)) {
                return false;
            }
            if (!is_array($result) || !array_key_exists($key, $result)) {
                return false;
            }
            $result = $result[$key];
        }
        return true;
    }

    /**
     * @param array[] $items
     * @param string[] $keyFieldList
     * @return array[] Indexed lists of elements, having equal $keyField
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
     * @param array[] $items
     * @param string[] $keyFieldList
     * @return array[][] Indexed lists of elements, having equal $keyField
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
     * @param array[] $items
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
