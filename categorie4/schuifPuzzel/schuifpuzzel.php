<?php
	define("MAXDIEPTE", 14);
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
				if($s[$j*$k+$l] == ' '){
					$leegr = $j;
					$leegk = $l;
				}
			}
		}
		$opl = array();
		$s = trim(fgets(STDIN));
		for($j=0; $j<$r; $j++){
			for($l=0; $l<$k; $l++){
				$opl[$j][$l] = $s[$j*$k+$l];
			}
		}
	}
/*
	$nMoves = 0;
	function doMove($diepte, 
	{
		if($diepte<MAXDIEPTE){
			//Max diepte nog niet bereikt
			if(
		}
		return -1;
	}
 */
	function cmpArray($a1, $a2, $r, $k)
	{
		for($i=0; $i<$r; $i++){
			for($j=0; $j<$k; $j++){
				if($a1[$i][$j] != $a2[$i][$j]){
					return -1;
				}
			}
		}
		return 0;
	}
?>
