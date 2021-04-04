<?php
    //Function prints only if $file_specifier is set to 1
    function printer($f, $s)
    {
        if ($s == 1){echo $f;} 
    }

    function parse_excel_file($file, $file_specifier)
    {
        
        printer('Now parsing '.$file.' file!<br><br>', $file_specifier);
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
                $material_amoount_col_numb = $invalid_val;
                $measurement_col_numb = $invalid_val;
                $price_col_numb = $invalid_val;
                $amount = $invalid_val;
                $queue_numb = $invalid_val;
                $mecha1 = $invalid_val;
                $mecha2 = $invalid_val;
                
                $crr_row_idx = 0;
                $jobs_found = 0;
                $jobs_array = [];
                $estimate_sum_array = [];

                $task_group_name = '';
                $work_total_sum = '';
                $material_total_sum = '';
                $tools_total_sum = '';
                $tools2_total_sum = '';

                $expences1 = '';
                $expences2 = '';
                $expences3 = '';
                $profit = '';
                $total_income = '';
                $sum = '';

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
                    if ($total_income != '')
                    {
                        printer("<br>All data gathered successfully, exiting!<br>",  $file_specifier);
                        break;
                    }

                    
                    $summary = '';
                    $task_name = '';
                    $material_type = '';
                    $material_amount = '';
                    $material_units = '';
                    $material_unit_price = '';
                    $work_duration = '';
                    $work_units = ''; 
                    $work_amount = '';

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

                            // Find material_amoount column in the header
                            if (isset($c[$y]) && $c[$y] == 'Medžiagos')
                            {
                                $material_amoount_col_numb = $y;
                                continue;
                            }else{}

                            // Find amount column in the header
                            if (isset($c[$y]) && $c[$y] == 'Kiekis')
                            {
                                $amount = $y;
                                continue;
                            }else {}

                            // Find mechanism column in the header
                            if (isset($c[$y]) && $c[$y] == 'Mechanizmai')
                            {
                                $mecha1 = $y;
                                continue;
                            }else {}

                            // Find mechanism column in the header
                            if (isset($c[$y]) && $c[$y] == 'Irengimai')
                            {
                                $mecha2 = $y;
                                continue;
                            }else {}

                            // Find sum column in the header
                            if (isset($c[$y]) && $c[$y] == 'Suma')
                            {
                                $sum = $y;
                                continue;
                            }else {}

                        }
                    }

                    // Finds estimate sum info variables
                    if ($c[1] == 'Statinio statybos išlaidos'){
                        $work_total_sum = $c[$work_col_numb];
                        $material_total_sum = $c[$material_amoount_col_numb];
                        $tools_total_sum = $c[$mecha1];
                        $tools2_total_sum = $c[$mecha2];
                    }
                    
                    if ($c[2] == 'Statybvietės išlaidos'){$expences1 = $c[$sum];}
                    if ($c[2] == 'Pridėtinės išlaidos'){$expences2 = $c[$sum];}
                    if ($c[2] == 'Kita'){$expences3 = $c[$sum];}
                    if ($c[2] == 'Pelnas'){$profit = $c[$sum];}
                    if ($c[2] == 'Pridėtinės vertės mokestis'){$total_income = $c[$sum];}


                    // Check if variables have been assigned and put them into an array
                    if ($work_total_sum != '' && $total_income != ''){
                        $estimate_sum_info = ["work_total_sum"=>$work_total_sum, "material_total_sum"=>$material_total_sum,
                                                "tools_total_sum"=>$tools_total_sum, "tools2_total_sum"=>$tools2_total_sum,
                                                "expences1"=>$expences1, "expences2"=>$expences2, "expences3"=>$expences3,
                                                "profit"=>$profit, "total_income"=>$total_income];
                        array_push($estimate_sum_array, $estimate_sum_info);
                    }

                    // Finds the task group name variable
                    if ($work_col_numb != $invalid_val){
                        if (gettype($c[0]) == 'string'){
                            if ($c[0] == '' && $c[$work_col_numb] != '' && $c[$material_amoount_col_numb] != '' && $c[$mecha1] != ''){
                                $task_group_name = $c[1];
                            }
                        }
                    }

                    //Check if summaries first cell has a digit and if its a floating number
                    if ($crr_row_idx > $queue_numb && $c[0] == (float)$c[0] && is_numeric($c[0]))
                    {   
                        //Check if header was found
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
                        $task_name = $c[1];
                        $work_units = $c[$measurement_col_numb];
                        $work_amount = $c[$amount];
                        if ($file_specifier == 1)
                        {
                            print_r($task_name);
                        }
                        printer('<br>', $file_specifier);
                        $next_row_idx = $crr_row_idx+1;
                        $next_row = $rows[$next_row_idx];

                        //Find and assign work variables
                        if ($next_row[0] == '' && $next_row[$work_col_numb] != '')
                        {
                            $work_duration = $next_row[$amount];
                            //$work_price = $next_row[$price_col_numb];

                        }else
                        {
                            printer("No work data <br>",  $file_specifier);
                        }
                        
                        $next_row_idx++;
                        $next_row = $rows[$next_row_idx];

                        //Find and assign material variables
                        if ($next_row[0] == '' && $next_row[$material_amoount_col_numb] != '')
                        {
                            $material_type = $next_row[1];
                            $material_amount = $next_row[$amount];
                            $material_units = $next_row[$measurement_col_numb];
                            $material_unit_price = $next_row[$price_col_numb];
                            
                        }else{printer("No material data <br>",  $file_specifier);}

                        //Insert into array
                        if ($work_duration != '')
                        {
                            $new_jobs = ["task_group_name"=>$task_group_name, "line_num"=>$summary, "job_name"=>$task_name, "material_name"=>$material_type,
                                     "material_amount"=>$material_amount, "material_amoount_unit"=>$material_units, "material_amoount_unit_price"=>$material_unit_price,
                                     "work_amount"=>$work_amount,"work_unit"=>$work_units, "work_duration"=>$work_duration];
                            array_push($jobs_array, $new_jobs);
                        }
                        
                            
                    }else{}
                    
                    
                    $crr_row_idx++;
                }

                printer( '<br>Finished!<br>',  $file_specifier);
                printer( 'Found '.$jobs_found.' jobs!<br>',  $file_specifier);

                // Makes a new array, combining the previous 2 arrays
                

                // Prints out the array
                if ($file_specifier == 1)
                {
                    $group_array = [];
                    array_push($group_array, $jobs_array);
                    array_push($group_array, $estimate_sum_array);

                    echo '<pre>';
                    print_r($group_array);
                    echo '</pre>';

                    return $group_array;
                }else if ($file_specifier == 0){
                    return $jobs_array;
                }
            }
        }
    }
?>