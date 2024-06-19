<?php
require_once __DIR__."/../dao/MidtermDao.php";

class MidtermService {
    protected $dao;

    public function __construct(){
        $this->dao = new MidtermDao();
    }

    /** TODO
    * Implement service method to add content to database
    */
    public function input_data($data){
        // Validate data if necessary
        if (isset($data['country']) && isset($data['region']) && isset($data['city']) && isset($data['ip_address'])) {
            // Call DAO method to insert data
            $this->dao->input_data($data);
        } else {
            throw new Exception("Invalid input data");
        }
    }

    /** TODO
    * Implement service method for route /midterm/summary/@country
    */
    public function summary($country){
        if (empty($country)) {
            throw new Exception("Country parameter is required");
        }
        return $this->dao->summary($country);
    }

    /** TODO
    * Implement service method for route /midterm/encoded
    */
    public function encoded(){
        return $this->dao->encoded();
    }

    /** TODO
    * Implement service method for route /midterm/ip
    */
    public function ip($ip_address){
        if (empty($ip_address)) {
            throw new Exception("IP address parameter is required");
        }
        return $this->dao->ip($ip_address);
    }
}
?>
