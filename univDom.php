<?php

/**
 * Class to generate an iut xml file containing students and modules
 */

class univ {
    
    private $dom;
    private $xmlFile;
    private $id;
    private $univ;

    public function __construct($xmlFile) {
        $this->xmlFile = $xmlFile;
        $this->dom = new DOMDocument('1.0', 'iso-8859-1');
        $this->dom->formatOutput = TRUE;
        $this->dom->preserveWhiteSpace = false;
        $this->univ = $this->dom->createElement('univ');
        $this->dom->appendChild($this->univ);
        $this->id = 1;
    }
    
    public function addStudent($name){
        $name = ucfirst(strtolower($name));
        
        $xpath = new DOMXPath($this->dom);
        $query = "//student[@name ='$name']";
        if($xpath->query($query)->length === 0) {
            $student = $this->dom->createElement('student');;
            $student->setAttributeNode(new DOMAttr('id', $this->id));
            $student->setAttributeNode(new DOMAttr('name', $name));
            $this->univ->appendChild($student);
            $this->id++;    
        } else {
            echo 'The student already exists in the xml file!';
            exit();
        }
    }
    
    public function addModule($studentName, $name, $duration, $mark) {
        $xpath = new DOMXPath($this->dom);
        $query = "//student[@name='$studentName']";
        $result = $xpath->query($query)->item(0);
        $module = $this->dom->createElement('module');
        $module->appendChild(new DOMElement('name', $name));
        $module->appendChild(new DOMElement('duration', $duration));
        $module->appendChild(new DOMElement('mark', $mark));
        $result->appendChild($module);
    }
  
    public function generate() {
        return $this->dom->save($this->xmlFile);        
    }
}
