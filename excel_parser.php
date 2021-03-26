<?php
    //Function echoes only if $file_specifier is set to 1
    function printer($f, $s)
    {
        if ($s == 1){echo $f;} 
    }

    function parse_excel_file($file, $file_specifier)
    {
        
        if(isset($file))
        {   
            //Check if user inputed the correct file type
            $wanted = array('xlsx');
            $check_extension = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array($check_extension, $wanted))
            {
                printer("You have inputed the wrong file type <br>", $file_specifier);
                printer("Wanted file type: xlsx(excel)",  $file_specifier);
                $file = NULL;
            }else
            {
                //Incude excel_parser class
                require_once __DIR__.'/excel_parser_class.php';
                
                // $special_char = array("ą", "č", "ę", "ė", "į", "š", "ų", "ū", "ž", " ", "(", ")");
                // $correct_word = str_replace($special_char, "", $file);
                // $file = $correct_word;
                // echo $file;

                if ($excel = SimpleXLSX::parse($file))
                {
                    $rows = $excel->rows();
                }else
                {
                    printer('Cant parse!', $file_specifier);
                    return NULL;
                }
            
                $num_cols = 15;
                $num_rows = 200;

                $invalid_val = -1;
                $work_col_numb = $invalid_val;
                $mass_col_numb = $invalid_val;
                $measurement_col_numb = $invalid_val;
                $price_col_numb = $invalid_val;
                $queue_numb = $invalid_val;
                
                $crr_row_idx = 0;
                $jobs_found = 0;
                $jobs_array = [];

                printer('Starting! <br>', $file_specifier);
                //Start parsing
                foreach ($rows as $c)
                {   
                    // Exit causes
                    if ($crr_row_idx >= $num_rows)
                    {
                        printer("<br>Exited by reaching maxmimum number of rows! <br>",  $file_specifier);
                        break;
                    }
                    if ($c[1] == 'Iš viso')
                    {
                        printer("<br>Exited by reaching the conclusion! <br>",  $file_specifier);
                        break;
                    }

                    $summary = '';
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
                        printer("Found header! <br>",  $file_specifier);
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
                            printer('Header not found<br>',  $file_specifier);
                            continue;
                        }
                        $jobs_found++;
                        printer("<br>Found job $jobs_found! <br>",  $file_specifier);
                        
                        //Assign summary number
                        $summary = $c[0];

                        //Assign name variable
                        $name = $c[1];
                        if ($file_specifier == 1)
                        {
                            print_r($name);
                        }
                        printer('<br>', $file_specifier);
                        $next_row_idx = $crr_row_idx+1;
                        $next_row = $rows[$next_row_idx];

                        //Find and assign work variables
                        if ($next_row[0] == '' && $next_row[$work_col_numb] != '')
                        {
                            $work = $next_row[$work_col_numb];
                            $work_m = $next_row[$measurement_col_numb];
                            $work_price = $next_row[$price_col_numb];

                        }else
                        {
                            printer("No work data <br>",  $file_specifier);
                        }
                        
                        $next_row_idx++;
                        $next_row = $rows[$next_row_idx];

                        //Find and assign material variables
                        if ($next_row[0] == '' && $next_row[$mass_col_numb] != '')
                        {
                            $material = $next_row[1];
                            $mass = $next_row[$mass_col_numb];
                            $mass_m = $next_row[$measurement_col_numb];
                            $mass_price = $next_row[$price_col_numb];
                            
                        }else{printer("No material data <br>",  $file_specifier);}

                        //Insert into array
                        if ($work != '')
                        {
                            $new_jobs = ["line_num"=>$summary, "job_name"=>$name, "material_name"=>$material,
                                     "material_amount"=>$mass, "mass_unit"=>$mass_m, "mass_unit_price"=>$mass_price,
                                     "work_amount"=>$work, "work_unit"=>$work_m, "work_unit_price"=>$work_price];
                            array_push($jobs_array, $new_jobs);
                        }
                        
                            
                    }else{}
                    
                    
                    $crr_row_idx++;
                }

                // Prints out the array
                if ($file_specifier == 1)
                {
                    echo '<pre>';
                    print_r($jobs_array);
                    echo '</pre>';
                }

                printer( '<br>Finished!<br>',  $file_specifier);
                printer( 'Found '.$jobs_found.' jobs!<br>',  $file_specifier);
                return $jobs_array;
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
    <input type="file" name="estimate">
    <input type="submit" name="Submit">
</form>
<?php
    $input = $_FILES['estimate']['name'];
    if ($input)
    {
        parse_excel_file($input, 1);
    }
    
?>
</body>
</html>