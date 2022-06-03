<?php
namespace Console\Model;

use Console\Database\DbHandler;

require('Database\DbHandler.php') ;

class CrudItems
{
    private $item_id;
    private $date_added;
    private $item_name;
    private $item_category;
    private $item_location;
    private $item_price;
    private $available;
    private $dbHandler;
    public $errors = [];
    public $result = [];

    /*
     * Initialize the property
     */

    public function __construct($item_id = "", $date_added = "", $item_name = "", $item_category = "", $item_location = "", $item_price = "", $available = "")
    {
        $this->item_id = $item_id;
        $this->date_added = $date_added == "" ? date("Y-m-d") : $date_added;
        $this->item_name = $item_name;
        $this->item_category = $item_category;
        $this->item_location = $item_location;
        $this->item_price = $item_price;
        $this->available = $available == "" ? 1 : $available;
        $this->dbHandler = new DbHandler();
        $this->errors = [];
        $this->result['status'] = "";
        $this->result['message'] = "";
    }

    public function set_item_id($item_id){
        $this->item_id = $item_id;
    }

    public function set_date_added($date_added){
        $this->date_added = $date_added;
    }

    public function set_item_name($item_name){
        $this->item_name = $item_name;
    }

    public function set_item_category($item_category){
        $this->item_category = $item_category;
    }

    public function set_item_location($item_location){
        $this->item_location = $item_location;
    }

    public function set_item_price($item_price){
        $this->item_price = $item_price;
    }

    public function set_available($available){
        $this->available = $available;
    }

    public function get_item_id(){
        return $this->item_id;
    }

    public function get_date_added(){
        return $this->date_added;
    }
    public function get_item_name(){
        return $this->item_name;
    }
    public function get_item_category(){
        return $this->item_category;
    }
    public function get_item_location(){
        return $this->item_location;
    }
    public function get_item_price(){
        return $this->item_price;
    }
    public function get_available(){
        return $this->available;
    }

    public function get_all(){
        $sqlQuery = "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE 1 ORDER BY `date_added`";
        $rowAssociative = $this->dbHandler->getResult($sqlQuery);
        return $rowAssociative;
    }

    public function get_id($id){
        
        
            $sqlQuery = "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE `id`=$id;";
            
            $rowAssociative = $this->dbHandler->getResult($sqlQuery);
           if($rowAssociative){
                foreach ($rowAssociative as $row) {
                    $this->item_id = $row['item_id'];
                    $date_added=date_create($row['date_added']);
                    $this->date_added = date_format($date_added,"Y-m-d");
                    $this->item_name = $row['item_name'];
                    $this->item_category = $row['item_category'];
                    $this->item_location = $row['item_location'];
                    $this->item_price = $row['item_price'];
                    $this->available = $row['available'];

                    // echo "1";
                    // die();
                }
           } else {
                $this->errors = $this->dbHandler->errors;
                // var_dump($this->dbHandler->errors);
                // echo "1";
                // die();
           }

             
    }

    /*
     * sanitize the data
     * validate the email
     * for non-validated email skip the entry
     * save to the database
     */

    public function save()
    {
        //$dbHandler = new DbHandler();

        if($this->dbHandler->result['status'] == "success"){
            $item_id = $this->dbHandler->sanitize($this->item_id);
            $date_added = $this->dbHandler->sanitize($this->date_added);
            $item_name = $this->dbHandler->sanitize($this->item_name);
            $item_category = $this->dbHandler->sanitize($this->item_category);
            $item_location = $this->dbHandler->sanitize($this->item_location);
            $item_price = $this->dbHandler->sanitize($this->item_price);
            $available = $this->dbHandler->sanitize($this->available);
    
            if($item_id){
                $stmt = $this->dbHandler->con->prepare("Insert into ds_crud_items(item_id, date_added, item_name, item_category, item_location, item_price, available) values (?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssss", $item_id, $date_added, $item_name, $item_category, $item_location, $item_price, $available);
                
                if($stmt->execute()){
                    $this->result['status'] = "success";
                    $this->result['message'] = "Data inserted successfully.";
                }else{
                    $this->result['status'] = "error";
                    $this->result['message']  = $stmt->error;
                }
            } 
        } else {
            $this->result['status'] = $this->dbHandler->result['status'];
            $this->result['message']  = $this->dbHandler->result['message'];
        }
    }
}
?>