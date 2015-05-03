<?php 
$actualPivot = 0.0;
$lastPivot = 0.0; 
$solucion = 0;
$ecs = "";
$incognitas = 0;
function main($ecss, $incogg) {
	global $ecs, $incognitas;
	$ecs = $ecss;
	$incognitas = $incogg;
	
	montante();
	
}
function intercambia($k, $pivot) {
	global $actualPivot, $ecs, $solucion;
	$encontroIntercambio = false;
	$temp = $ecs[$k];
	for ($i = $k; $i < sizeof($ecs); $i++) {
		if ($ecs[$i][$k] != 0 ) {
			$pivot = $ecs[$i][$k];
			$actualPivot = $pivot;
			$ecs[$k] = $ecs[$i];
			$ecs[$i] = $temp;
			$encontroIntercambio  = true;
		    $div = "<div class='intercambio table-responsive'>";
			$div .= "<h2>Starting Swap on iteration: ". ($k+1) . "</h2>";

			$div .= "<table class='table'>";
			$div .= "<thead><tr>";
			$div .= "<th>Equation / Variable </th>";

			for ($i = 0; $i < sizeof($ecs); $i++) {
				$div .= "<th class='text-center'> X".$i."</th>";
			}
			$div .= "<th class='text-center'> Coefficient</th>";
			$div .= "</tr></thead>";

			$div .= "<tbody>";
			for ($ii = 0; $ii < sizeof($ecs); $ii++) {
				$div .= "<tr>";
				$div .= "<td> Equation " . ($ii+1) . "</td>";
				for ($jj = 0; $jj <= sizeof($ecs); $jj++) {
					$div .= "<td class='text-center'>";
						$div .= $ecs[$ii][$jj];
					$div .= "</td>";
				}	
				$div .= "</tr>";
			}
			$div .= "</tbody>";

      		 $div .= "</table>";
			$div .= "<p>Swap Finished</p>";
			$div .= "</div>";
			echo $div;
			break;
		}
	}
	if ( !$encontroIntercambio ) {
		$div = "<div><p class='text-error text-center'>There is not a posible answer, since there are not available swaps</p></div>";
		echo $div;
		$solucion = 0;
		
	}
}


function haceCeros ($k, $pivot) {
		global $lastPivot, $ecs, $solucion;
        $lastPivot = $pivot;
        for ($i = 0; $i < sizeof($ecs); $i++) {
                for ($j = 0; $j <= $k; $j++) {
                        $ecs[$i][$j] = 0;
                        if ($i == $j ) $ecs[$i][$j] = $pivot;
                }
        }
        $div = "<div class='iteration table-responsive'>";
        $div .= "<h2 class='text-center'>Iteration: ".($k+1)."</h2>";
        $div .= "<table class='table'>";
        
		$div .= "<thead><tr>";
			$div .= "<th>Equation / Variable </th>";
			for ($i = 0; $i < sizeof($ecs); $i++) {
				$div .= "<th class='text-center'> X".$i."</th>";
			}
			$div .= "<th class='text-center'> Coefficient</th>";
		$div .= "</tr></thead>";

		$div .= "<tbody>";
        for ($i = 0; $i < sizeof($ecs); $i ++ ) {
        		
				$div .= "<tr>";
				$div .= "<td> Equation " . ($i+1) . "</td>";
                for ($j = 0; $j<= sizeof($ecs); $j++ ) {
					$div .= "<td class='text-center'>";
						$div .= $ecs[$i][$j];
					$div .= "</td>";
                }

				$div .= "</tr>";

        }
        $div .= "</tbody>";

        $div .= "</table>";
        $div .= "</div>";
        echo $div;
}

 function montante () {
 			global $ecs, $actualPivot, $incognitas, $lastPivot, $solucion;
            $i = 0;
            $j = 0;
            $k = 0;
            $lastPivot = 1;
            $solucion = 1;
            
            for ($k = 0; $k < $incognitas && $solucion == 1; $k++  ) {
                $actualPivot = $ecs[$k][$k];

                if ( !$actualPivot ) intercambia($k,$actualPivot);
                for ( $i = 0; $i < $incognitas; $i++) {

                    if ( $i == $k ) continue;
                    for ( $j = $k+1; $j < $incognitas+1; $j++ ) {
                    		
                            $ecs[$i][$j] = ($ecs[$k][$k]*$ecs[$i][$j] - ($ecs[$i][$k]*$ecs[$k][$j]));
                            $ecs[$i][$j] /= $lastPivot;
                            if ($j < $k) $ecs[$i][$j] = -$ecs[$i][$j];

                    }
                }
            haceCeros($k, $actualPivot);
            }
            for ( $i = 0; $i < $incognitas; $i++ ) {
                 if ( $ecs[$i][$i] == 0  )
                 {
                     if ( $ecs[$i][$incognitas] == 0) {

                         $solucion = 2;
                         break;
                     }
                     else
                     {
                         $solucion = 3;
                         break;
                     }
                 }
            }
            
            if ($solucion == 1) {
            	
                	$div = "<div class='final-result table-responsive'>";
                    $div .= "<h2 class='text-center'>Unique Solution</h2>";

                    $div .= "<table class='table'>";
					$div .= "<thead><tr>";
						$div .= "<th class='text-center'> Variable </th>";
						$div .= "<th class='text-center'> Solution</th>";
					$div .= "</tr></thead>";
					$div .= "<tbody>";
					for ($i = 0; $i < sizeof($ecs); $i++) {
						$div .= "<tr>";
						$div .= "<td class='text-center'> X".$i."</td>";
						$div .= "<td class='text-center'>".($ecs[$i][$incognitas]/$ecs[$i][$i])."</td>";
						$div .= "</tr>";
					}
					$div .= "</tbody>";
					$div .= "</table>";
                	$div .= "</div>";
            }
            else if ($solucion == 2) {
            	$div = "<div class='text-center'><h2>Infinite solutions found</h2></div>";
            }
            else if ( $solucion == 3) {
            	$div = "<div class='text-center'><h2>No solution found</h2></div>";
            }
            
            echo $div;
            die();
    }
