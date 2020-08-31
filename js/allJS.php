<?php
$allJSFile='all.js';
header('Cache-Control: must-revalidate');
header('Content-type: text/javascript');
ini_set('zlib.output_compression', 1);

if(file_exists($allJSFile)){
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 7*86400) . ' GMT');
    header('Last-modified: ' . gmdate('r', filemtime($allJSFile)));
    echo file_get_contents($allJSFile);
    exit();
}
if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('UTC');
}

$time = time()+(isset($_GET['e']) ? $_GET['e'] : 365)*86400;
header('Expires: '.gmdate('r', $time));

require_once '../protected/components/jsmin.php';
$out='';

$files=array('jquery-ui.min.js','jquery.maskedinput.js','AdminCard.js','slick.min.js','PaymentCard.js','uploadify/jquery.uploadify.min.js','jquery.colorbox-min.js','app.js');

foreach ($files as $f) {
    $fileRealPath = realpath($f);
    if (strpos($fileRealPath, realpath(dirname(__FILE__))) !== 0) {
        continue;
    }
    $out.=file_get_contents($fileRealPath)."\n";
    $lastModified = max($lastModified, filemtime($fileRealPath));
}
header('Last-modified: ' . gmdate('r', $lastModified));
//$js=JSMin::minify($out);
$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
//$out = str_replace(array("\r\n", "\r", "\n", "\t"), '', $out);
file_put_contents($allJSFile,$out);

echo $out;
