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
    public $result = [];
    public $con = null;
    public $errors = [];

    public function __construct()
    {
        $this->con = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);

        if($this->con->connect_errno){
            $this->result['status'] = "error";
            $this->result['message']  = $this->con->connect_errno;
            die("Unable to connect database: " . $this->con->connect_errno);
        }else{
            $this->result['status'] = "success";
            $this->result['message']  = "Database connected successfully.";
        }
    }

    public function authenticate($supplied_host, $supplied_username, $supplied_password)
    {
        if($supplied_host == $this->db_host && $supplied_username == $this->db_username && $supplied_password == $this->db_password)
        {
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

    /**
    * Perform to retrieve table data in associative array
    *
    * Example usage:
    * echo $dbHandler->getResult( "SELECT `id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available` FROM `ds_crud_items` WHERE 1 ORDER BY date_added ASC" );
    *
    * @access public
    * @param string    
    * @return array
    *
    */
    public function getResult($sqlQuery)
    {
        $result = $this->con->query($sqlQuery);

        $no_of_rows = mysqli_num_rows($result);



        if($no_of_rows > 0){
            // Associative array
            $rowAssociative = $result->fetch_all(MYSQLI_ASSOC);

            // Free result set
            $result -> free_result();

            //echo "NO of rows 1 ".$no_of_rows;
            //die();
            
            // Return the result
            return $rowAssociative;
        } else {

            //echo "NO of rows 2 ".$no_of_rows;
            // die();

            $this->errors['status'] = "error";
            $this->errors['message'] = "Sorry! No records exists in the Db.";
            return false;
        }


    }
}