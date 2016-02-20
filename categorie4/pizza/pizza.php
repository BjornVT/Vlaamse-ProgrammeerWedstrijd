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
		$tot = 0;
		//Bij elk stuk eens beginnen
		//for($j=0; $j<$ndelen; $j++){
		$j = 0;
			$temp = $delen;
			$tot = $temp[$j];
			$temp[$j] = 0;
			eat($temp, $ndelen, $j, $tot);
			$max = $max < $tot ? $tot : $max;
		//}


		printf("%d\n", $max);

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
			$GLOBALS['tot'] = $tempTot > $GLOBALS['tot'] ? $tempTot : $GLOBALS['tot'];
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
			$GLOBALS['tot'] = $tempTot > $GLOBALS['tot'] ? $tempTot : $GLOBALS['tot'];
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
			$GLOBALS['tot'] = $tempTot > $GLOBALS['tot'] ? $tempTot : $GLOBALS['tot'];
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
			$GLOBALS['tot'] = $tempTot > $GLOBALS['tot'] ? $tempTot : $GLOBALS['tot'];
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

		for($i=$plaats; $i<$n && $i>=0; $i+=$richt){
			if($toestand[$i] != 0){
				$temp = $toestand[$i];
				$toestand[$i] = 0;
				return $temp;
			}
			if($i == 0){
				$i = $n - 1;
			}
			else if($i == $n - 1){
				$i = 0;
			}
		}
	}
?>
