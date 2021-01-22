<?php
/**
 * Chargement automatiques des instances de Class
 */
spl_autoload_register(function ($className)
{
    $className = str_replace("\\", "/", $className);

    require ("$className.php");
});