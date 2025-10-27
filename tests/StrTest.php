<?php
//Append Dot Path Test
use Foamycastle\Utilities\Str;

include '../src/Str.php';

//Test appending a path to a blank string
$blankPath = '';
$oldPath = 'first.second.third.fourth';
$stringAppendix = 'fifth.sixth.seventh.eighth';
$stringAppendix2 = 'ninth';
echo "===TEST Str::AppendDotPath()===\n\n";
echo "ORIGINAL PATH:   $blankPath\n";
Str::AppendDotPath($blankPath, $oldPath);
echo "APPENDIX 1 PATH: $blankPath\n";
Str::AppendDotPath($blankPath, $stringAppendix);
echo "APPENDIX 2 PATH: $blankPath\n";
Str::AppendDotPath($blankPath, $stringAppendix2,true);
echo "APPENDIX 3 PATH: $blankPath\n\n\n";
echo "===TEST Str::TruncateDotPath()===\n\n";
echo "ORIGINAL PATH:   $blankPath\n";
Str::TruncateDotPath($blankPath,1);
echo "TRUNCATE ONE ELEMENT:   $blankPath\n";
Str::TruncateDotPath($blankPath,2);
echo "TRUNCATE TWO ELEMENTS:   $blankPath\n";
Str::TruncateDotPath($blankPath,10);
echo "TRUNCATE TEN ELEMENTS:   $blankPath\n";