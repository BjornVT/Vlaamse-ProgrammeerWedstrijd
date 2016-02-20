<?php
	$n = intval(trim(fgets(STDIN)));

	for($i=1; $i<=$n; $i++){
		$s = explode(' ', trim(fgets(STDIN)));
		$ndelen = $s[0];
		$delen = array();
		for($j=0; $j<$ndelen; $j++){
			$delen[$j] = $s[$j+1];
		}






	function getPiece($toestand, $n, $plaats, $richt)
	{
		for($i=0; $i<$n && $i>=0; $i+=$richt){
			if($toestand[$i] != 0){
				$temp = $toestand[$i];
				$toestand = 0;
				return $temp;
			}
		}
		return -1;
	}
?>
