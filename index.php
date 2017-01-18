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
  <section id="boris"><fieldset>
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
                                                
                    echo "<div class='cadreDossiers'><i class='fa fa-folder-o fa-3x' aria-hidden='true'></i>: <a href='".$url."?filrouge=".$cheminAEnvoyer.$fichier."'></br>".$fichier."</a></div></br>";
                                            }
                                            
                                            
                                            
                                        else if(is_file($chemin.$fichier)){
                    echo "<div class='cadreFichiers'><i class='fa fa-file fa-2x' aria-hidden='true'></i>: <a target='_blank' href='".$url.$slash.$cheminAEnvoyer.$fichier."'></br>".$fichier."</a></div></br>";
                                        }
                                            else{
                                                echo "Type inconnu<br>";
                                            }
                                     }
       endforeach;

    ?>
       </br>
       <a id="precedent"  href="javascript:history.go(-1)"> 	&lArr; </a>
    </ul></fieldset>
    </section>
</body>
</html>