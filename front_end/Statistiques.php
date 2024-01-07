<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link  rel="stylesheet" href="style/global.css">
    <link  rel="stylesheet" href="style/stats.css">
</head>

<body>
    <header >

        <div class="navBar">
            <ul>
                <li><a href="index.html" class="navElement">Accueil</a></li>
                <li><a href="Usagers.php" class="navElement">Usagers</a></li>
                <li><a href="Consultations.php" class="navElement">Consultations</a></li>
                <li><a href="Médecins.php" class="navElement">Médecins</a></li>
                <li><a href="Statistiques.php" class="navElement">Statistiques</a></li>
            </ul>
        </div>

        <h1>Statistique des âges des usagers</h1>
        <div class="tableau">
        <?php
            require_once("../back_end/Objects/DbConfig.php");
            require_once("../back_end/Objects/Statistique.php");
            $statistique = new Statistique();
            $nbFemme = $statistique->getNbFemme();
            $nbHomme = $statistique->getNbHomme();
            $getNbHommeMoins25Ans = $statistique->getNbHommeMoins25Ans();
            $getNbFemmeMoins25Ans = $statistique->getNbFemmeMoins25Ans();
            $getNbHommeEntre25et50Ans = $statistique->getNbHommeEntre25et50Ans();
            $getNbFemmeEntre25et50Ans = $statistique->getNbFemmeEntre25et50Ans();
            $getNbHommePlus50Ans = $statistique->getNbHommePlus50Ans();
            $getNbFemmePlus50Ans = $statistique->getNbFemmePlus50Ans();
            
            $PrintAllNameMedecin = $statistique->PrintAllNameMedecinAndAllHours();

          echo '<table>
                  <tbody>
                      <tr>
                          <th scope="col">Tranche d\'âge</th>
                          <th scope="col">Nb Hommes</th>
                          <th scope="col">Nb Femmes</th>
                      </tr>
                      <tr>
                      <th scope="row">Total</th>
                        <td>' . $nbHomme[0] . '</td>
                        <td>' . $nbFemme[0] . '</td>
                      </tr>
                      <tr>
                          <th scope="row">Moins de 25 ans</th>
                          <td>' . $getNbHommeMoins25Ans[0] . '</td>
                          <td>' . $getNbFemmeMoins25Ans[0] . '</td>
                      </tr>
                      <tr>
                          <th scope="row">Entre 25 et 50 ans</th>
                          <td>' .$getNbHommeEntre25et50Ans[0] .'</td>
                          <td>' .$getNbFemmeEntre25et50Ans[0] .'</td>
                      </tr>
                      <tr>
                          <th scope="row">Plus de 50 ans</th>
                          <td>' . $getNbHommePlus50Ans[0] .'</td>
                          <td>' . $getNbFemmePlus50Ans[0] . '</td>
                      </tr>
                  </tbody>
              </table>';
?>
              <h1>Statistique Medecin</h1>
        <?php
        if ($PrintAllNameMedecin !== null) {
            echo '<table>
                <tbody>
                    <tr>
                        <th scope="col">Nom & Prenom</th>
                        <th scope="col">Nombres d\'heures réalisés</th>
                    </tr>';
            foreach ($PrintAllNameMedecin as $medecin) {
                echo '<tr>' . $medecin . '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo 'Aucun résultat trouvé.';
        }
        ?>

        </div>
    <header>
</body>

</html>