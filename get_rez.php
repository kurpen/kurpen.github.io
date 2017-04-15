<?php

ob_start();
include('index.php');
ob_end_clean();
$CI =& get_instance();
$rezerwacje = $CI->rezerwacja_model->get_rezerwacje();
$CI->load->library(array('ion_auth','session'));
echo json_encode($rezerwacje);
?>