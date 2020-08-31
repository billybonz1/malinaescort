<?php
$allCSSFile='all.css';
ob_start("ob_gzhandler");
ini_set('zlib.output_compression', 1);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 7*86400) . ' GMT');
header('Cache-Control: public');
header("Content-type: text/css");

$lastModified=0;
if(file_exists($allCSSFile)){
    header('Last-modified: ' . gmdate('r', filemtime($allCSSFile)));
    echo file_get_contents($allCSSFile);
    exit();
}

$cssFiles = array('jquery-ui.css','slick.css','main.css','form.css','uploadify.css','colorbox.css');

$cssString = "";
foreach ($cssFiles as $cssFile) {
    $cssString .= file_get_contents($cssFile);
    $lastModified = max($lastModified, filemtime($cssFile));
}
header('Last-modified: ' . gmdate('r', filemtime($allCSSFile)));
// Remove comments
$cssString = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $cssString);

// Remove space after colons
$cssString = str_replace(': ', ':', $cssString);

// Remove whitespace
$cssString = str_replace(array("\r\n", "\r", "\n", "\t"), '', $cssString);

// Set the correct MIME type, because Apache won't set it for us

file_put_contents($allCSSFile,$cssString);
// Write everything out
echo($cssString);