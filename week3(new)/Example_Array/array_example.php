<?php
/* 
    our example explanation:
    - we need to display the nested array in a table
    - add sum column 

    -hw : 
    1)get the best seller with value, 
    2)get total sum of sales 
    3)get sum of sales for each month
    4)print them in the last row

    -Solution : manually
*/
$sales = [
    "ali" => ["jan" => 8000, "feb" => 9000, "mar" => 12000],
    "dina" => ["jan" => 7000, "feb" => 12000, "mar" => 15000],
    "sara" => ["jan" => 9000, "feb" => 4000, "mar" => 11000],
    "mona" => ["jan" => 11000, "feb" => 8000, "mar" => 9000],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Array</title>
</head>

<body>
    <div class="container-fluid">

        <table class="table table-striped table-hover">
            <thead class="">
                <tr>
                    <th scope="col">NAME</th>
                    <th>JAN</th>
                    <th>FEB</th>
                    <th>MAR</th>
                    <th>Sum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $best_seller_value = 0;
                $best_seller_name = "";
                $total_sum = 0;
                $months_sales= [];
                foreach ($sales as $name => $sales_values) {
                    echo "<tr> <td>$name </td>";
                    $sum = 0;
                    foreach($sales_values as $month=> $value){
                        if(isset($months_sales[$month])){
                            $months_sales[$month] += $value; 
                        }else{
                            $months_sales[$month] = $value;
                        }
                        echo "<td>$value</td>";
                        $sum += $value;
                    }
                    if($sum > $best_seller_value){
                        $best_seller_value = $sum;
                        $best_seller_name = $name;
                    }
                    $total_sum += $sum;
                    echo "<td>$sum</td>";
                    echo"</tr>";
                }
                ?>

              <tr>
                  <th>&nbsp;</th>
                  <?php 
                    foreach($months_sales as $month_name=>$month_sales){
                        echo"<th>$month_sales</th>";
                    }
                  ?>
                  <th><?=$total_sum ?></th>
              </tr>  
            </tbody>
        </table>
        
        
        <h5 class="text-center"> <?= "Best Seller is $best_seller_name with total sales: $best_seller_value" ?></h5>
    </div>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>