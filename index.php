<?php
require_once 'classes/univDom.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add a student</title>
        <link href="styles/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
	    <img src="univAhmCity.png" style="width: 12%; height: auto;"/>

	    <div class="header">
	    <ul>
		    <li><a href="<?php echo $_SERVER['PHP_SELF']?>">Add student</a></li>
		    <li><a href="<?php echo $_SERVER['PHP_SELF'] . "?page=students" ?>">Students</a></li>
	    </ul>
	    </div>
		
		
		<?php
		//display either the form or the list of the students
		//we are using get
		if(isset($_GET['page']) && $_GET['page'] == 'students') {
			echo '<h1>Show students</h1>';
			include 'students.php';
		} else {
			echo '<h1>Add a student to the xml file.</h1>';
			include 'form.php';
			
		}
		
		
		?>
        
	
		
    </body>
</html>
