<?php

// Load the main class
require_once 'HTML/QuickForm2.php';

// Instantiate the HTML_QuickForm2 object
$form = new HTML_QuickForm2('tutorial');

$name = $form->addElement('text', 'name')->setLabel('Student name:');
$module = $form->addElement('text', 'module')->setLabel('Module name:');
$duration = $form->addElement('text', 'duration')->setLabel('Duration:');
$mark = $form->addElement('text', 'mark')->setLabel('Mark:');

$form->addElement('submit', null, array('value' => 'Send!', 'class'=>'ahmed'));

// Define filters and validation rules
$name->addFilter('trim');
$name->addRule('required', 'Please enter name');
$module->addRule('required', 'Please enter module name');
$duration->addRule('required', 'Please enter duration');
$mark->addRule('required', 'Please enter mark');

// Try to validate a form
if ($form->validate()) {
				$univDom = new univ(__DIR__ . '/univ.xml');
				$univDom->addModule($name->getValue(), $module->getValue(), $duration->getValue(), $mark->getValue());
				$univDom->generate();
				echo '<div class="success"><img src="correct.png" /> Xml file generated and student added!</div>';
			}

// Output the form
echo $form;
