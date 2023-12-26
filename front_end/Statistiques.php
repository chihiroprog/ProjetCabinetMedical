<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <!-- <link  rel="stylesheet" href="style/global.css"> -->
    <link  rel="stylesheet" href="style/stats.css">
</head>

<body>
    <header >
        <div class="appName"> App </div>

        <div class="navBar">
            <ul>
                <li><a href="index.html" class="navElement">Accueil</a></li>
                <li><a href="Usagers.html" class="navElement">Usagers</a></li>
                <li><a href="Consultations.html" class="navElement">Consultations</a></li>
                <li><a href="Médecins.html" class="navElement">Médecins</a></li>
                <li><a href="Statistiques.html" class="navElement">Statistiques</a></li>
            </ul>
        </div>


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

          echo '<table>
                  <caption>Statistique des âges des usagers</caption>
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
                          <td>' . $getNbFemmePlus50Ans[0] .'</td>
                      </tr>
                  </tbody>
              </table>';

              echo '<table>
              <caption>Statistique Medecin</caption>
              <tbody>
                  <tr>
                      <th scope="col">Nom & Prenom</th>
                      <th scope="col">Nombres d\'heures réalisés</th>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                  </tr>
              </tbody>
          </table>';

        ?>

        </div>
    <header>
</body>

</html>