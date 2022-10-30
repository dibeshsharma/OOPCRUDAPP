<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */

namespace Console\Model;

use Console\Database\DbHandler;

class Categories{
    /*
     * Initialize the property
    */
    private $category;
    private $table;
    public $dbHandler;
    private $results = [];
    

    public function __construct($category = "")
    {
        $this->category = $category;
        $this->results = [];
        $this->dbHandler = new DbHandler();
        $this->table = "ds_crud_categories";
    }

    public function set_category($category)
    {
        $this->category = $category;
    }

    public function get_category($category)
    {
        return $this->category;
    }

    public function check_if_id_exists($id)
    {
        $table = $this->table;
        $results = $this->dbHandler->check_id($id, $table);
        return $results;
    }

    public function get_all(){
        $sqlQuery = "SELECT DISTINCT `id`, `category` FROM " .$this->table. " WHERE 1";
        $results = $this->dbHandler->getresults($sqlQuery);
        return $results;
    }

    public function get_category_name_from_id($id)
    {
        $results = $this->check_if_id_exists($id);

        if ($results['status'] == "success") {
            $sqlQuery = "SELECT `category` FROM ".$this->table. " WHERE `id`=$id Limit 1";

            $results = $this->dbHandler->getresults($sqlQuery);
            if ($results['status'] == "success") {
                foreach ($results['data'] as $data) {                    
                    $this->category = $data['category'];
                }
            }
        }
        return $this->category;
    }

}