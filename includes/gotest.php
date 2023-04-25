<?php

// Generate some JSON data
$data = array(
  'name' => 'John Doe',
  'age' => 42,
  'email' => 'johndoe@example.com'
);

// Convert the JSON data to a string
$jsonString = json_encode($data);

// Call the pdfgen.exe executable with the JSON data and HTML template as arguments
$command = ".\pdfgen.exe -templatep '{$jsonString}' gotest.gohtml";
$output = shell_exec($command);

// The generated PDF should be in the $output variable
// You can then send the PDF file to the user's browser
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="generated.pdf"');
echo $output;