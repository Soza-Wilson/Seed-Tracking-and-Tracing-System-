<?php




class DbConnection
{
    /**
     * Host.
     *
     * @var string
     */
    protected $host;

    /**
     * UserName.
     *
     * @var string
     */
    protected $username;

    /**
     * Password.
     *
     * @var string
     */
    protected $password;
    /**
     * Database.
     *
     * @var string
     */
    protected $database;


    /**
     * Port.
     *
     * @var int
     */
    protected $port;

    private $con;


    function __construct()
    {

        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'seed_tracking_DB';
        $this->port = 3307;
    }

    public function connect()
    {

        try {

            // database connection
            $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->database, $this->port);
            return $this->con;
        } catch (\Throwable $th) {
            die("Connection failed :" . $th);
        }
    }
}
