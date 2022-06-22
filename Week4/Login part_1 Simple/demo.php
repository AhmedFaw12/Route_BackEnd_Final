<?php

$number="<h1>Ahmed@gmail.com</h1>";

var_dump(filter_var(filter_var($number, FILTER_SANITIZE_STRING), FILTER_SANITIZE_EMAIL));