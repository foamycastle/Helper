<?php

namespace Foamycastle\Utilities;

class Arr
{
    /**
     * Flatten an array
     * @param array $input
     * @param array $outputArray
     * @param string $path
     * @param string $delimiter
     * @return void
     */
    public static function Flatten(
        array $input,
        array &$outputArray=[],
        string $path="",
        string $delimiter=Str::STD_DOT_DEL
    ):void
    {
        $currentPath = $path;
        foreach (array_keys($input) as $array_key) {
            Str::AppendDotPath($path, $array_key);
            if(is_array($input[$array_key])) {
                self::Flatten($input[$array_key], $outputArray, $path);
            }else {
                $outputArray[$path] = $input[$array_key];
            }
            $path=$currentPath;
        }
        Str::TruncateDotPath($path,1);
    }
    /**
     * Given a path, retrieve a value from the array tree
     * @param array $input The array to traverse
     * @param string $path The path within the array from which a value will be retrieved
     * @param string $delimiter The delimiter used in the path.  By default, this is a dot
     * @return mixed            If the path within the array does not exist, returns `null`
     * @throws \Exception
     */
    public static function Traverse(array $input,string $path, string $delimiter=Str::STD_DOT_DEL):mixed
    {
        if(empty($delimiter)) {
            throw new \Exception("Delimiter cannot be empty");
        }
        //convert the path to a queue
        $pathQueue = explode($delimiter, $path);
        if(empty($pathQueue)) {
            throw new \Exception('The path string does not contain the delimiter');
        }

        do{
            $findElement = array_shift($pathQueue);
            if(!isset($input[$findElement])) {
                return null;
            }
            $input = $input[$findElement];
        }while(count($pathQueue)>0);
        return $input;
    }
}