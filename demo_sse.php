<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
//$rezerwacje = rezerwacja_model->get_rezerwacje();

$time = date('r');
echo "data: The server time is: {$time}\n\n";
flush();
?>