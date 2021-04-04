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
    error_reporting (E_ALL ^ E_NOTICE);
    //Incude excel_parser_function
    require_once __DIR__.'/excel_parser_function.php';
    
    $input = $_FILES['estimate']['name'];
    parse_excel_file($input, 1);
    
?>
</body>
</html>
