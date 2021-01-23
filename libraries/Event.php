<?php
date_default_timezone_set('Europe/Paris');

class Event extends Model
{
    /**
     * 1. Création d'un nouvel évènement
     *
     * @throws Exception
     */
    public function newEvent()
    {
        if (isset($_SESSION['id']))
        {
            if (isset($_POST['reservation']))
            {
                $title = htmlspecialchars(trim(ucfirst($_POST['title'])));
                $desc = htmlspecialchars(trim(ucfirst($_POST['desc'])));

                $start = $_POST['start'];
                $end = $_POST['end'];

                $d = new DateTime($start);
                $d2 = new DateTime($end);

                $diff = $d -> diff($d2);
                $diffStr = $diff -> format('%H:%i:%s');

                if ($d -> format('w') == 6 || $d -> format('w') == 0 && $d2 -> format('w') == 6 || $d2 -> format('w') == 0)
                {
                    echo ("<section class='alert alert-danger' style='width: 20%; text-align: center; margin-left: 40%; margin-top: 5%; margin-bottom: -8%;' role='alert'>Vous ne pouvez réservez qu'en semaine.</section>");
                }
                elseif ($diffStr != '01:0:0')
                {
                    echo ("<section class='alert alert-danger' style='width: 20%; text-align: center; margin-left: 40%; margin-top: 5%; margin-bottom: -8%;' role='alert'>Vous ne pouvez réservez que pour 1 heure.</section>");
                }
                elseif ($d -> format('H:i:s') < '08:00:00' || $d -> format('H:i:s') > '19:00:00' && $d2 -> format('H:i:s') < '08:00:00' || $d2 -> format('H:i:s') > '19:00:00')
                {
                    echo ("<section class='alert alert-danger' style='width: 23%; text-align: center; margin-left: 39%; margin-top: 5%; margin-bottom: -8%;' role='alert'>Vous ne pouvez réserver qu'entre 8 heure et 19 heure.</section>");
                }
                else
                {
                    $query = $this -> pdo -> prepare("INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES (:titre, :description, :debut, :fin, :id_user)");
                    $query -> execute([
                        "titre" => $title,
                        "description" => $desc,
                        "debut" => $start,
                        "fin" => $end,
                        "id_user" => $_SESSION['id']
                    ]);

                    echo ("<section class='alert alert-success' style='width: 20%; text-align: center; margin-left: 40%; margin-top: 5%; margin-bottom: -8%;' role='alert'>Réservation effectuée. <a href='../users/planning.php' class='alert-link'>Voir ma réservation ?</a></section>");
                }
            }
        }
    }
}