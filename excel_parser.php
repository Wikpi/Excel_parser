<?php
    function main_main($file)
    {
        // Enter your mysql username
        $user = 'root';
        // Enter your mysql password
        $password = '';
        // Enter the database you are going to use
        $database = 'test';
        //Default host
        $host = 'localhost';

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        // Connect to mysql
        $con = mysqli_connect($host, $user, $password, $database);
        $con->set_charset("utf8");

        // Check if there was an error connecting
        if ($con->connect_error)
        {
            die('Connect Error (' . $con->connect_errno . ') '
                    . $con->connect_error);
        }

        mysqli_query($con, 'DROP TABLE IF EXISTS `test`.`estimate`');

        if(isset($file))
        {   
            //Check if user inputed the correct file type
            $wanted = array('xlsx');
            $check_extension = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array($check_extension, $wanted))
            {
                echo "You have inputed the wrong file type <br>";
                echo "Wanted file type: xlsx(excel)";
                $file = NULL;
            }else
            {

                //Create table
                $sql = "CREATE TABLE estimate(
                    Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Work_name VARCHAR(150) COLLATE 'utf8_general_ci',
                    Material_type VARCHAR(50) COLLATE 'utf8_general_ci',
                    Mass FLOAT,
                    Mass_m VARCHAR(20) COLLATE 'utf8_general_ci',
                    Mass_price FLOAT,
                    Work VARCHAR(20) COLLATE 'utf8_general_ci',
                    Work_m VARCHAR(20) COLLATE 'utf8_general_ci',
                    Work_price FLOAT
                )";
                
                $result = mysqli_query($con, $sql) or die ("Bad create: $con->error");
                
                //Incude excel_parser class
                require_once __DIR__.'/excel_parser_class.php';
                
                $excel = SimpleXLSX::parse($file);
                
                $num_cols = 15;
                $num_rows = 200;

                $invalid_val = -1;
                $work_col_numb = $invalid_val;
                $mass_col_numb = $invalid_val;
                $measurement_col_numb = $invalid_val;
                $price_col_numb = $invalid_val;
                $queue_numb = $invalid_val;
                
                    
                $rows = $excel->rows();
                $crr_row_idx = 0;
                $jobs_found = 0;
            
                echo 'Starting! <br>';
                //Start parsing
                foreach ($rows as $c)
                {   
                    // Exit causes
                    if ($crr_row_idx >= $num_rows)
                    {
                        echo "<br>Exited by reaching maxmimum number of rows! <br>";
                        break;
                    }
                    if ($c[1] == 'Iš viso')
                    {
                        echo "<br>Exited by reaching the conclusion! <br>";
                        break;
                    }

                    $name = '';
                    $material = '';
                    $mass = '';
                    $mass_m = '';
                    $mass_price = '';
                    $work = '';
                    $work_m = ''; 
                    $work_price = '';

                    //Find header
                    if ($c[0] == 'Eil. Nr.')
                    {
                        $queue_numb = $crr_row_idx;
                        echo "Found header! <br>";
                        $y = 0;
                        for ($y; $y <= $num_cols; $y++)
                        {  
                            // Find measurement column in the header
                            if (isset($c[$y]) && $c[$y] == 'Mato vnt.')
                            {
                                $measurement_col_numb = $y;
                                continue;
                            }else {}

                            // Find price column in the header
                            if (isset($c[$y]) && $c[$y] == 'Kaina')
                            {
                                $price_col_numb = $y;
                                continue;
                            }else{}

                            // Find work column in the header
                            if (isset($c[$y]) && $c[$y] == 'Darbas')
                            {
                                $work_col_numb = $y;
                                continue;
                            }else{}

                            // Find mass column in the header
                            if (isset($c[$y]) && $c[$y] == 'Medžiagos')
                            {
                                $mass_col_numb = $y;
                                continue;
                            }else{}

                        }
                    }

                    //Check if summaries first cell has a digit and if its a floating number
                    if ($crr_row_idx > $queue_numb && $c[0] == (float)$c[0] && is_numeric($c[0]))
                    {   
                        //Chekc if header was found
                        if ($work_col_numb == $invalid_val)
                        {
                            echo 'Header not found';
                            break;
                        }
                        $jobs_found++;
                        echo "<br>Found job $jobs_found! <br>";
                        
                        //Assign name variable
                        $name = $c[1];
                        print_r($name);
                        echo '<br>';
                        $next_row_idx = $crr_row_idx+1;
                        $next_row = $rows[$next_row_idx];

                        //Find and assign work variables
                        if ($next_row[0] == '' && $next_row[1] == 'Darbas')
                        {
                            $work = $next_row[$work_col_numb];
                            $work_m = $next_row[$measurement_col_numb];
                            $work_price = $next_row[$price_col_numb];

                        }else{echo "No work data <br>";}
                        
                        $next_row_idx++;
                        $next_row = $rows[$next_row_idx];

                        //Find and assign material variables
                        if ($next_row[0] == '' && $next_row[$mass_col_numb] != '')
                        {
                            $material = $next_row[1];
                            $mass = $next_row[$mass_col_numb];
                            $mass_m = $next_row[$measurement_col_numb];
                            $mass_price = $next_row[$price_col_numb];
                            
                        }else{echo "No material data <br>";}

                        #Insert into database
                        $stmt = mysqli_prepare($con, "INSERT INTO estimate 
                                                        (Work_name, Material_type, Mass, Mass_m, Mass_price, Work, Work_m, Work_price) 
                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, 'ssdsdssd', $name, $material, $mass, $mass_m, $mass_price, $work, $work_m, $work_price);
                            mysqli_stmt_execute($stmt);
                            echo 'Data successfully inserted<br>';
                        } else {
                            echo "Error mysqli_prepare!<br>";
                        }

                            
                    }else{}
                    
                    
                    $crr_row_idx++;
                }
                echo '<br>Finished!<br>';
                echo 'Found '.$jobs_found.' jobs!<br>';
                //Close connection
                mysqli_close($con);
            }
        }
    }
?>
<html>
<head>
    <title>Excel file parser</title>
</head>
<body>
<form action="#" method="POST" enctype="multipart/form-data">
    <input type="file" name="excel">
    <input type="submit" name="Submit">
</form>
<?php
    $input = $_FILES['excel']['name'];
    main_main($input);
?>
</body>
</html>