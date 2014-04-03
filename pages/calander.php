 <?php   
$year = date("Y");
if(!isset($_GET['month'])) $monthnb = date("n");
else {
    $monthnb = $_GET['month'];
    $year = $_GET['year'];
    if($monthnb <= 0) {
        $monthnb = 12;
        $year = $year - 1;
    }
    elseif($monthnb > 12) {
        $monthnb = 1;
        $year = $year + 1;
    }
}
$day = date("w");
$nbdays = date("t", mktime(0,0,0,$monthnb,1,$year));
$firstday = date("w",mktime(0,0,0,$monthnb,1,$year));
 
//Replace the number of the day by its french name
$daytab[1] = 'Lundi';
$daytab[2] = 'Mardi';
$daytab[3] = 'Mercredi';
$daytab[4] = 'Jeudi';
$daytab[5] = 'Vendredi';
$daytab[6] = 'Samdi';
$daytab[7] = 'Dimanche';
 
//Build the calendar table
$calendar = array();
$z = (int)$firstday;
if($z == 0) $z =7;
for($i = 1; $i <= ($nbdays/5); $i++){
    for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){
        if($j < $z && ($j-$z+1+(($i*7)-7)) <= 0){
                $calendar[$i][$j] = null;
        }
        else {
            $calendar[$i][$j] = $j-$z+1+(($i*7)-7);            
        }
    }
}
 
//Replace the number of the month by its french name
switch($monthnb) {
    case 1: $month = 'Janvier'; break;
    case 2: $month = 'Fevrier'; break;
    case 3: $month = 'Mars'; break;
    case 4: $month = 'Avril'; break;
    case 5: $month = 'Mai'; break;
    case 6: $month = 'Juin'; break;
    case 7: $month = 'Juillet'; break;
    case 8: $month = 'Aout'; break;
    case 9: $month = 'Septembre';    break;
    case 10: $month = 'Octobre'; break;
    case 11:    $month = 'Novembre';    break;
    case 12:    $month = 'Decembre';    break;
}
?><article class="col2 pad_left1">

<div id="calendrier" class="left" >
    <table class="cal" cellspacing="1">
        <tr>
            <th><span class="linkcal"><a href="index.php?month=<?php echo $monthnb - 1; ?>&year=<?php echo $year; ?>">PREC</a></span></th>
            <th colspan="5" class="headcal"><?php echo($month.' '.$year);  ?></th>
            <th><span class="linkcal"><a href="index.php?month=<?php echo $monthnb + 1; ?>&year=<?php echo $year; ?>">SUIV</a></span></th>
        </tr>
        <?php
            echo('<tr>');
            for($i = 1; $i <= 7; $i++){
                echo('<th><a href="#">'.$daytab[$i].'</a></th>');
            }
            echo('</tr>');
            for($i = 1; $i <= count($calendar); $i++) {
                echo('<tr>');
                for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){
                if(($calendar[$i][$j])!=""){
                    //------------------
                    $date_test=($year.'-'.$monthnb.'-'.($j-$z+1+(($i*7)-7)));
       //             echo 'date'.$date_test.'<br>';
                    include 'conn.php';
                     $user_test=$_SESSION['user_id'];
     $req22 ="select rdv_fin,rdv_user,rdv_debut,rdv_libelle FROM rdv WHERE rdv_debut<='$date_test'and rdv_fin>='$date_test'and rdv_user='$user_test'";
     $req21="select evt_date,evt_user,evt_libelle FROM evenement WHERE evt_date='$date_test'and evt_user='$user_test'";
	$result21 = mysql_query($req21);
        $result22 = mysql_query($req22);
   
     
        if($rrep1=mysql_fetch_array($result21))
         {
            if($rrep2=mysql_fetch_array($result22))//casD
            {        
             if($j-$z+1+(($i*7)-7) ==date("j") && $monthnb == date("n") && $year == date("Y")) 
 {   echo('<th  class="current"><a href="index.php?v='.$date_test.'" id="toto2" class="info">'.$calendar[$i][$j].'<span>RENDEZ-VOUS:'.$rrep2['rdv_libelle'].'<br>EVENEMENT:'.$rrep1['evt_libelle'].'</span></a></th>');}
                else {echo('<th ><a href="index.php?v='.$date_test.'"id="toto2" class="info">'.$calendar[$i][$j].'<span>RENDEZ-VOUS:'.$rrep2['rdv_libelle'].'<br>EVENEMENT:'.$rrep1['evt_libelle'].'</span></a></th>');} 
            } 
            else//cas a
                {
                if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) 
 {   echo('<th  class="current"><a href="index.php?v='.$date_test.'" id="toto1" class="info">'.$calendar[$i][$j].'<span>EVENEMENT:'.$rrep1['evt_libelle'].'</span></a></th>');}
                else {echo('<th ><a href="index.php?v='.$date_test.'"id="toto1" class="info">'.$calendar[$i][$j].'<span>EVENEMENT:'.$rrep1['evt_libelle'].'</span></a></th>');} 
            }
            
                }else{
                      if($rrep2=mysql_fetch_array($result22))//casb
            {           
             if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) 
 {   echo('<th  class="current"><a href="index.php?v='.$date_test.'" id="toto"class="info">'.$calendar[$i][$j].'<span>RENDEZ-VOUS:'.$rrep2['rdv_libelle'].'</span></a></th>');}
                else {echo('<th ><a href="index.php?v='.$date_test.'"id="toto"class="info">'.$calendar[$i][$j].'<span>RENDEZ-VOUS:'.$rrep2['rdv_libelle'].'</span></a></th>');} 
            }
            else //cas rien
            {
                     if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) 
 {   echo('<th  class="current"><a href="#">'.$calendar[$i][$j].'</a></th>');}
                else {echo('<th ><a href="#">'.$calendar[$i][$j].'</a></th>');}    
            }
                    
                }
         
   
            //--------------------   
            mysql_free_result($result22);   mysql_free_result($result21);
            }
            else{
                 if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) 
 {   echo('<th  class="current"><a href="#">'.$calendar[$i][$j].'</a></th>');}
                else {echo('<th ><a href="#">'.$calendar[$i][$j].'</a></th>');}  
            }
                }
                echo('</tr>');
            }
       
   ?> </table>
    
</div>
</article> 