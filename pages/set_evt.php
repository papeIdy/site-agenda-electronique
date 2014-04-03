

  	<article class="col1">
				
					
				
				<div class="tabs_cont">
					<form id="form_1" action="index.php" method="post">
						<div class="bg">
							<div class="wrapper">
	SAISI DES EVENEMENTS							
      <pre>
DATE:<input type="text" name="date3" class="datepicker">
	
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
<textarea name="lib_evt" rows="4" cols="20">
                          </textarea>


										
<input class="button" type="submit" value="VALIDER" name="set_evt" />	
							
    </pre>
</div>							
</form>
</div>
</article>