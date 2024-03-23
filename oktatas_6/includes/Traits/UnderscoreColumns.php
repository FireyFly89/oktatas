<?php
trait UnderscoreColumns
{
    protected function getColumnNames(array $data, string $delimiter = ',', bool $isKey = true)
    {
        if ($isKey) {
            $data = array_keys($data);
        }

        return $this->camelToUnderscore(implode($delimiter, $data));
    }

    protected function convertKeysToUnderscore(array $data)
    {
        foreach($data as $key => $value) {
            $convertedKey = $this->camelToUnderscore($key);
            
            if ($convertedKey !== $key) {
                $data[$convertedKey] = $value;
                unset($data[$key]);
            }
        }

        return $data;
    }

    protected function camelToUnderscore($str, $separator = "_")
    {
        if (empty($str)) {
            return $str;
        }

        $str = lcfirst($str);
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);
        return strtolower($str);
    }
}
