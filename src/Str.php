<?php

namespace Foamycastle\Utilities;

/**
 * Class of helper functions concerning strings
 */
class Str
{
    /**
     * The standard delimiter in dot path notation
     */
    public const string STD_DOT_DEL = ".";

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

    /**
     * Append a path in dot notation with a new segment
     * @param string $dotPath           The current dot path
     * @param string|string[] $appendix    The new segment of the path
     * @param bool $leadingDelimiter    if TRUE, the delimiter is appended to the end of the path
     * @param string $delimiter         The standard dot delimiter in dot notation
     * @return void
     */
    public static function AppendDotPath(
        string &$dotPath,
        string|array $appendix,
        bool $leadingDelimiter=false,
        string $delimiter=self::STD_DOT_DEL
    ):void
    {
        if(is_array($appendix)){
            if(!array_is_list($appendix)){
                throw new \InvalidArgumentException('Appendix should be a string or a list of strings');
            }
            $appendix = implode($delimiter, $appendix);
        }
        if(empty($dotPath)) {
            $dotPath = $appendix;
        }else{
            $hasLeadingDelimiter = substr($dotPath,-1)==$delimiter;
            if($hasLeadingDelimiter) {
                $dotPath .= $appendix;
            }else{
                $dotPath .= $delimiter.$appendix;
            }
        }
        if($leadingDelimiter) {
            $dotPath .= $delimiter;
        }
    }
}