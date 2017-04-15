<?php
ob_start();
include('index.php');
ob_end_clean();
$CI =& get_instance();
$CI->load->library(array('ion_auth','session'));
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'set_shown' : $CI->rezerwacja_model->set_shown($_POST['rez_id'],1); break;
		case 'get_rezerwacje' : $rezerwacje = $CI->rezerwacja_model->get_rezerwacje(); echo json_encode($rezerwacje); break;
		case 'potwierdz' : $CI->rezerwacja_model->zmien_status_rezerwacji($_POST['rez_id'],1); break;
		case 'odrzuc' : $CI->rezerwacja_model->zmien_status_rezerwacji($_POST['rez_id'],2); break;
		case 'get_godziny_day' : $CI->lokale_model->get_godziny_day($_POST['rest_id'], $_POST['column'], $_POST['open']); break;
    }
}
?>