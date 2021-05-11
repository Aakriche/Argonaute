<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste d'argonautes</title>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>
<body>

<header>
  <h1>
    <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
    Les Argonautes
  </h1>
</header>

<!-- Main section -->
<main>
  
  <!-- New member form -->
  <h2>Ajouter un(e) Argonaute  <img src="./img/argo.png" alt="argonaute" /></h2>
  <form class="new-member-form" action="ext/AddMembre.ext.php" method="POST">
    <label for="name">Nom de l&apos;Argonaute *</label>
    <input id="name" name="name" type="text" placeholder="Charalampos" />
    <label for="qualite" > Qualité principale de l'Argonaute *</label>
    <input id="princ" name="princ" type="text" placeholder="Perspicace"/>
    <label for="qualite" > Qualité secondaire de l'Argonaute</label>
    <input id="sec" name="sec" type="text" placeholder="Affectueux"/><br/>
    <button type="submit" name="add-submit">Envoyer</button>
  </form>
  <?php   if (isset($_GET['error'])){
                            if($_GET['error']=="invalidnom"){
                                echo'<p class="msg-erreur">Ce n&apos;est pas un nom ça, ne te moque pas de moi !</p>';
                            } else if($_GET['error']=="invalidqualit"){
                                echo'<p class="msg-erreur">C&apos;est une qualité ça ?! Une effort je te prie</p>';
                            } else if($_GET['error']=="invalidprenom"){
                                echo'<p class="msg-erreur">Prenom invalide</p>';
                            } else if($_GET['error']=="usernametaken"){
                                echo'<p class="msg-erreur">Cet Argonaute est déjà sur la liste</p>';
                            }else if($_GET['error']=="fullargo"){
                              echo'<p class="msg-erreur">Il y a dejà 50 Argonautes, c&apos;est bien suffisant</p>';
                          }
                        }
  ?>
  <hr>
  <!-- Member list -->
  <h2>Membres de l'équipage</h2>
  
  <section class="member-list">
  <?php
    
    // PDO request
    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "wild";
    $searchSend = new PDO("mysql: host={$servername}; dbname={$dBName}",$dBUsername, $dBPassword);

                      // List Generation
            $searchResp = $searchSend->query("SELECT DISTINCT * FROM argonautes ORDER BY nom");
            while($donnees = $searchResp->fetch()) {
            
                
                    echo '<div class="h4Search"><p class="member-item">'
                    . '<span class="ArgoNom"> '
                    . ucfirst($donnees['nom'])
                    . '</span>  - ' 
                    . ucfirst($donnees['qualite_princ'])
                    . ' '
                    . ucfirst($donnees['qualite_sec'])
                    .'</div> ';
                    
                    
                 
            }

        ?>
        <div class="h4Search"></div>
        <div class="h4Search"></div>
  </section>
  
</main>

<footer>
  <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
</footer>

</body>
</html>