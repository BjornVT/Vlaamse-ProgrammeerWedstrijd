<?php
	define("MAXDIEPTE", 14);
	$n = intval(trim(fgets(STDIN)));

	for($i=1; $i<=$n; $i++){
		$s = explode(' ', trim(fgets(STDIN)));
		$r = $s[0];
		$k = $s[1];

		$puzzel = array();
		$s = fgets(STDIN);
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
		$s = fgets(STDIN);
		for($j=0; $j<$r; $j++){
			for($l=0; $l<$k; $l++){
				$opl[$j][$l] = $s[$j*$k+$l];
			}
		}

		$minMove = MAXDIEPTE;
		doMove(0, $puzzel, $leegr, $leegk, -1);
		printf("%d\n", $minMove);

	}

	// 0 down
	// 1 up
	// 2 links
	// 3 rechts
	function doMove($diepte, $toestand, $leegr, $leegk, $richting)
	{
		if(($diepte <= MAXDIEPTE) && ($diepte < $GLOBALS['minMove'])){
			//Max diepte nog niet bereikt
			if(cmpArray($toestand, $GLOBALS['opl'], $GLOBALS['r'], $GLOBALS['k']) == 0)
			{
				//Een oplossing gevonden
				$GLOBALS['minMove'] = $GLOBALS['minMove'] > $diepte ? $diepte : $GLOBALS['minMove'];
				return;
			}
			
			if(($leegr > 0) && ($richting != 0)){
				//We kunnen naar boven schuiven
				$temp = $toestand;
				$temp[$leegr][$leegk] = $toestand[$leegr-1][$leegk];
				$temp[$leegr-1][$leegk] = chr(0x20);
				doMove($diepte+1, $temp, $leegr-1, $leegk, 1);
			}
			if(($leegr < ($GLOBALS['r']-1)) && ($richting != 1)){
				//Naar beneden schuiven die handel
				$temp = $toestand;
				$temp[$leegr][$leegk] = $toestand[$leegr+1][$leegk];
				$temp[$leegr+1][$leegk] = chr(0x20);
				doMove($diepte+1, $temp, $leegr+1, $leegk, 0);
			}
			if(($leegk > 0) && ($richting != 3)){
				//Naar links schuiven
				$temp = $toestand;
				$temp[$leegr][$leegk] = $toestand[$leegr][$leegk-1];
				$temp[$leegr][$leegk-1] = chr(0x20);
				doMove($diepte+1, $temp, $leegr, $leegk-1, 2);
			}
			if(($leegk < ($GLOBALS['k']-1)) && ($richting != 2)){
				//Naar rechts schuiven
				$temp = $toestand;
				$temp[$leegr][$leegk] = $toestand[$leegr][$leegk+1];
				$temp[$leegr][$leegk+1] = chr(0x20);
				doMove($diepte+1, $temp, $leegr, $leegk+1, 3);
			}
		 
		}
	}

	function cmpArray($a1, $a2, $r, $k)
	{
		for($i=0; $i<$r; $i++){
			for($j=0; $j<$k; $j++){
				if(!($a1[$i][$j] == $a2[$i][$j])){
					return -1;
				}
			}
		}
		return 0;
	}
?>
