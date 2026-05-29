
class Database{
    private $host = "localhost";
    private $db_name = "productos";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO(
                "mysql:host=". $this->host . 
                ";dbname=" .$this->db_name,
                $this->username,
                $this->password
            );
        } catch (PDOException $exception){
            echo "Error en la conexión a la base de datos: ". $exception->getMessage();
        }

        return $this->conn;
    }

}
?>