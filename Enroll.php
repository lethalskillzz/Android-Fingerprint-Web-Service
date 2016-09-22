<?php

require_once 'Functions.php';
$func = new Functions();

// json response array
$response = array("error" => false);


$obj = file_get_contents('php://input');
$json_o=json_decode($obj);

 
if (isset($json_o->image) && isset($json_o->firstName) && isset($json_o->lastName) && isset($json_o->leftThumb) && isset($json_o->rightThumb)) {
	
      $res = $func->enrollUser($json_o->image, $json_o->firstName, $json_o->lastName, $json_o->leftThumb, $json_o->rightThumb);
    
      if($res != OPERATION_FAILED) {
        
        $response["message"] = "Enroll user successfull";
      
      }else {
        $response["error"] = true;
        $response["message"] = "Enroll user failed";      
      }
         
} else {
        $response["error"] = true;
        $response["message"] = "Invalid parameters"; 
  }
            
echo json_encode($response);
