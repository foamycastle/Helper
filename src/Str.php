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
     * @param bool $trailingDelimiter    if TRUE, the delimiter is appended to the end of the path
     * @param string $delimiter         The standard dot delimiter in dot notation
     * @return void
     */
    public static function AppendDotPath(
        string       &$dotPath,
        string|array $appendix,
        bool         $trailingDelimiter=false,
        string       $delimiter=self::STD_DOT_DEL
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
            $hasTrailingDelimiter = substr($dotPath,-1)==$delimiter;
            if($hasTrailingDelimiter) {
                $dotPath .= $appendix;
            }else{
                $dotPath .= $delimiter.$appendix;
            }
        }
        if($trailingDelimiter) {
            $dotPath .= $delimiter;
        }
    }

    /**
     * Remove elements from a path in dot notation
     * @param string $dotPath           The path being truncated
     * @param int $removeElements       The number of elements to remove from the path
     * @param bool $trailingDelimiter   if TRUE, leave a trailing delimiter on the path
     * @param string $delimiter         the standard dot delimiter
     * @return void
     */
    public static function TruncateDotPath(
        string  &$dotPath,
        int     $removeElements = 0,
        bool    $trailingDelimiter=false,
        string  $delimiter=self::STD_DOT_DEL
    ):void
    {
        $length = strlen($dotPath);
        $hasTrailingDelimiter = substr($dotPath,-1)==$delimiter;
        if($hasTrailingDelimiter) {
            $dotPath = substr($dotPath,0,$length-1);
            $length = strlen($dotPath);
        }
        while($removeElements>0 && $length!=0) {
            $lastDelimiter = strrpos($dotPath, $delimiter);
            if($lastDelimiter===false){
                $lastDelimiter=0;
            }
            $dotPath = substr($dotPath,0,$lastDelimiter);
            $removeElements--;
            $length=strlen($dotPath);
        }
        if($trailingDelimiter && $length!=0) {
            $dotPath .= $delimiter;
        }
    }
}