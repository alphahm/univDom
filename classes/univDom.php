<?php

/**
 * Class to generate an iut xml file containing students and modules
 */

//@todo Add the ability sort the names alphabetically

class univ {
    
    private $dom;
    private $xmlFile;
    private $id;
    private $univ;

    public function __construct($xmlFile) {
		$this->xmlFile = $xmlFile;

		if(file_exists($this->xmlFile) ) {
			$this->dom = new DOMDocument;
			$this->dom->load($this->xmlFile);
			//need to define id
			$numOfStudents = $this->dom->getElementsByTagName('student');
			$this->id = $numOfStudents->length - 1;
			$this->univ = $this->dom->getElementsByTagName('univ')->item(0);

		} else {
			$this->dom = new DOMDocument('1.0', 'iso-8859-1');
			$this->dom->formatOutput = TRUE;
			$this->dom->preserveWhiteSpace = false;
			$this->univ = $this->dom->createElement('univ');
			$this->dom->appendChild($this->univ);
			$this->id = 0;
		}
}
    
    public function addStudent($name){
        $name = ucfirst(strtolower($name));
        $student = $this->dom->createElement('student');;
		$student->setAttributeNode(new DOMAttr('id', $this->id));
		$student->setAttributeNode(new DOMAttr('name', $name));
		$this->univ->appendChild($student);
		$this->id++;
    }
    
    public function addModule($studentName, $name, $duration, $mark) {
        $xpath = new DOMXPath($this->dom);
        $query = "//student[@name='$studentName']";
		if($xpath->query($query)->length === 0) {
			$this->addStudent($studentName);
		}
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
