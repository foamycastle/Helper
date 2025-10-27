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
     * @return array
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
}