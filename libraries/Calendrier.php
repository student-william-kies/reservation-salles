<?php


class Calendrier extends Model
{
    public function showEvents($day, $hour)
    {
        $query = $this -> pdo -> prepare('SELECT login,reservations.id,titre,description,debut,fin,id_utilisateur FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur WHERE DATE_FORMAT(debut, "%w") = :jour AND DATE_FORMAT(debut, "%k") = :heure');
        $query -> execute([
            "jour" => $day,
            "heure" => $hour
        ]);

        $result = $query -> fetch();
        //var_dump($result);
        if ($result)
        {
            $_GET['id'] = $result['id'];
            //var_dump($_GET);
            if (isset($_SESSION['id']))
            {
                echo '<td style="background-color: #005cbf;"><a style="color: #fff;yyy" href="reservation.php?id=' . $_GET['id'] . '">' . $result['login'] . '<br>' . $result['titre'] . '</a></td>';
            }
            else
            {
                echo '<td style="background-color: #005cbf; color: #fff;">' . $result['login'] . '<br>' . $result['titre'] . '</td>';
            }
        }
        else
        {
            echo '<td></td>';
        }
    }
}