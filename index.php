<?php 

// This is a magic constant
require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$name = htmlspecialchars($_POST["name"]);
$quantity = htmlspecialchars($_POST["quantity"]);

$options = new Options;
$options->setChroot(__DIR__);

// Create a new Dompdf object and set the "chroot" option, 
// which restricts file access to the current directory and below. 
// This enhances security by preventing access to other system files.
$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "Landscape");

// Load the template HTML
$html = file_get_contents("template.html");

// Replace placeholders with actual values
$html = str_replace(["{{ name }}", "{{ quantity }}"], [$name, $quantity], $html);

// Using HTML and CSS
$dompdf->loadHtml($html);  

// This is the method to generate content
$dompdf->render();

$dompdf->addInfo("Title", "An Example PDF");

// This method sends the PDF to the browser, change the name and view
$dompdf->stream("example.pdf", ["Attachment" => 0]);
