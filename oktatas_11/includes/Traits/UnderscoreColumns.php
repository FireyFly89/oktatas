<?php
trait UnderscoreColumns
{
    public static function getColumnNames(array $data, string $delimiter = ',', bool $isKey = true)
    {
        if ($isKey) {
            $data = array_keys($data);
        }

        return self::camelToUnderscore(implode($delimiter, $data));
    }

    public static function convertKeysToUnderscore(array $data)
    {
        foreach($data as $key => $value) {
            $convertedKey = self::camelToUnderscore($key);
            
            if ($convertedKey !== $key) {
                $data[$convertedKey] = $value;
                unset($data[$key]);
            }
        }

        return $data;
    }

    public static function camelToUnderscore($str, $separator = "_")
    {
        if (empty($str)) {
            return $str;
        }

        $str = lcfirst($str);
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);
        return strtolower($str);
    }
}
