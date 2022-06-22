<?php

$sales = [
    "ahmed" => ['jan' => 120, 'feb' => 140, 'mar' => 180],
    "ali" => ['jan' => 220, 'feb' => 240, 'mar' => 280],
    "mai" => ['jan' => 320, 'feb' => 340, 'mar' => 380],
];

//solution 1 manually 
$total_sales = 0;
$months_sales = [];
$max_sales = 0; 
$bestSeller = "";

foreach($sales as $name => $data){
    
    $sub_total = 0;
    echo "$name <br> ------ <br>";
    
    foreach($data as $month => $value){
        echo "$month : $value <br>";
        $sub_total += $value;

        if(isset($months_sales[$month])){
            $months_sales[$month] += $value;  
        }
        else{
            $months_sales[$month] = $value;  
        } 
    }
    echo "$name total = $sub_total";
    if($sub_total > $max_sales){
        $max_sales = $sub_total;
        $bestSeller = $name;
    }

    $total_sales += $sub_total;    
    echo "<hr>";
}
echo "total sales = $total_sales <br> <br>";     //printing total sales
echo "best Seller is $bestSeller with sales = $max_sales <br> <br>"; //printing best Seller

//printing total months sales
foreach($months_sales as $month => $value){
    echo "total $month sales = $value <br><br>";
}


// //solution2 using built-in functions
// $total_sales = 0;
// $max_sales = 0; 
// $bestSeller = "";

// foreach($sales as $name => $data){
    
//     $sub_total = 0;
//     echo "$name <br> ------ <br>";
    
//     foreach($data as $month => $value){
//         echo "$month : $value <br>";
//         $sub_total += $value;

//         if(isset($months_sales[$month])){
//             $months_sales[$month] += $value;  
//         }
//         else{
//             $months_sales[$month] = $value;  
//         } 
//     }
//     echo "$name total = $sub_total";
//     if($sub_total > $max_sales){
//         $max_sales = $sub_total;
//         $bestSeller = $name;
//     }

//     $total_sales += $sub_total;    
//     echo "<hr>";
// }
// echo "total sales = $total_sales <br> <br>";     //printing total sales
// echo "best Seller is $bestSeller with sales = $max_sales <br> <br>"; //printing best Seller


// //printing each month total sales
// $months_names = array_keys($sales["ahmed"]);

// foreach($months_names as $month){
    
//     $month_arr = array_column($sales, $month);
//     $month_total_sales = array_sum($month_arr);
//     echo "$month total sales = $month_total_sales <br>"; 
// }





