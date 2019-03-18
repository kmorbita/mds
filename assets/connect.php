<?php 
/**
 * 
 */
class Connect
{

    public function dbconnect()
    {
        try {
           $connect = new PDO('mysql:host=localhost;dbname=mds','root','');
           // $connect = new PDO("sqlsrv:Server=DESKTOP-QL8899M;Database=sample", "DESKTOP-QL8899M\Kinard Orbita", "Password");
           $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           $connect->exec("SET CHARACTER SET utf8");
       } catch (Exception $e) {
        die("Error" . $e->getMessage());
        echo "Cannot talk to database" . $e->getLine();
    }
    return $connect;
}
}
?>