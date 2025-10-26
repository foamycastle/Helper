<?php

namespace Foamycastle\Utilities;

/**
 * Class of helper functions concerning strings
 */
class Str
{
    /**
     * Return the string representation of a boolean
     * @param bool $bool bool to conversion
     * @param bool $caps if true, return the string in all caps
     * @return string
     */
    static function fromBool(bool $bool, bool $caps=false):string
    {
        return $bool
            ? ($caps ? 'TRUE' : 'true')
            : ($caps ? 'FALSE' : 'false');
    }

    /**
     * Conversion of a string value to a boolean.
     * @param string $bool
     * @return bool
     */
    static function toBool(string $bool=''):bool
    {
        if (empty($bool)) return false;
        $bool = trim($bool);
        if(strtolower($bool)=='true') return true;
        if(strtolower($bool)=='false') return false;
        if(!empty($bool)) return true;
        return false;
    }

}