<?php 
	//pyramids example
	for($i = 10; $i >= 1; $i--){
		
		for($k = 10-$i ; $k >= 1; $k--){
			echo "&nbsp ";
		}
		
		for($j = 1; $j < $i*2  ; $j++){
			echo "*";
		}
		echo "<br>";
	}


	echo "<hr>";

	//array sorting example
	$arr = array(10, 5, 20, 4, 1, 200);

	echo "array before Sort:";
	print_r($arr);
	$temp = null;
	$min = null;
	for($i = 0; $i < count($arr)-1; $i++){
		$min = $i;
		//determine the min in the iteration
		for($j=$i+1; $j <count($arr) ; $j++){
			if($arr[$j] < $arr[$min]){
				$min = $j; 
			}       
		} 
		//swap
		$temp = $arr[$i];
		$arr[$i] = $arr[$min];
		$arr[$min] = $temp;
	}
	echo "<br> <br>";
	echo "array After Sort:";
	print_r($arr);
