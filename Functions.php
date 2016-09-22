<?php

class Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once(__DIR__.'/config/DbConnect.php');

        // connecting to database
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {}



    /**
     * Enrolling new users
     * @param String $image User's image
     * @param String $firstName User's first name
     * @param String $lastName User's last name
     * @param String $leftThumb User's left thumb fingerprint
     * @param String $rightThumb User's right thumb fingerprint
     */
    public function enrollUser($image, $firstName, $lastName, $leftThumb, $rightThumb) {

        $sql = $this->conn->prepare("insert into users (image, firstName, lastName, leftThumb, rightThumb)
         values ( '".$this->conn->real_escape_string($image)."', '".$this->conn->real_escape_string($firstName)."', '".$this->conn->real_escape_string($lastName)."', 
                  '".$this->conn->real_escape_string($leftThumb)."' '".$this->conn->real_escape_string($rightThumb)."')");

        $result = $sql->execute();
        //echo $sql->error;
        $sql->close();

        if ($result) {
            return OPERATION_SUCCESSFULL;
        }
        return OPERATION_FAILED;
    }



   /**
     * Signing on verified users
     * @param String $captureId foreign key
     * @param Double $longitude User's current longitude
     * @param Double $latitude User's current latitude
     * @param Double $timeStamp time of sign on
     */
    public function signOnUser($captureId, $longitude, $latitude, $timeStamp) {

        $sql = $this->conn->prepare("insert into sign_on (captureId, longitude, latitude, timeStamp)
         values ( '$captureId',  '$longitude', '$latitude', '$timeStamp')");
        $result = $sql->execute();
        //echo $sql->error;
        $sql->close();

        if ($result) {
            return OPERATION_SUCCESSFULL;
        }
        return OPERATION_FAILED;
    }

}