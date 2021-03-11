<?php
require_once __DIR__.'/test_parse.php';
//TESTING EXCEL PARSER
// Test1 Good output
function TC1()
{
    echo "----TEST1----<br>";
    echo "Starting<br>";
    echo 'Import valid file, expecting 13 lines<br>';
    $filename = "test1.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }
    
}

// TC2 Missing header
function TC2()
{
    echo "----TEST2---- <br>";
    echo "Starting<br>";
    echo 'Import file has no header, expecting no lines<br>';
    $filename = "test2.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }
}

// TC3 Missing summary
function TC3()
{
    echo "----TEST3----<br>";
    echo "Starting<br>";
    echo 'Import file is missing 1 summary, expecting 12 lines<br>';
    $filename = "test3.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }
}

// TC4 Missing material
function TC4()
{
    echo "----TEST4----<br>";
    echo "Starting<br>";
    echo 'Import files 1 job missing material row, expecting 13 lines<br>';
    $filename = "test4.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }
}

// TC5 Missing work
function TC5()
{
    echo "----TEST5----<br>";
    echo "Starting<br>";
    echo 'Import files 1 job missing work row, expecting 13 lines<br>';
    $filename = "test5.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }
}

// TC6 Missing exit condition
function TC6()
{
    echo "----TEST6----<br>";
    echo "Starting<br>";
    echo 'Import valid file, missing 1 exit condition, expecting 13 lines<br>';
    $filename = "test6.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }
}

// TC7 Wrong extension
function TC7()
{
    echo "----TEST7----<br>";
    echo "Starting<br>";
    echo 'Import wrong file extension, expecting nothing<br>';
    $filename = "test7.txt";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
    }else{echo'Found nothing<br><br>';}
}

// TC8 Correct extension, meesed up file
function TC8()
{
    echo "----TEST8----<br>";
    echo "Starting<br>";
    echo 'Import valid file, cant get data from inside, expecting no lines<br>';
    $filename = "test8.xlsx";
    main_main($filename);
    echo "Finished<br>";
    $select = "SELECT * FROM Estimate";
    $con = mysqli_connect('localhost', 'root', '', 'test');
    if ($query = mysqli_query($con, $select))
    {
        $row_cnt = $query->num_rows;
        echo "Found number of rows $row_cnt <br><br>";
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

?>