<!DOCTYPE html>
<html>
<head>
	<title>Explorateur de fichiers</title>

    <meta charset="utf-8">
    <title>Explorateur de fichiers PHP</title>
    
</head>
<body>
  
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
                                                
                                                echo "Dossier : <a href ='".$url."?filrouge=".$cheminAEnvoyer.$fichier."'>".$fichier."</a></br>";
                                            }
                                            
                                        else if(is_file($chemin.$fichier)){
                                            echo "Fichier : <a target='_blank' href='".$url.$slash.$cheminAEnvoyer.$fichier."'>".$fichier."</a></br>";
                                        }
                                            else{
                                                echo "Type inconnu<br>";
                                            }
                                     }
       endforeach;
       
    ?>
    </ul>
    
</body>
</html>