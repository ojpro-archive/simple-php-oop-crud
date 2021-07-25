<?php
// Include functions
require_once 'include/functions.php';
// Main CRUD Class
class Model
{
    // DataBase connection details
    private $db_host = "localhost";
    private $db_user = "admin";
    private $db_pass = "password";
    private $db_name = "php_practice_oop_crud";
    private $sdn;
    // Variable to store connection data
    private $connect;
    public function __construct()
    {
        // Store db info in sdn variable for easy edits
        $this->sdn = "mysql:dbname=$this->db_name;host=$this->db_host";
        // Try to connect
        try {
            // Use PDO class
            $this->connect = new PDO($this->sdn, $this->db_user, $this->db_pass);
            // if connected
            if ($this->connect) {
                // Create records table if not already exists
                $query = "CREATE TABLE IF NOT EXISTS records(
                    id int auto_increment primary key,
                    name varchar(30),email varchar(50) unique,
                    number varchar(16) , notes varchar(255))";
                $this->connect->prepare($query)->execute();
            }
        } catch (Exception $e) {
            // if can't connect display error message
            redirectTo($e->getMessage());
        }
    }
    // Function to check if fields are not empty
    public function checkFields(array $fields)
    {
        // Loop throught the fields array
        foreach ($fields as $field) {
            // Check if is not exists in POST's array and not empty
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                // Then return false
                return false;
            }
        }
        // Otherwise return true
        return true;
    }
    // Insertion function
    public function insert()
    {
        // check if save exists in POST's array
        if (isset($_POST["save"])) {
            // Then check the fields
            $checkFields = $this->checkFields(["name", "email", "number", "notes"]);
            // if return false
            if (!$checkFields) {
                // Display message and go home ;)
                redirectTo('Please fill all field.', 'index.php');
            }
            // Store POST data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $notes = $_POST['notes'];
            // Insertion query
            $query = "INSERT INTO records VALUES(NULL,'$name','$email','$number','$notes')";
            // Execute the query
            $save = $this->connect->prepare($query)->execute();

            if ($save) {
                // if done redirect to [view]
                redirectTo('Record added successfuly.', 'view.php');
            } else {
                // else show message and back home again :(.
                redirectTo('Something wrong!, PLease try again.', 'index.php');
            }
        }
    }
    // Update function
    public function update($id)
    {
        // check fields same as insert function
        if (isset($_POST["save"])) {
            $checkFields = $this->checkFields(["name", "email", "number", "notes"]);
            if (!$checkFields) {
                redirectTo('Please fill all field.', 'index.php');
            }
            // Store data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $notes = $_POST['notes'];
            // Update query
            $query = "UPDATE records SET name='$name', email='$email', number='$number', notes='$notes' WHERE id=$id";
            // Execute
            $save = $this->connect->prepare($query)->execute();
            // check if the query executed
            if ($save) {
                // if done redirect to item's page
                redirectTo('Record updated successfuly.', "item.php?id=$id");
            } else {
                // else show error message
                redirectTo('Something wrong!, PLease try again. ' . $query);
            }
        }
    }
    // fetch function
    public function fetch($id = "id")
    {
        // Select query stetment
        $query = "SELECT * FROM records WHERE id=$id";
        // Prepare
        $stmt = $this->connect->prepare($query);
        // Execute
        if ($stmt->execute()) {
            // if id exists fetch it's data
            if ($id != "id") {
                return $stmt->fetch();
            }
            // else fetch all columns
            return $stmt->fetchAll();
        }
        // Otherwise return false
        return false;
    }
    // Delete function
    public function delete($id)
    {
        // delete stetment
        $query = "DELETE FROM records WHERE id=$id";
        // if execution done without error
        if ($this->connect->exec($query)) {
            // Show succes message and go to view page
            redirectTo('Record deleted successfuly.', 'view.php');
            return true;
        }
        return false;
    }
}
