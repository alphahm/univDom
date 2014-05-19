<?php

$xmlFile = fopen("univ.xml", 'r');
$xmlFileText = fread($xmlFile, filesize("univ.xml"));
fclose($xmlFile);
$xmlFileText = preg_replace("/>\s+</", "><", $xmlFileText);

$dom = new DOMDocument;
$dom->loadXML($xmlFileText);

$students = $dom->getElementsByTagName('student');

foreach ($students as $student) {
   echo "Name of student: "
    . "{$student->attributes->getNamedItem('name')->nodeValue}<br/>";
    
    foreach ($student->childNodes as $modules) {
        echo ucfirst($modules->nodeName) . ' ';
        foreach ($modules->childNodes as $value) {
            echo "{$value->nodeName}: {$value->nodeValue} <br />";
        }
    echo '<br />';
    }
    echo '<br />';
}
