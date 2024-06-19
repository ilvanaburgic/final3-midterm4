<?php
require_once "BaseDao.php";

class MidtermDao extends BaseDao {
    private $conn;
    public function __construct(){
        parent::__construct();
    }

    /** TODO
    * Implement DAO method used to add content to database
    */
    public function input_data($data){
        $sql = "INSERT INTO locations (country, region, city, ip_address) VALUES (:country, :region, :city, :ip_address)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':country', $data['country']);
        $stmt->bindParam(':region', $data['region']);
        $stmt->bindParam(':city', $data['city']);
        $stmt->bindParam(':ip_address', $data['ip_address']);
        $stmt->execute();
    }

    /** TODO
    * Implement DAO method to return summary as requested within route /midterm/summary/@country
    */
    public function summary($country){
        $sql = "SELECT region, COUNT(*) as count FROM locations WHERE country = :country GROUP BY region";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method to return list as requested within route /midterm/encoded
    */
    public function encoded(){
        $sql = "SELECT country, region, city, ip_address FROM locations";
        $stmt = $this->conn->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as &$row) {
            $row['ip_address'] = inet_ntop($row['ip_address']);
        }

        return $results;
    }

    /** TODO
    * Implement DAO method to return location(s) as requested within route /midterm/ip
    */
    public function ip($ip_address){
        $sql = "SELECT * FROM locations WHERE ip_address = :ip_address";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ip_address', $ip_address);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
