<?php

class Database
{
    private static $instance = null;
    /**
     * Retourne une connexion à la base de données
     *
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        if (self::$instance === null)
        {
            try
            {
                self::$instance = new PDO('mysql:host=localhost; dbname=reservationsalles', 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            }
            catch (PDOException $e)
            {
                die("Erreur : " . $e -> getMessage());
            }
        }

        return self::$instance;
    }
}