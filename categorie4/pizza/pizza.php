<?php
	$n = intval(trim(fgets(STDIN)));

	for($i=1; $i<=$n; $i++){
		$s = explode(' ', trim(fgets(STDIN)));
		$ndelen = $s[0];
		$delen = array();
		for($j=0; $j<$ndelen; $j++){
			$delen[$j] = $s[$j+1];
		}

		$max = 0;
		//Bij elk stuk eens beginnen
		for($j=0; $j<$ndelen; $j++){
			$temp = $delen;
			$tot = $temp[$j];
			$temp[$j] = 0;
			eat($temp, $ndelen, $j, $tot);
		}


		printf("max: %d\n", $max);

	}

	function eat($toestand, $n, $plaats, $tot)
	{
		//Mogelijkheid 1
		$temp = $toestand;
		//Bob neemt links
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret == -1){
			return;
		}
		//Alice neemt links
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret != -1){
			$tempTot = $tot + $ret;
			$GLOBALS['max'] = $tempTot > $GLOBALS['max'] ? $tempTot : $GLOBALS['max'];
			eat($temp, $n, $plaats, $tempTot);
		}
		else{
			return;
		}

		//Mogelijkheid 2
		$temp = $toestand;
		//Bob neemt links
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret == -1){
			return;
		}
		//Alice neemt rechts
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret != -1){
			$tempTot = $tot + $ret;
			$GLOBALS['max'] = $tempTot > $GLOBALS['max'] ? $tempTot : $GLOBALS['max'];
			eat($temp, $n, $plaats, $tempTot);
		}
		else{
			return;
		}

		//Mogelijkheid 3
		$temp = $toestand;
		//Bob neemt rechts 
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret == -1){
			return;
		}
		//Alice neemt links
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret != -1){
			$tempTot = $tot + $ret;
			$GLOBALS['max'] = $tempTot > $GLOBALS['max'] ? $tempTot : $GLOBALS['max'];
			eat($temp, $n, $plaats, $tempTot);
		}
		else{
			return;
		}

		//Mogelijkheid 4 
		$temp = $toestand;
		//Bob neemt rechts 
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret == -1){
			return;
		}
		//Alice neemt rechts
		$ret = getMaxSizePiece($temp, $n, $plaats);
		if($ret != -1){
			$tempTot = $tot + $ret;
			$GLOBALS['max'] = $tempTot > $GLOBALS['max'] ? $tempTot : $GLOBALS['max'];
			eat($temp, $n, $plaats, $tempTot);
		}
		else{
			return;
		}
	}

	function getPiece(&$toestand, $n, $plaats, $richt)
	{
		/**
		 * Functie om het eerste stuk in een bepaalde richting te verkrijgen.
		 * Wordt in deze opgave niet meer gebruikt
		 */

		$tot = 0;
		for($i=0; $i<$n; $i++) {
			$tot += $toestand[$i];
		}
		if($tot == 0){
			return -1;
		}

		$i=$plaats;
		while(true){
			if($toestand[$i] != 0){
				$temp = $toestand[$i];
				$toestand[$i] = 0;
				return $temp;
			}
			$i += $richt;
			if($i < 0){
				$i = $n-1;
			}
			else if($i >= $n){
				$i = 0;
			}
		}
	}

	function getMaxSizePiece(&$toestand, $n, $plaats)
	{
		/**
		 * Functie voor het grootste stuk te verkrijgen 
		 */

		$tot = 0;
		for($i=0; $i<$n; $i++) {
			$tot += $toestand[$i];
		}
		if($tot == 0){
			return -1;
		}

		//Het stuk link zoeken
		$i=$plaats;
		while(true){
			if($toestand[$i] != 0){
				$p1 = $i;
				break;
			}
			$i--;
			if($i < 0){
				$i = $n-1;
			}
		}

		//Het stuk rechts zoeken
		$i=$plaats;
		while(true){
			if($toestand[$i] != 0){
				$p2 = $i;
				break;
			}
			$i++;
			if($i >= $n){
				$i = 0;
			}
		}

		//Grootste stuk zoeken
		if($toestand[$p1] > $toestand[$p2]){
			$temp = $toestand[$p1];
			$toestand[$p1] = 0;
			return $temp;
		}
		else{
			$temp = $toestand[$p2];
			$toestand[$p2] = 0;
			return $temp;
		}

	}
?>
