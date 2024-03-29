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

        

        public function ujvarosok($countyId,$nev,$zipCode){

            $query="INSERT INTO citiescodes VALUES ('$countyId', '$nev', '$zipCode')";

            if ($this->mysqli->query($query) == TRUE) {
                echo "Az adatok sikeresen feltöltve.";
            }
            else {
                echo "Hiba az adatok feltöltése közben.". $this->mysqli->error;
            }
        }

        public function delete($id, $nev, $zipCode){
            $query=("DELETE FROM citiescodes WHERE countyId=$id AND city='$nev' AND zip_code=$zipCode");
 
            if ($this->mysqli->query($query) == TRUE) {
                echo "Az adatokat sikeresen töröltük.";
            }
            else {
                echo "Hiba az adatok törlése közben.". $this->mysqli->error;
            }
        }

        public function kereses($zipCode): array
        {
            $query = "SELECT * FROM citiescodes WHERE zip_code=$zipCode";
            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function keresMegye($countyId):array
        {
            $query = "SELECT county FROM counties WHERE countyId=$countyId";
            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }
    
        public function update($iranyitoszambe, $ujId, $ujVaros, $ujIranyotoszam){

            $query="UPDATE citiescodes SET countyId='$ujId', city='$ujVaros', zip_code='$ujIranyotoszam' WHERE zip_code=$iranyitoszambe";

            if ($this->mysqli->query($query) === TRUE) {
                echo "Az adatok sikeresen frissítve.\n";
            } else {
                echo "Hiba az adatok frissítése közben: " . $this->mysqli->error;
            }
        }

        public function ujMegye($nev,$megyeszekhely, $lakossag){

            $query="INSERT INTO counties (county,megyeszekhely,lakossag) VALUES ('$nev', '$megyeszekhely', $lakossag);";

            if ($this->mysqli->query($query) == TRUE) {
                echo "Az adatok sikeresen feltöltve.";
            }
            else {
                echo "Hiba az adatok feltöltése közben.". $this->mysqli->error;
            }
        }

        public function megyeKereses($string):array
        {
            $query = "SELECT * FROM counties WHERE county LIKE '%$string%'";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function megyeTorles($nev)
        {
            $query=("DELETE FROM counties WHERE county = '$nev'");
 
            if ($this->mysqli->query($query) == TRUE) {
                echo "Az adatokat sikeresen töröltük.";
            }
            else {
                echo "Hiba az adatok törlése közben.". $this->mysqli->error;
            }
        }

}

?>  