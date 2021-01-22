<?php

class Http
{
    /**
     * Redirige l'utilisateur vers $url
     *
     * @param string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header("location:$url");
        exit();
    }
}