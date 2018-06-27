<?php

require_once( "app_config.php");

class MySQLDatabase {

    private $connection;
    public $last_query;

    function __construct() {
        $this->open_connection();
    }

    public function open_connection() {
        $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (!$this->connection) {
            die("Database connection failed: " . mysqli_error());
        }
    }

    public function close_connection() {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function find_all($table_name) {
        $sql          = "SELECT * FROM " . $table_name . " ORDER BY created_date DESC";
        $result_set   = $this->query($sql);
        $object_array = array();
        while ($row          = $this->fetch_array($result_set)) {
            $object_array[] = ($row);
        }
        return $object_array;
    }

    public function find_by_id($table_name, $column_name, $id) {
        $sql            = "SELECT * FROM " . $table_name . " WHERE " . $column_name . " = ? LIMIT 1";
        $params_type[0] = "i";
        $bind_params[0] = $id;
        $result_set     = $this->prepSelect($sql, $params_type, $bind_params);
        return !empty($result_set) ? array_shift($result_set) : false;
    }

    public function find_by_sql($sql, $params_type, $bind_params) {
        $result_set = $this->prepSelect($sql, $params_type, $bind_params);
        return !empty($result_set) ? ($result_set) : false;
    }

    public function insert($sql, $params_type, $bind_params) {
        $result = $this->prepSql($sql, $params_type, $bind_params);
        return ($result > 0) ? TRUE : FALSE;
    }

    public function delete($table_name, $column_name, $id) {
        $sql            = "DELETE FROM " . $table_name . " WHERE " . $column_name . " = ? ";
        $params_type[0] = "i";
        $bind_params[0] = $id;
        $result_set     = $this->prepSql($sql, $params_type, $bind_params);
        return ($result_set > 0) ? TRUE : FALSE;
    }

    public function update($sql, $params_type, $bind_params) {
        $result = $this->prepSql($sql, $params_type, $bind_params);
        return ($result > 0) ? TRUE : FALSE;
    }

    // insert delete update
    public function prepSql($sql, $params_types = array(), $bind_params = array()) {
        $a_params   = $a_data     = array();
        $param_type = '';
        $n          = count($params_types);
        for ($i = 0; $i < $n; $i++) {
            $param_type .= $params_types[$i];
        }
        $a_params[] = & $param_type;
        for ($i = 0; $i < $n; $i++) {
            $a_params[] = & $bind_params[$i];
        }
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            $output = 'Wrong SQL: ' . $sql . ' Error: ' . $this->connection->errno . '<br>';
            $output.=$this->connection->error;
            die($output);
        }
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
        if ($stmt->execute()) {
            return $stmt->affected_rows;
        } else {
            $output = 'Wrong SQL: ' . $sql . ' Error: ' . $this->connection->errno . '<br>';
            $output.= $this->connection->error;
            die($output);
        }
    }

    // Select
    public function prepSelect($sql, $params_types = array(), $bind_params = array()) {
        $a_params   = $a_data     = $result     = $row        = array();
        $param_type = '';
        $n          = count($params_types);
        for ($i = 0; $i < $n; $i++) {
            $param_type .= $params_types[$i];
        }
        $a_params[] = & $param_type;
        for ($i = 0; $i < $n; $i++) {
            $a_params[] = & $bind_params[$i];
        }
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->connection->errno . '<br>' .
                    $this->connection->error, E_USER_ERROR);
        }
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
        if ($stmt->execute()) {
            $meta  = $stmt->result_metadata();
            while ($field = $meta->fetch_field()) {
                $params[] = &$row[$field->name];
            }

            call_user_func_array(array($stmt, 'bind_result'), $params);

            while ($stmt->fetch()) {
                foreach ($row as $key => $val) {
                    $c[$key] = $val;
                }
                $result[] = $c;
            }
            return $result;
        } else {
            $output = 'Wrong SQL: ' . $sql . ' Error: ' . $this->connection->errno . '<br><br>';
            $output .= $this->connection->error;
            die($output);
        }
    }

    public function query($sql) {
        $this->last_query = $sql;
        $result           = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    public function escape_value($value) {
        $value = htmlentities($value);
        $value = stripslashes($value);
        $value = mysql_real_escape_string($value);
        return $value;
    }

    public function fetch_array($result_set) {
        return mysqli_fetch_assoc($result_set);
    }

    public function num_rows($result_set) {
        return mysqli_num_rows($result_set);
    }

    public function insert_id() {
        return mysqli_insert_id($this->connection);
    }

    public function affected_rows() {
        return mysqli_affected_rows($this->connection);
    }

    private function confirm_query($result) {
        if (!$result) {
            $output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";
            $output .= "Last SQL query: " . $this->last_query . "<br /><br />";
            die($output);
        }
    }

}

$database = new MySQLDatabase();
$db       = & $database;
?>