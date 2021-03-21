<?php
require_once __DIR__.'../../excel_parser.php';

$crr_date = date("Y-m-d Hi");
$txt_file = 'TestReport.txt';
$test_report = fopen($txt_file, 'w');

fwrite($test_report, $crr_date."\n");

//TESTING EXCEL PARSER
// Test1 Good output
function TC1()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST1----\nImport valid file, expecting 12 lines\n");
    $wanted = 12;
    $got = 0; 
    $filename = "test1.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
    
}

// TC2 Missing header
function TC2()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST2----\nImport file has no header, expecting no lines\n");
    $wanted = 0;
    $got = 0; 
    $filename = "test2.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

// TC3 Missing summary
function TC3()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST3----\nImport file is missing 1 summary, expecting 11 lines\n");
    $wanted = 11;
    $got = 0; 
    $filename = "test3.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

// TC4 Missing material
function TC4()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST4----\nImport files 1 job missing material row, expecting 12 lines\n");
    $wanted = 12;
    $got = 0; 
    $filename = "test4.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

// TC5 Missing work
function TC5()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST5----\nImport files 1 job missing work row, expecting 11 lines\n");
    $wanted = 11;
    $got = 0; 
    $filename = "test5.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

// TC6 Missing exit condition
function TC6()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST6----\nImport valid file, missing 1 exit condition, expecting 12 lines\n");
    $wanted = 12;
    $got = 0; 
    $filename = "test6.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

// TC7 Wrong extension
function TC7()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST7----\nImport wrong file extension, expecting nothing\n");
    $wanted = 0;
    $got = 0; 
    $filename = "test7.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

// TC8 Correct extension, meesed up file
function TC8()
{
    global $test_report, $txt_file;

    fwrite($test_report, "----TEST8----\nImport valid file, cant get data from inside, expecting no lines\n");
    $wanted = 0;
    $got = 0; 
    $filename = "test8.xlsx";
    $return = parse_excel_file($filename, 0);
    $got = count($return);
    if ($wanted == $got)
    {
        fwrite($test_report, "Success, found number of lines ".$got."\n\n");
    }else
    {
        fwrite($test_report, "Failed, found number of lines ".$got."\n\n");
    }
}

TC1();
TC2();
TC3();
TC4();
TC5();
TC6();
TC7();
TC8();
fclose($test_report);
//$new_name = "TestReport ".$crr_date;
//$test_report = rename($txt_file, $new_name.'.txt');
?>