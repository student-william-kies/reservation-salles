<?php


class Calendrier extends Model
{
    public function showEventOnPlanning($day, $hour)
    {
        $query = $this -> pdo -> prepare('SELECT login,reservations.id,titre,description,debut,fin,id_utilisateur FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur WHERE DATE_FORMAT(debut, "%w") = :jour AND DATE_FORMAT(debut, "%k") = :heure');
        $query -> execute([
            "jour" => $day,
            "heure" => $hour
        ]);

        $result = $query -> fetch();

        if ($result && isset($_SESSION['id']))
        {
            $_GET['id'] = @$result['id'];

            if (isset($_SESSION['id']))
            {
                echo '<td style="background-color: dodgerblue;"><a style="color: #fff;" href="reservation.php?id=' . $_GET['id'] . '">' . $result['login'] . '<br>' . $result['titre'] . '</a></td>';
            }
            else
            {
                echo '<td style="background-color: dodgerblue; color: #fff; cursor: default;">' . $result['login'] . '<br>' . $result['titre'] . '</td>';
            }
        }
        else
        {
            echo '<td></td>';
        }
    }

    public function showClickEvent()
    {
        $id = $_GET['id'];

        $query = $this -> pdo -> prepare("SELECT titre, description, debut, fin FROM reservations WHERE id = :id");
        $query->execute([
            "id"=>$id
        ]);

        $result = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function showAllEvents()
    {
        $id = $_SESSION['id'];

        $query = $this -> pdo -> prepare("SELECT titre, description, debut, fin FROM reservations WHERE id_utilisateur = :id");
        $query->execute([
            "id"=>$id
        ]);

        $result = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteAllEvent()
    {
        $query = $this -> pdo -> prepare("DELETE FROM reservations");
        $query -> execute();
    }
}