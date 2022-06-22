<?php
/*
we want when the client register ,we will send to him welcome email

-in register_action.php : before going to index.php , send a welcome email

-we will make send_email.php to be a general usuable function/code and just change the parameters(from , to, host, username, password, port)

-in register_action.php :require send_email.php use the function send

*/