

     


  	<article class="col1">
				
           
				
				<div class="tabs_cont">
                                     
					<form id="form_1" action="index.php" method="post">
						<div class="bg">
							<div class="wrapper">
SAISI DES RENDEZ-VOUS								
      <pre>
Debut:<input type="text" name="date1" class="datepicker">
Fin:  <input type="text" name="date2" class="datepicker">	
CATEGORIE:<select name="cat">
               <?php
               include'conn.php';
              $req = "select * FROM categorie";
	$result = mysql_query($req);
               //$result = mysqli_query($conn, '* FROM categorie');
               while ($row = mysql_fetch_array($result))
                               {
                   
                        echo"<option >".$row['cat_libelle']."</option>";
                   
                   
               }
               mysqli_free_result($result);
               
            
               
               ?>
               
           </select>
           
LIBELLE:    
<textarea name="lib_rdv" rows="4" cols="20">
                          </textarea>
NOTE: <input type="text" name="rdv_note" value="" />
DEBUT:<select name="Hdeb">
               <option>8H-9H</option>
               <option>9H-10H</option>
               <option>10H-11H</option>
               <option>11H-12H</option>
               <option>12H-13H</option>
               <option>13H-14H</option>
               <option>14H-15H</option>
               <option>15H-16H</option>
               <option>16H-17H</option>
               <option>17H-18H</option>
               <option>18H-19H</option>
               <option>19H-20H</option>
           </select>
FIN:  <select name="Hfin">
               <option>8H-9H</option>
               <option>9H-10H</option>
               <option>10H-11H</option>
               <option>11H-12H</option>
               <option>12H-13H</option>
               <option>13H-14H</option>
               <option>14H-15H</option>
               <option>15H-16H</option>
               <option>16H-17H</option>
               <option>17H-18H</option>
               <option>18H-19H</option>
               <option>19H-20H</option>
           </select>										
<input class="button" type="submit" value="VALIDER" name="set_rdv" />	
							
    </pre>
</div>							
</form>
</div>
</article>