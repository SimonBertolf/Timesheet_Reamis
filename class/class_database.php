<?php

class class_database
{
    // User Daten
    private $host = 'localhost';
    private $user = 'root';
    private $pw = 'root';
    private $db = 'timesheet_reamis';
    public $mysql;

    // Funktionen
    public function __construct()
    {
        /// -------- Verbindungsaufbau --------
        $this->mysql = new mysqli($this->host, $this->user, $this->pw, $this->db);

        /// -------- Fehleranalyse --------
        if ($this->mysql === false) {
            die('Verbindungsfehler' . $this->mysql->connect_error . "<br />");
        } else if ($this->mysql->connect_error) {
            die('Fehler' . $this->mysql->connect_error . "<br />");
        }
    }

    public function close_connection()
    {
        /// -------- Verbindung trennen --------
        $this->mysql->close();
    }

}

