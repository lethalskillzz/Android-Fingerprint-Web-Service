<?php

require_once 'Functions.php';
$func = new Functions();

// json response array
$response = array("error" => false);


$obj = file_get_contents('php://input');
$json_o=json_decode($obj);

 
if (isset($json_o->captureId) && isset($json_o->longitude) && isset($json_o->latitude) && isset($json_o->timeStamp)) {
	
      $res = $func->signOn($json_o->captureId,$json_o->longitude,$json_o->latitude,$json_o->timeStamp);
    
      if($res != OPERATION_FAILED) {
        
        $response["message"] = "Sign on successfull";
      
      }else {
        $response["error"] = true;
        $response["message"] = "Sign on failed";      
      }
         
} else {
        $response["error"] = true;
        $response["message"] = "Invalid parameters"; 
  }
            
echo json_encode($response);
