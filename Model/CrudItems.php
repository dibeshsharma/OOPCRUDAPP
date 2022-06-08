<?php
namespace Console\Model;

use Console\Database\DbHandler;

require('Database\DbHandler.php') ;

class CrudItems
{
    private $id;
    private $item_id;
    private $date_added;
    private $item_name;
    private $item_category;
    private $item_location;
    private $item_price;
    private $available;
    public $dbHandler;
    private $mode;
    public $errors = [];
    public $results = [];

    /*
     * Initialize the property
    */

    public function __construct($id = "", $item_id = "", $date_added = "", $item_name = "", $item_category = "", $item_location = "", $item_price = "", $available = "", $mode = "")
    {
        $this->id = $id;
        $this->item_id = $item_id;
        $this->date_added = $date_added == "" ? date("Y-m-d") : $date_added;
        $this->item_name = $item_name;
        $this->item_category = $item_category;
        $this->item_location = $item_location;
        // $this->item_price = $item_price;
        $this->item_price = number_format((float)$item_price, 2, '.', '');
        $this->available = $available == "" ? "yes" : $available;
        $this->dbHandler = new DbHandler();
        $this->mode = $mode;
        $this->errors = [];
        $this->results['status'] = "";
        $this->results['message'] = "";
    }

    public function set_id($id){
        $this->id = $id;
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
        $this->item_price = number_format((float)$item_price, 2, '.', '');
    }

    public function set_available($available){
        $this->available = $available;
    }

    public function set_mode($mode){
        $this->mode = $mode;
    }

    public function get_id(){
        return $this->id;
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

    public function get_mode(){
        return $this->mode;
    }

    public function get_all(){
        $sqlQuery = "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE 1 ORDER BY `date_added`";
        $rowAssociative = $this->dbHandler->getresults($sqlQuery);
        return $rowAssociative;
    }

    public function get_all_from_id($id){  
            $sqlQuery = "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE `id`=$id;";
            
            $rowAssociative = $this->dbHandler->getresults($sqlQuery);
           if($rowAssociative){
                foreach ($rowAssociative as $row) {
                    $this->id = $row['id'];
                    $this->item_id = $row['item_id'];
                    $date_added=date_create($row['date_added']);
                    $this->date_added = date_format($date_added,"Y-m-d");
                    $this->item_name = $row['item_name'];
                    $this->item_category = $row['item_category'];
                    $this->item_location = $row['item_location'];
                    $this->item_price = $row['item_price'];
                    $this->available = $row['available'];                    
                }                
           } else {
                $this->errors = $this->dbHandler->errors;
           }
    }

    /*
     * sanitize the data
     * validate the email
     * for non-validated email skip the entry
     * save to the database
     */

    public function save($id="null")
    {
        if($this->dbHandler->results['status'] == "success"){
            $item_id = $this->dbHandler->sanitize($this->item_id);
            $date_added = $this->dbHandler->sanitize($this->date_added);
            $item_name = $this->dbHandler->sanitize($this->item_name);
            $item_category = $this->dbHandler->sanitize($this->item_category);
            $item_location = $this->dbHandler->sanitize($this->item_location);
            $item_price = $this->dbHandler->sanitize($this->item_price);
            $available = $this->dbHandler->sanitize($this->available);

            if($available == "yes"){
                $available = 1;
            } else{
                $available = 0;
            }
            
            if($this->mode == "new"){
                if($item_id){
                    $stmt = $this->dbHandler->con->prepare("Insert into ds_crud_items(item_id, date_added, item_name, item_category, item_location, item_price, available) values (?,?,?,?,?,?,?)");
                    $stmt->bind_param("sssssss", $item_id, $date_added, $item_name, $item_category, $item_location, $item_price, $available);
                    
                    if($stmt->execute()){
                        $this->results['mode'] = "new";
                        $this->results['status'] = "success";
                        $this->results['message'] = "New Data inserted successfully.";

                    }else{
                        $this->results['mode'] = "new";
                        $this->results['status'] = "error";
                        $this->results['message']  = $stmt->error;
                    }
                    $this->results['id'] = $this->id;
                    $this->results['item_id'] = $this->item_id;
                    $this->results['date_added'] = $this->date_added;
                    $this->results['item_name'] = $this->item_name;
                    $this->results['item_category'] = $this->item_category;
                    $this->results['item_location'] = $this->item_location;
                    $this->results['item_price'] = $this->item_price;
                    $this->results['available'] = $this->available;
                } 

            } else if($this->mode == "edit"){
                
                if($item_id){
                    $stmt = $this->dbHandler->con->prepare("Update ds_crud_items set item_id = ?, date_added = ?, item_name =?, item_category = ?, item_location = ?, item_price = ?, available =? where id = $id;");
                    
                    $stmt->bind_param("sssssss", $item_id, $date_added, $item_name, $item_category, $item_location, $item_price, $available);
                    
                    if($stmt->execute()){
                        $this->results['mode'] = "edit";
                        $this->results['status'] = "success";
                        $this->results['message'] = "Data edited successfully.";
                    }else{
                        $this->results['mode'] = "edit";
                        $this->results['status'] = "error";
                        $this->results['message']  = $stmt->error;
                    }
                    $this->results['id'] = $this->id;
                    $this->results['item_id'] = $this->item_id;
                    $this->results['date_added'] = $this->date_added;
                    $this->results['item_name'] = $this->item_name;
                    $this->results['item_category'] = $this->item_category;
                    $this->results['item_location'] = $this->item_location;
                    $this->results['item_price'] = $this->item_price;
                    $this->results['available'] = $this->available;
                } 

            } else {
                $this->results['mode'] = "undefined";
                $this->results['status'] = "error";
                $this->results['message']  = "Mode is not defined.";
            }

        } else {
            $this->results['status'] = $this->dbHandler->results['status'];
            $this->results['message']  = $this->dbHandler->results['message'];
        }
    }

    public function deleteRecord($id){
        // To set the properties for the record
        $this->get_all_from_id($id);

        // Delete the item from the record
        $sqlQuery = "DELETE FROM `ds_crud_items` WHERE `id` = $id";        
        $this->dbHandler->deleteRecord($sqlQuery);        
        $this->results = $this->dbHandler->results;

        $this->results['id'] = $this->id;
        $this->results['item_id'] = $this->item_id;
        $this->results['date_added'] = $this->date_added;
        $this->results['item_name'] = $this->item_name;
        $this->results['item_category'] = $this->item_category;
        $this->results['item_location'] = $this->item_location;
        $this->results['item_price'] = $this->item_price;
        $this->results['available'] = $this->available = 1 ? "yes" : "no";
        return json_encode($this->results);
    }
}