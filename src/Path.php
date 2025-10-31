<?php

namespace Foamycastle\Utilities;

class Path
{
    /**
     * Returns a prepared path with a filename
     */
    public const int WITH_FILENAME=0;
    /**
     * returns a prepared path without a filename
     */
    public const int WITHOUT_FILENAME=1;
    /**
     * @var string A cache that stores the previous output of the ::Prepare method
     */
    private static string $previousPath;
    /**
     * Prepare a file path for reading by replacing incorrect directory separators and converting the path to a canonical path
     * @param string $path      the path to prepare. if the argument is left blank, the previous result is returned.
     * @param int<Path::WITH_FILENAME|Path::WITHOUT_FILENAME> $withFileName returns the path with or without the trailing filename.
     * @return string           the prepared path
     */
    public static function Prepare(string $path="", int $withFileName=Path::WITH_FILENAME):string
    {
        if($path=="" && isset(self::$previousPath)) return self::$previousPath;

        //test for a file name
        if (str::Right($path,['\\','/'])){
            $trailingComponent='';
        }else{
            $trailingComponent=basename($path);
        }
        $path = dirname($path);
        $path=str_replace(['\\','/'],DIRECTORY_SEPARATOR,$path);
        self::$previousPath = $withFileName === Path::WITH_FILENAME
            ? realpath($path).DIRECTORY_SEPARATOR.$trailingComponent
            : realpath($path);
        return self::$previousPath;
    }
}