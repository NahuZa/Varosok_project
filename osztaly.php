<?php

class Osztaly{
    protected $mysqli;
        function __construct($host='localhost', $user='root', $password='', $db='csv_db 14')
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


        public function varosok()
        {
            $id = $_POST['megye-button'];
            echo $id;
            /*$query="SELECT city FROM cities WHERE countyId=$id";  

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);*/
        }
}

?>