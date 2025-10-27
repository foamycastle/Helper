<?php
include '../src/Arr.php';
include '../src/Str.php';

use Foamycastle\Utilities\Arr;
function testArrayFlatten():void{
    $outputArray = [];
    $testArray = [
        'firstName' => 'John',
        'lastName' => 'Doe',
        'children' => [
            [
                'firstName' => 'Jane',
                'lastName' => 'Doe'
            ],
            [
                'firstName' => 'Jord',
                'lastName' => 'Doe'
            ]
        ]
    ];
    Arr::flatten($testArray, $outputArray);
    var_dump($outputArray);
}
testArrayFlatten();