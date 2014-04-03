
  <?php  session_start();?>
  <html><head><title>GESTION DES RDV</title>
  
  
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="jquery-ui-1.10.3.custom\development-bundle\themes\base\jquery-ui.css">
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>

 <script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
  </script>

</head>
<body >
<?php echo '<h3>bonjour :'.$_SESSION['user_speudo'].'</h3>';?>

    <div id="tete"><a  id="bye" href="index.php? var=0"><input type="button" value="DECONECTION" /></a> </div>
<div id="corps">
<div id="menu">
 <table>
     <tr><td><a href="index.php? var=11">consulter rendez-vous</a></td>
         <td><a href="index.php? var=12">consulter evenements</a></td>
         <td><a href="index.php? var=13">nouveau rendez-vous</a></td>
         <td><a href="index.php? var=14">nouvel evenement</a></td>
         <td><a href="index.php? var=15">rechercher</a></td>
         <td><a href="index.php? var=16">reglage</a></td>
</tr></table></div>
<div id="corps1">
    <div id="corps11">
<?PHP
include 'conn.php';


if(isset($_POST['validation']))
{
    
    extract($_POST);
    $exe=mysql_query("select *from user where user_pseudo='$log'and user_pass='$pass'");
    if(mysql_num_rows($exe)!=0)
    {$l=mysql_fetch_assoc($exe);
      
        $_SESSION['user_speudo']=$l['user_pseudo'];
        $_SESSION['user_id']=$l['user_id'];
        echo'bonjour'.$_SESSION['user_speudo'] ;
       // $_SESSION['profil']=$l['profil'];
        //if($_SESSION['profil']=="administrator")
        //{header("Location:pages/admin.php");
           //header("Location:admin.php");
        //}
        
    }
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
    

}
    
break;

case 0:{session_destroy();}break;
}}

if(isset($_POST['set_rdv']))
{
    
    extract($_POST);
    if($date1>$date2)
    {
        echo 'la date de votre rendez-vous n est pas correct';
        include 'pages\set_rdv.php';
    }else{
        
         
               include'conn.php';
               echo $cat;
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
               echo$ligne['cat_id'];   
               
   @list($jour,$mois,$annee)=explode('/',$date1);
    $dat1=@date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
    @list($jour,$mois,$annee)=explode('/',$date2);
    $dat2=@date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));

             
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
echo'dsfvsdvsdvds';
        include 'conn.php';
    @list($jour,$mois,$annee)=explode('/',$date3);
    $dat3=@date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
    $aa=$_SESSION['user_id'];
      $req ="SELECT * FROM categorie WHERE cat_libelle='$cat' ";
$resultat=mysql_query($req);
              
               $ligne = mysql_fetch_assoc($resultat);
    $qq=$ligne['cat_id'];
    echo $qq;
    $req1="insert into evenement values('', '$lib_evt', '$dat3', '$aa','$qq')";
$exe1=mysql_query($req1);
if($exe1){
   // include 'pages\calander.php';


}
else{
    echo 'pas insertion';
}
               
}
echo'</div><div id="corps12">';
if(isset($_SESSION['user_speudo'])){
include 'pages\calander.php';
}?>
</div>
</div>

</div>
<div id="pied"></div>

</body></html>
