  <?php  session_start();?>
<html lang="en">
<head>
<title>Agenda electronique</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>  
<script type="text/javascript" src="js/Myriad_Pro_600.font.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="jquery-ui-1.10.3.custom\development-bundle\themes\base\jquery-ui.css">
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>

 <script>
  $(function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script>
</head>
<body id="page1">

<div class="extra">
	<div class="main">
<!-- header -->
<div class="right"> <?php echo '<h3>bonjour &nbsp;&nbsp;'.$_SESSION['user_speudo'].'</h3>';?></div>
<div class="wrapper">
   <!--- <div class="left">    <h1><a href="" id="logo">Agenda électronique</a>Agenga </h1></div>--->
<div class="right">
	<div class="wrapper">
						<form id="search" action="index.php?var=44" method="post">
							<div class="bg">
								<input type="submit" class="submit" value="">
								<input type="text" name="recher"class="input">
							</div>
						</form>
					</div>				
<div class="wrapper">
  
<nav>
     
<ul id="top_nav">
<li><a href="index.php? var=16"><input class="button"  value="Reglages"  /></a></li>								
<li><a href="index.php? var=0"><input class="button"  value="Deconection"  /></a></li>
</ul>
</nav>
</div>	
</div>
</div>
<nav>
<ul id="menu">
<li><a href="index.php? var=11" class="nav1">Consulter Rendez-Vous</a></li>
<li><a href="index.php? var=12" class="nav2">Consulter Evenement </a></li>
<li><a href="index.php? var=13" class="nav3">New rendez-vous</a></li>
<li><a href="index.php? var=14" class="nav4">New evenement</a></li>
<li class="end"><a href="index.php? var=15" class="nav5">Recherche</a></li>
</ul>
</nav>
    <div id="corps1">
    <div id="corps11">

        <?PHP
        
include 'conn.php';
?> 
			<article class="col1">
<?php
if(isset($_GET['v']))
{extract($_GET);

   $user_test=$_SESSION['user_id'];
     $req22="select rdv_fin,rdv_user,rdv_debut,rdv_libelle,rdv_note,Hdeb,Hfin,rdv_categorie,rdv_id FROM rdv WHERE rdv_debut<='$v'and rdv_fin>='$v'and rdv_user='$user_test'";
     $req21="select evt_date,evt_user,evt_libelle,evt_categorie,evt_id FROM evenement WHERE evt_date='$v'and evt_user='$user_test'";
	
        $result22=mysql_query($req22);
         if($rrep1=mysql_fetch_array($result22))
         {$x=$rrep1['rdv_categorie'];
             $rep="select cat_libelle FROM categorie WHERE cat_id='$x'";
             $ll=mysql_query($rep);
             $l=  mysql_fetch_array($ll);
             ?><div class="toto55"><pre><br><?php
  
                                 echo'               <h4 class="button22"> RENDEZ-VOUS</h4><br>';
          
    echo'LIBELLE    :
	<textarea  rows="4" cols="20"readonly = "readonly">'.$rrep1['rdv_libelle'].'</textarea><br>'; 
    echo'NOTE       :<input type = "text" name = "" value = "'.$rrep1['rdv_note'].'" readonly = "readonly" /><br>';           
    echo'DEBUT      :<input type = "text" name = "" value = "'.$rrep1['rdv_debut'].'" readonly = "readonly" /><br>';      
    echo'FIN        :<input type = "text" name = "" value = "'.$rrep1['rdv_fin'].'" readonly = "readonly" /><br>';
    echo'HEURE DEBUT:<input type = "text" name = "" value = "'.$rrep1['Hdeb'].'" readonly = "readonly" /><br>';
    echo'heure fin  :<input type = "text" name = "" value = "'.$rrep1['Hfin'].'" readonly = "readonly" /><br>';
    echo'CATEGORIE  :<input type = "text" name = "" value = "'.$l['cat_libelle'].'" readonly = "readonly" /><br>';
    echo'<br>';
    echo'                            ';
    echo'<a href=index.php?sup='.$rrep1['rdv_id'].' onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce rendez-vous?\'));"><img src="images/sup.png" width="25" height="25" title="CLIQUER ICI POUR SUPRIMER" alt="supprimer"/></a>';
    ?></pre><br></div>

              <?php
         }$result21 = mysql_query($req21);
           if($rrep2=mysql_fetch_array($result21))
         {$x=$rrep2['evt_categorie'];
             $rep="select cat_libelle FROM categorie WHERE cat_id='$x'";
             $ll=mysql_query($rep);
             $l=  mysql_fetch_array($ll);
             echo'<br>';   ?><div class="toto55"><pre><br><?php 
                                 echo'<h4 class="button21">EVENEMENT</h4><br>';
         
  echo'  LIBELLE: 
  <textarea  rows="4" cols="20"readonly = "readonly">'.$rrep2['evt_libelle'].'</textarea><br>'; 
  echo'     DATE:<input type = "text" name = "" value = "'.$rrep2['evt_date'].'" readonly = "readonly" /><br>';      
  echo'CATEGORIE:<input type = "text" name = "" value = "'.$l['cat_libelle'].'" readonly = "readonly" /><br>';
  echo'                            ';
    echo'<a href=index.php?sup2='.$rrep2['evt_id'].' onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cette evenement?\'));"><img src="images/sup.png" width="25" height="25" title="CLIQUER ICI POUR SUPRIMER" alt="supprimer"/></a>';
    ?><br></pre><br></div>
              <?php
               
         }
        
}
?>
                        </article>
<?php

  
        
if(isset($_POST['validation']))
{
    
    extract($_POST);
    $exe=mysql_query("select *from user where user_pseudo='$log'and user_pass='$pass'");
    if(mysql_num_rows($exe)!=0)
    {$l=mysql_fetch_assoc($exe);
      
        $_SESSION['user_speudo']=$l['user_pseudo'];
        $_SESSION['user_id']=$l['user_id'];
   //     echo'bonjour'.$_SESSION['user_speudo'] ;
       // $_SESSION['profil']=$l['profil'];
        //if($_SESSION['profil']=="administrator")
        //{header("Location:pages/admin.php");
           //header("Location:admin.php");
        //}
        
    }
}

 if(isset($_GET['sup2']))
 {extract($_GET);
     include'conn.php';
    // DELETE FROM `evenement` WHERE `evenement`.`evt_id` = 3 LIMIT 1;
     mysql_query("DELETE FROM `evenement` WHERE `evenement`.`evt_id` ='$sup2'");
 }
  if(isset($_GET['sup']))
 {extract($_GET);
     include'conn.php';
    // DELETE FROM `evenement` WHERE `evenement`.`evt_id` = 3 LIMIT 1;
     mysql_query("DELETE FROM `rdv` WHERE `rdv`.`rdv_id` ='$sup'");
 }
if(isset($_GET['var']))
{
extract($_GET);


switch($var)
{
case 11:{
    if(isset($_SESSION['user_speudo']))
{
    include 'pages\view_rdv.php';
    // include 'pages\div_affiche.php';
    
}    else
{
    include 'pages\login.php';
    
}

}
break;
case 12:{
    if(isset($_SESSION['user_speudo']))
{include'pages\view_evt.php';}    else
{
    include 'pages\login.php';
    
}

}
break;
case 13:{
    if(isset($_SESSION['user_speudo']))
{include'pages\set_rdv.php';}    else
{
    include 'pages\login.php';
    
}

}
break;
case 14:{
    if(isset($_SESSION['user_speudo']))
{include'pages\set_evt.php';}    else
{
    include 'pages\login.php';
    
}

}
break;
case 15:{
    if(isset($_SESSION['user_speudo']))
{
        include'pages\recherche.php';
        
}    else
{
    include 'pages\login.php';
    
}

}
break;
case 16:
        {
    if(isset($_SESSION['user_speudo']))
{
        include'pages\reglage.php';
        
}    else
{
    include 'pages\login.php';
    
}

}
    
break;
case 20:
        {
    
include'pages\inscription.php';
}
    
break;
case 44:
        {
    if(isset($_SESSION['user_speudo']))
{
        include'conn.php';
        ?> 
			<article class="col1">
<?php
//$req = "SELECT * FROM site WHERE nom_site LIKE '%$requete%'"; 
//recher
   $user_test=$_SESSION['user_id'];
     $req22="select rdv_fin,rdv_user,rdv_debut,rdv_libelle,rdv_note,Hdeb,Hfin,rdv_categorie,rdv_id FROM rdv WHERE rdv_libelle LIKE '%$recher%'and rdv_user='$user_test'";
     $req21="select evt_date,evt_user,evt_libelle,evt_categorie,evt_id FROM evenement WHERE evt_libelle LIKE '%$recher%'and evt_user='$user_test'";
	
        $result22=mysql_query($req22);
        while($rrep1=mysql_fetch_array($result22))
         {$x=$rrep1['rdv_categorie'];
             $rep="select cat_libelle FROM categorie WHERE cat_id='$x'";
             $ll=mysql_query($rep);
             $l=  mysql_fetch_array($ll);
             ?><div class="toto55"><pre><br><?php
  
                                 echo'               <h4 class="button22"> RENDEZ-VOUS</h4><br>';
          
    echo'LIBELLE    :
	<textarea  rows="4" cols="20"readonly = "readonly">'.$rrep1['rdv_libelle'].'</textarea><br>'; 
    echo'NOTE       :<input type = "text" name = "" value = "'.$rrep1['rdv_note'].'" readonly = "readonly" /><br>';           
    echo'DEBUT      :<input type = "text" name = "" value = "'.$rrep1['rdv_debut'].'" readonly = "readonly" /><br>';      
    echo'FIN        :<input type = "text" name = "" value = "'.$rrep1['rdv_fin'].'" readonly = "readonly" /><br>';
    echo'HEURE DEBUT:<input type = "text" name = "" value = "'.$rrep1['Hdeb'].'" readonly = "readonly" /><br>';
    echo'heure fin  :<input type = "text" name = "" value = "'.$rrep1['Hfin'].'" readonly = "readonly" /><br>';
    echo'CATEGORIE  :<input type = "text" name = "" value = "'.$l['cat_libelle'].'" readonly = "readonly" /><br>';
    echo'<br>';
    echo'                            ';
    echo'<a href=index.php?sup='.$rrep1['rdv_id'].' onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce rendez-vous?\'));"><img src="images/sup.png" width="25" height="25" title="CLIQUER ICI POUR SUPRIMER" alt="supprimer"/></a>';
    ?></pre><br></div>

              <?php
         }$result21 = mysql_query($req21);
           while($rrep2=mysql_fetch_array($result21))
         {$x=$rrep2['evt_categorie'];
             $rep="select cat_libelle FROM categorie WHERE cat_id='$x'";
             $ll=mysql_query($rep);
             $l=  mysql_fetch_array($ll);
             echo'<br>';   ?><div class="toto55"><pre><br><?php 
                                 echo'<h4 class="button21">EVENEMENT</h4><br>';
         
  echo'  LIBELLE: 
  <textarea  rows="4" cols="20"readonly = "readonly">'.$rrep2['evt_libelle'].'</textarea><br>'; 
  echo'     DATE:<input type = "text" name = "" value = "'.$rrep2['evt_date'].'" readonly = "readonly" /><br>';      
  echo'CATEGORIE:<input type = "text" name = "" value = "'.$l['cat_libelle'].'" readonly = "readonly" /><br>';
  echo'                            ';
    echo'<a href=index.php?sup2='.$rrep2['evt_id'].' onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cette evenement?\'));"><img src="images/sup.png" width="25" height="25" title="CLIQUER ICI POUR SUPRIMER" alt="supprimer"/></a>';
    ?><br></pre><br></div>
              <?php
               
         }
        

?>
                        </article>
<?php
        
}    else
{
    include 'pages\login.php';
    
}

}
    
break;

case 0:{session_destroy();}break;
}


}
else{
      if(isset($_SESSION['user_speudo']))
{
      //  include'pages\calander.php';
        
}    else
{
    include 'pages\login.php';
    
}  
    
}

if(isset($_POST['set_rdv']))
{
    
    extract($_POST);
    if($date1>$date2)
    {
        echo 'la date de votre rendez-vous n est pas correct';
        include 'pages\set_rdv.php';
    }else{
        
         
               include'conn.php';
              // echo $cat;
               //$resultat = $mysqli->
           $req ="SELECT * FROM categorie WHERE cat_libelle='$cat' ";
$resultat=mysql_query($req);
               //$ligne = $resultat->fetch_assoc();
               //$ligne = $resultat->fetch_row();
               $ligne = mysql_fetch_assoc($resultat);
               // $ligne=fetch_array($resultat);
           //   $req = "select * FROM categorie WHERE cat_libelle=$cat";
	//$result = mysql_query($req);
               //$result = mysqli_query($conn, '* FROM categorie');
               
                   
                      // $cate=$row['cat_id'];
                        
              
               $aa=$_SESSION['user_id'];
             //  echo$ligne['cat_id'];   
               
   @list($jour,$mois,$annee)=explode('/',$date1);
    $dat1=date("Y-m-d", strtotime($date1));
    @list($jour,$mois,$annee)=explode('/',$date2);
    $dat2=date("Y-m-d", strtotime($date2));

             
              $qq=$ligne['cat_id'];
              //echo $Hdeb;
   $req="insert into rdv values('', '$lib_rdv', '$rdv_note', '$dat1', '$dat2','$aa','$qq','$Hdeb','$Hfin')";
$exe=mysql_query($req);
if($exe){
//include 'pages\calander.php';
}
               
               
    }
}if(isset($_POST['set_evt']))
{ extract($_POST);
//echo'dsfvsdvsdvds';
        include 'conn.php';
    @list($jour,$mois,$annee)=explode('/',$date3);
    //$dat3=@date('Y-m-d',mktime($mois,$jour,$annee));
    //$dat3=$annee.'-'.$mois.'-'.$jour;
    $dat3=date("Y-m-d", strtotime($date3));
   
    $aa=$_SESSION['user_id'];
      $req ="SELECT * FROM categorie WHERE cat_libelle='$cat' ";
$resultat=mysql_query($req);
              
               $ligne = mysql_fetch_assoc($resultat);
    $qq=$ligne['cat_id'];
    //echo $qq;
    $req1="insert into evenement values('', '$lib_evt', '$dat3', '$aa','$qq')";
$exe1=mysql_query($req1);
if($exe1){
   // include 'pages\calander.php';


}
else{
 //   echo 'pas insertion';
}
               
}
echo'</div><div id="corps12" class="left">';
?>
</div>
</div>
<?php	if(isset($_SESSION['user_speudo'])){
include 'pages\calander.php';
}

if(isset($_POST['new-user']))
{
    extract($_POST);
    include 'conn.php';
     $req ="select user_pseudo,user_pass FROM user WHERE user_pseudo='$po'or user_pass='$pw'";
     
	$result = mysql_query($req);
         if(mysql_fetch_array($result))
         {echo'login exist deja';
             include 'pages\inscription.php';
         }
     
         else{    
            $req11="insert into user values('','$po','$pw')";
$exe11=mysql_query($req11);

        
          } 
            
    //if()
}
?>
</div>

<!-- / header -->
<!-- content -->

<!-- / content -->
</div>
<div class="block"></div>

<div class="body1">
    

    
<!-- footer -->
<footer>
 designed by  pape idy dieng <br>
papeidy@gmail.com
</footer>
<!-- / footer -->

</div>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>