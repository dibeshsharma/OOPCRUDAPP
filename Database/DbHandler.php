<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */
namespace Console\Database;

use mysqli;

class DbHandler
{
    /*
     * Set your database credentials in this section
     */
    protected $db_host = 'localhost';
    protected $db_username = 'root';
    protected $db_password = '';
    protected $db_name = 'test';
    public $results = [];
    public $con = null;

    public function __construct()
    {
        $this->con = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);

        if ($this->con->connect_errno) {

            $this->results['mode'] = "Db Connection";
            $this->results['status'] = "error";
            $this->results['message']  = $this->con->connect_errno;
            die("Unable to connect database: " . $this->con->connect_errno);
        } else {
            $this->results['mode'] = "Db Connection";
            $this->results['status'] = "success";
            $this->results['message']  = "Database connected successfully";
        }
    }

    public function authenticate($supplied_host, $supplied_username, $supplied_password)
    {
        if ($supplied_host == $this->db_host && $supplied_username == $this->db_username && $supplied_password == $this->db_password) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Data sanitization and modification before inserting to the database
     */
    public function sanitize($data)
    {
        $data = $this->con->real_escape_string($data);
        $data = strtolower($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /*
     * To check if the email is in correct format
     */
    public function validateEmail($email)
    {
        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }

    public function check_id($id, $table){
        $sqlQuery = "SELECT id FROM ".$table." WHERE id = $id"; 
        $results = $this->con->query($sqlQuery);
        $no_of_rows = mysqli_num_rows($results);        
        if ($no_of_rows > 0) {
            $this->results['mode'] = "ID Check";
            $this->results['status'] = "success";
            $this->results['message'] = "The id exists";
        } else {
            $this->results['mode'] = "ID Check";
            $this->results['status'] = "error";
            $this->results['message'] = "The id does not exist";
        }
        return $this->results;
    }

    /**
     * Perform to retrieve table data in associative array
     *
     * Example usage:
     * echo $dbHandler->getresults( "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE 1 ORDER BY date_added ASC" );
     *
     * @access public
     * @param string    
     * @return array
     *
     */
    public function getresults($sqlQuery)
    {
        $results = $this->con->query($sqlQuery);
        $no_of_rows = mysqli_num_rows($results);

        if ($no_of_rows > 0) {
            // Associative array
            $rowAssociative = $results->fetch_all(MYSQLI_ASSOC);

            // Free results set
            $results->free_result();

            // Return the results
            $this->results['mode'] = "Db getresults";
            $this->results['status'] = "success";
            $this->results['message']  = "Data retrieved Successfully";
            $this->results['data'] = $rowAssociative;
        } else {
            $this->results['mode'] = "Db getresults";
            $this->results['status'] = "error";
            $this->results['message'] = "Sorry! No records exists in the Db"; 
            $this->results['data'] = null;           
        }
        return $this->results;
    }

    public function deleteRecord($sqlQuery)
    {
        $results = $this->con->query($sqlQuery);
        if($results){
            $this->results['mode'] = "delete";
            $this->results['status'] = "success";
            $this->results['message']  = "Data Deleted Successfully";
        } else {
            $this->results['mode'] = "delete";
            $this->results['status'] = "error";
            $this->results['message']  = "Data Not Deleted";
        }
        return $this->results;
    }
}
