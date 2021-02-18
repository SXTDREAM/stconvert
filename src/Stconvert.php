<?php

namespace Sxt\Stconvert;


class Stconvert
{


    public static $simplifiedKey;
    public static $traditionalKey;

    private static function init()
    {
        if (static::$traditionalKey && static::$simplifiedKey) {
            return;
        }

        static::$traditionalKey = require_once __DIR__ . '/simplified_traditional.php';
        static::$simplifiedKey = array_flip(static::$traditionalKey);
    }

    /**
     * 转化为简体
     *
     * @param $text
     * @return string
     */
    public static function t2s($text)
    {
        return static::reverse($text, true);
    }

    /**
     * 转化为繁体
     *
     * @param $text
     * @return string
     */
    public static function s2t($text)
    {
        return static::reverse($text, false);
    }

    private static function reverse($text, $toSimplified = false)
    {
        static::init();

        $result = '';

        $words = static::toArray($text);

        foreach ($words as $word) {
            if (static::isChinese($word)) {
                $word = ($toSimplified ? (static::$traditionalKey[$word] ?? $word) : (static::$simplifiedKey[$word] ?? $word));
            }
            $result .= $word;
        }

        return $result;
    }

    /**
     * 转化中文至字符串
     *
     * @param string $text
     * @return array
     */
    public static function toArray($text)
    {
        $len = $index = mb_strlen($text);

        $result = [];

        while ($index > 0) {
            $result[] = mb_substr($text, $len - $index, 1);
            --$index;
        }

        return $result;
    }

    /**
     * 判断是否中文
     *
     * @param string $text
     * @return bool
     */
    public static function isChinese($text)
    {
        return preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $text) > 0;
    }

    /**
     * 判断是否包含中文
     *
     * @param string $text
     * @return bool
     */
    public static function hasChinese($text)
    {
        return preg_match('/[\x{4e00}-\x{9fa5}]/u', $text) > 0;
    }
}
