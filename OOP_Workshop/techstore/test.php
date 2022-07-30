<?php
/*

*/

// require_once("classes/Request.php");
// require_once("classes/Session.php");
// require_once("classes/Db.php");
// require_once("classes/Models/Product.php");
// require_once("classes/Models/Order.php");

// require_once("classes/Validation/ValidationRule.php");
// require_once("classes/Validation/Required.php");
// require_once("classes/Validation/Numeric.php");
// require_once("classes/Validation/Max.php");
// require_once("classes/Validation/Str.php");
// require_once("classes/Validation/Email.php");
// require_once("classes/Validation/Validator.php");



// // testing requset, session classes
// $request = new Request();
// $sess = new Session();
// echo $request->get('name');

// $sess->set('name', 'ahmed');
// echo $sess->get('name');

// echo $sess->has('name');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

// $sess->remove('name');
// var_dump($sess->has('name')) ; //false

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

/*******************************************************************************************/


//testing db class and product class
// $prod = new Product();

// $res = $prod->selectAll("id, name, price");
// $res = $prod->selectId(8, "id, name, price");
// $res = $prod->selectWhere("id > 5 ", "id, name, price");
// $res = $prod->selectWhere("id > 5 AND price < 6000 ", "id, name, price");
// $res = $prod->getCount();

// echo '<pre>';
// // print_r($res);
// var_dump($res);
// echo '</pre>';


//testing order class
// $ord = new Order();

// $res = $ord->selectAll();
// // $res = $ord->selectId(1);
// // $res = $ord->getCount();
// // $res = $ord->insert("name, phone", "'mohamed fawzy' ,'010345678' ");
// // $res = $ord->update("name = 'Mohammed Fawzy', email='mohamed@techstore.com'", 1);

// // $res = $ord->delete(1);




// echo '<pre>';
// // print_r($res);
// var_dump($res);
// echo '</pre>';

/******************************************************************************************/

// testing Validation classes
// $v = new Validator();
// $v->validate('age', '24', [
//     'required', 'numeric'
// ]);

// $v->validate('name', 'Ahmed', [
//     'required', 'str', 'max'
// ]);



// echo '<pre>';
// print_r($v->getErrors());
// // var_dump($res);
// echo '</pre>';



/******************************************************************************************/


//testing app.php:
require_once("app.php");

echo $request->get("name");