<?php
	$n = intval(trim(fgets(STDIN)));

	for($i=1; $i<=$n; $i++){
		$s = explode(' ', trim(fgets(STDIN)));
		$r = $s[0];
		$k = $s[1];

		$puzzel = array();
		$s = trim(fgets(STDIN));
		for($j=0; $j<$r; $j++){
			for($l=0; $l<$k; $l++){
				$puzzel[$j][$l] = $s[$j*$k+$l];
			}
		}

		//print_r($puzzel);

		$opl = array();
		$s = trim(fgets(STDIN));
		for($j=0; $j<$r; $j++){
			for($l=0; $l<$k; $l++){
				$opl[$j][$l] = $s[$j*$k+$l];
			}
		}
		print_r($opl);

	}
?>
