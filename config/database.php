<?php


namespace Config;

use PDO;
use PDOException;

class Database
{
    public function __construct(
        public string $db_host = '',
        public string $db_port = '5432',
        public string $db_name = '',
        public string $db_user = '',
        public string $db_pass = '',
        public null|PDO $query = null
    )
    {
        if (file_exists(APP_ROOT."/config/database.ini")) {
            $config = parse_ini_file(APP_ROOT."/config/database.ini");
            $this->db_host = $config['HOST'];
            $this->db_user = $config['USER'];
            $this->db_pass = $config['PASS'];
            $this->db_name = $config['NAME'];
        }
        $this
            ->setQuery();
    }

    /**
     */
    public function setQuery(): void
    {
        try {
            $this->query = new PDO("pgsql:host=$this->db_host;port=$this->db_port;dbname=$this->db_name;user=$this->db_user;password=$this->db_pass");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br />";
        }
    }

    /**
     * @return PDO
     */
    public function getQuery(): PDO
    {
        return $this->query;
    }
}