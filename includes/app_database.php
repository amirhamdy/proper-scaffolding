<?php

require_once( "app_config.php");
$GLOBALS = array('DB_CON' => NULL);

class MySQLDatabase {

    private $connection;
    private $db_select;
    public $last_query;
    protected $glob;

    function __construct() {
        global $GLOBALS;
        $this->glob = & $GLOBALS;
        $this->open_connection();
    }

    public function open_connection() {
        $this->glob['DB_CON'] = $this->connection     = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection) {
            die("Database connection failed: " . mysql_error());
        }
        $this->db_select = mysql_select_db(DB_NAME);
        if (!$this->db_select) {
            die("Database selection failed: " . mysql_error());
        }
    }

    public function close_connection() {
        if (isset($this->connection)) {
            mysql_close($this->connection);
            unset($this->connection);
        }
    }

    public function find_all($table_name) {
//        $sql          = "SELECT * FROM " . $table_name . " ORDER BY created_date DESC";
        $sql          = "SELECT * FROM " . $table_name;
        $result_set   = $this->query($sql);
        $object_array = array();
        while ($row          = $this->fetch_array($result_set)) {
            $object_array[] = ($row);
        }
        return $object_array;
    }

    public function find_by_id($table_name, $column_name, $id) {
        $sql        = "SELECT * FROM " . $table_name . " WHERE " . $column_name . " = $id LIMIT 1";
        $result_set = $this->find_by_sql($sql);
        return ($result_set) ? array_shift($result_set) : false;
    }

    public function find_by_sql($sql) {
        $result_set   = $this->query($sql);
        $object_array = array();
        while ($row          = $this->fetch_array($result_set)) {
            $object_array[] = ($row);
        }
        return !empty($object_array) ? ($object_array) : false;
    }

    public function insert($sql) {
        $affected_rows = $this->query($sql) ? $this->affected_rows() : 0;
        return ($affected_rows > 0) ? TRUE : false;
    }

    public function update($sql) {
        $affected_rows = $this->query($sql) ? $this->affected_rows() : 0;
        return ($affected_rows > 0) ? TRUE : FALSE;
    }

    public function delete($table_name, $column_name, $id) {
        $sql           = "DELETE FROM " . $table_name . " WHERE " . $column_name . " = $id ";
        $affected_rows = $this->query($sql) ? $this->affected_rows() : 0;
        return ($affected_rows > 0) ? TRUE : FALSE;
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
        //$stmt = $this->connection->prepare($sql);
        $stmt = $this->db_select->prepare($sql);

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
        $result           = mysql_query($sql, $this->connection);
        $this->confirm_query($result);
        return $result;
    }

    public function clean($value) {
        return mysql_real_escape_string(stripslashes(htmlentities($value)));
    }

    public function fetch_array($result_set) {
        return mysql_fetch_assoc($result_set);
    }

    public function num_rows($result_set) {
        return mysql_num_rows($result_set);
    }

    public function insert_id() {
        return mysql_insert_id($this->connection);
    }

    public function affected_rows() {
        return mysql_affected_rows($this->connection);
    }

    private function confirm_query($result) {
        if (!$result) {
            $output = "Database query failed: " . mysql_error($this->connection) . "<br /><br />";
            $output .= "Last SQL query: " . $this->last_query . "<br /><br />";
            die($output);
        }
    }

}

$database = new MySQLDatabase();
$db       = & $database;
?>