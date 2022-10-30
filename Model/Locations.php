<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */
namespace Console\Model;

use Console\Database\DbHandler;

class locations{
    /*
     * Initialize the property
    */
    private $location;
    private $table;
    public $dbHandler;
    private $results = [];
    

    public function __construct($location = "")
    {
        $this->location = $location;
        $this->results = [];
        $this->dbHandler = new DbHandler();
        $this->table = "ds_crud_locations";
    }

    public function set_location($location)
    {
        $this->location = $location;
    }

    public function get_location($location)
    {
        return $this->location;
    }

    public function check_if_id_exists($id)
    {
        $table = $this->table;
        $results = $this->dbHandler->check_id($id, $table);
        return $results;
    }

    public function get_all(){
        $sqlQuery = "SELECT DISTINCT `id`, `location` FROM " .$this->table. " WHERE 1";
        $results = $this->dbHandler->getresults($sqlQuery);
        return $results;
    }

    public function get_location_name_from_id($id)
    {
        $results = $this->check_if_id_exists($id);

        if ($results['status'] == "success") {
            $sqlQuery = "SELECT `location` FROM ".$this->table. " WHERE `id`=$id Limit 1";

            $results = $this->dbHandler->getresults($sqlQuery);
            if ($results['status'] == "success") {
                foreach ($results['data'] as $data) {                    
                    $this->location = $data['location'];
                }
            }
        }
        return $this->location;
    }

}