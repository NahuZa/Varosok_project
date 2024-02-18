<?php

class Osztaly{
    protected $mysqli;
        function __construct($host='localhost', $user='root', $password='', $db='csv_db 10')
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

        public function varosok($id)
        {
            $query="SELECT city,zip_code FROM citiescodes WHERE countyId=$id ORDER BY city";  

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getAbc($id): array
        {
            $makers = $this->varosok($id);
            $abc = [];
            foreach ($makers as $maker) {
                $ch = strtoupper($maker['city'][0]);
                if (!in_array($ch, $abc)) {
                    $abc[] = $ch;
                }
            }
    
            return $abc;
        }

        public function getCityByCh($ch): array
        {
            $query="SELECT city,zip_code FROM citiescodes WHERE city LIKE '$ch%' ORDER BY city";
            
            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getStats($id): array
        {
            $query = "SELECT megyeszekhely,lakossag,cimer,zaszlo FROM counties WHERE countyId = $id";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }
    
}

?>  