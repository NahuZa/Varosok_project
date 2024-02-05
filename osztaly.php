<?php

class Osztaly{
    protected $mysqli;
        function __construct($host='localhost', $user='root', $password='', $db='csv_db 8')
        {
            $this->mysqli=new mysqli($host, $user, $password, $db);
            if ($this->mysqli->connect_errno)
            {
                throw new Exception($this->mysqli->connect_errno);
            }
        }

        function __destruct()
        {
            $this->mysqli->close();
        }

        public function counties(): array
        {
        $query="SELECT * FROM counties";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }
}

?>