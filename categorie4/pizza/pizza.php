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
		getPiece($temp, $n, $plaats, -1);
		//Alice neemt links
		$ret = getPiece($temp, $n, $plaats, -1);
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
		getPiece($temp, $n, $plaats, -1);
		//Alice neemt rechts
		$ret = getPiece($temp, $n, $plaats, 1);
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
		getPiece($temp, $n, $plaats, 1);
		//Alice neemt links
		$ret = getPiece($temp, $n, $plaats, -1);
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
		getPiece($temp, $n, $plaats, 1);
		//Alice neemt rechts
		$ret = getPiece($temp, $n, $plaats, 1);
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
?>
