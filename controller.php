<?php		
	// default action for controlelr
	include 'models/montante.php';
	include 'models/loader.php';

	
	$action = "init";
	if(isset($_POST['action'])) {
		$action = $_POST['action'];
	}										
	if(isset($_GET['action'])) {
		$action = $_GET['action'];
	}										
	if(isset($_POST['ecs'])) {
		$ecs = json_decode($_POST['ecs']);
	}
	if(isset($_POST['incognitas'])) {
		$incognitas = $_POST['incognitas'];
	}
	switch ($action) {
		case 'montante':
			main($ecs, $incognitas);
            
		break;
		case 'init':
			$view = load_view();

			echo $view;
			break;
		default:
			echo "No action given";
		break;
	}
    
					
?>							
													
				
