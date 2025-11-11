<?php

namespace Foamycastle\Utilities;

/**
 * Class of helper functions concerning strings
 */
class Str
{
    /**
     * Compare strings in a binary-safe manner
     */
    public const int CMP_BIN=0;
    /**
     * Compare strings in a case-sensitive manner
     */
    public const int CMP_CS=1;
    /**
     * Compare strings in a case-insensitive manner
     */
    public const int CMP_CIS=2;
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
        }else{
            if(str_contains($appendix, $delimiter)){
                throw new \InvalidArgumentException('Appendix cannot contain the delimiter');
            }
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

    /**
     * Test the left side of a string for equality to an input
     * @param string $input The input string
     * @param string|array $test The string to test for
     * @param int<Str::CMP_BIN|Str::CMP_CS|Str::CS_CIS> $cmp The manner in which comparison is performed
     * @return bool
     */
    public static function Left(string $input,string|array $test,int $cmp=Str::CMP_CS):bool
    {

        if(is_string($test)){
            $test=[$test];
        }else{
            if(!array_is_list($test)) {
                Arr::flatten($test);
                $test = array_values($test);
            }
        }
        $filtered=array_filter($test,function($val) use($cmp,$input) {
            $testLength = strlen($val);
            return match ($cmp) {
                Str::CMP_BIN=>  strcmp($val,substr($input,0,$testLength))==0,
                Str::CMP_CS=>   str_starts_with($val,substr($input,$testLength)),
                Str::CMP_CIS=>  strtoupper($val)===strtoupper(substr($input,0,$testLength)),
                default=>false
            };
        });
        return count($filtered)>0;
    }

    /**
     * Test the left side of a string for equality to an input
     * @param string $input The input string
     * @param string|string[] $test The string to test for.  This argument may be a single string or an array of strings
     * @param int<Str::CMP_BIN|Str::CMP_CS|Str::CS_CIS> $cmp The manner in which comparison is performed
     * @return bool
     */
    public static function Right(string $input,string|array $test,int $cmp=Str::CMP_CS):bool
    {

        if(is_string($test)){
            $test=[$test];
        }else{
            if(!array_is_list($test)) {
                Arr::flatten($test);
                $test = array_values($test);
            }
        }
        $filtered=array_filter($test,function($val) use($cmp,$input) {
            $testLength = strlen($val);
            return match ($cmp) {
                Str::CMP_BIN=>  strcmp($val,substr($input,-$testLength))==0,
                Str::CMP_CS=>   str_ends_with($val,$input),
                Str::CMP_CIS=>  strtoupper($val)===strtoupper(substr($input,-$testLength)),
                default=>false
            };
        });
        return count($filtered)>0;
    }

    /**
     * Extract a string from other data types, such as objects and callables
     * @param mixed $data
     * @return string
     */
    public static function StringFrom(mixed $data):string
    {
        if (is_object($data)) {
            if ($data instanceof \Stringable and method_exists($data, '__toString')) {
                $data = $data->__toString();
            }
        }
        if ($data instanceof \Closure) {
            $data=$data(...)();
        }
        if(is_callable($data)){
            $data=$data();
        }
        if(is_bool($data)){
            $data = ($data)?'true':'false';
        }
        if(is_array($data)){
            $data = json_encode($data);
        }
        return $data;
    }

    /**
     * Limits a string to a given length
     * @param string $input the string in need of truncating
     * @param int $len      the desired length to which the input shall be truncated
     * @param bool $ellipses if TRUE, the string will be truncate 3 characters less than `$len` and an ellipsis will be added
     * @return string
     */
    public static function LimitToLen(string $input,int $len,bool $ellipses=false):string
    {

        if(strlen($input)>=$len){
            if($ellipses){
                $output=substr($input,0,$len-3)."...";
            }else{
                $output=substr($input,0,$len);
            }
            return $output;
        }
        return $input;
    }
    public static function FilterNonAlpha(string $input):string
    {
        return preg_replace('/^[^a-zA-Z][^A-Za-z0-9]/','',$input);
    }
}