<?php

abstract class Model
{
    protected $pdo;

    /**
     * Connexion à la base de données
     *
     * Model constructor
     */
    public function __construct()
    {
        $this -> pdo = Database::getPdo();
    }
}