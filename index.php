<!DOCTYPE html>
<html>
<head>

	<title>Explorateur de fichiers</title>
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" rel="stylesheet">
    <meta charset="utf-8">
    
</head>
<body>

<div class="container">
<section class="row">

<section id="clara" class="col-xs-2 col-lg-1">
 <p id="titre"><strong>Big-Dossier</strong></p>
    </section>
  
  <article  id="katsumi" class="col-xs-12 col-lg-8">
      
  
   
   <ul>
  
    <?php
       
        
        $url = "http://localhost/Explorateur-de-fichiers"; 
       
        $slash = "\\"; //L'antislash sert à échapper les caractères comme les guillemets, pour stocker un antislash dans les variables, on en mets 2
       
        $chemin = realpath("index.php"); //récupère le chemin réel du fichier
        $chemin = str_replace("index.php", "" , $chemin); //on enlève index.php du chemin pour avoir le chemin du dossier
       
        $cheminDeBase = $chemin;
       
                if(isset($_GET['filrouge']) && !empty($_GET["filrouge"])){
                    
                    $chemin = $chemin.$_GET['filrouge'].$slash; //Adresse du dossier.
                    $chemin = str_replace($slash.$slash, $slash, $chemin);
                }
                if(strpos($chemin,"..") != false){
                    echo $chemin."<br>";
                    die("Forbidden chemin");
                }
                $cheminAEnvoyer = str_replace($cheminDeBase, "",$chemin);
       
                    if(is_dir($chemin)){
                        $dir = scandir($chemin);
                    }

                            else{
                                die("Erreur : Le chemin demandé n'est pas un dossier");
                            }
                                    foreach ($dir as $key => $fichier):
                                        
                                        if($fichier !="." && $fichier != ".." && $fichier !="index.php"){
                                            
                                            if(is_dir($chemin.$fichier)){
                                                
                    echo "<div class='cadreDossiers'><i class='fa fa-folder-o fa-2x' aria-hidden='true'></i> <a href='".$url."?filrouge=".$cheminAEnvoyer.$fichier."'></br>".$fichier."</a></div></br>";
                                            }
                                            
                                            
                                            
                                        else if(is_file($chemin.$fichier)){
                    echo "<div class='cadreFichiers'><i class='fa fa-file fa-2x' aria-hidden='true'></i> <a target='_blank' href='".$url.$slash.$cheminAEnvoyer.$fichier."'></br>".$fichier."</a></div></br>";
                                        }
                                            else{
                                                echo "Type inconnu<br>";
                                            }
                                     }
       endforeach;
      
  echo '<div id = fildariane>';
        if(isset($_GET['filrouge']))
        {

            $adresse = $_GET['filrouge'];
            $adresse = str_replace($chemin,"",$adresse);


            $explorateur="Explorateur-de-fichiers";
            $k = "";
            $phrase= explode("\\",$adresse);
            $phrase = array_filter($phrase);

              echo '<a class="lien" href="?filrouge=">'.$explorateur.':<a/>';
            foreach ($phrase as $key => $mot)
            {
                if ($mot == end($phrase))
                  {

                  $k .= $mot;// on peut aussi marquer au $k = $k.$mot//
                  echo '<a class="lien" href="?filrouge='.$k.$slash.'"> '.$mot.' </a>';

                  }
                else
                {
                    $k .= $mot.$slash;
                    echo '<a class="lien"href="?filrouge='.$k.$slash.'"> '.$mot.'&#8594; </a>';

                }

            }
        }
    echo '</div>';
 
?> 
       </br>
       <div>
       <a id="precedent"  href="javascript:history.go(-1)">&lArr;</a><a id="suivant"  href="javascript:history.go(+1)">&rArr;</a>
     </div>
      
        </ul>
         
           
              
            </article>
     </section>
   </div> 
</body>
</html>