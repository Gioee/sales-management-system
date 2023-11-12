<?php

include('./inc/auth-check.php');

if(isset($_POST['search'])){

    require_once('./config.php');

    $user_input = trim($_POST['search']);
    $display_json = array();
    $json_arr = array();
    $user_input = preg_replace('/\s+/', ' ', $user_input);

    $query = 'SELECT CF FROM cliente WHERE CF LIKE "%' . $user_input . '%" LIMIT 25';

    if ($stmt = $mysqli->prepare($query)) {
        if($stmt->execute()){
            $ris = $stmt->get_result();

            while($t = $ris->fetch_row()){
                $json_arr[] = $t[0];
            }

            $jsonWrite = json_encode($json_arr);
            echo $jsonWrite;

        } else {
            return "Nessun cliente con questo CF";
        }
    }

}
