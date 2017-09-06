<?php include 'head.php'; ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">
<div class="alert alert-warning"> modifier une commande </div>
                 


<?php if(isset($_GET['id_cmd']))
{
	$id_cmd = intval($_GET['id_cmd']);

/*if (isset($_POST['qte_prod'],$_POST['prix_prod'],$_POST['cat_prod'],$_POST['desc_prod'],$_POST['photo'])) {
	
$nom_prod = $_POST['nom_prod'];
$prix_prod = $_POST['prix_prod'];
$cat_prod = $_POST['cat_prod'];
$desc_prod = $_POST['desc_prod'];
$photo = $_POST['photo'];

mysql_query("UPDATE  `produits` SET  `nom_prod` =  '".$nom_prod."',
`prix_prod` =  '".$prix_prod."',
`description_prod` =  '".$desc_prod."',
`categorie_prod` =  '".$cat_prod."',
`photo_prod` =  '".$photo."' WHERE  `id_prod` =  '".$id_prod."' ");


}


*/



	
	$req1 = mysql_query("SELECT * 
FROM  ls_prod_cmd as l,produits as p where id_cmd='".$id_cmd."' and l.id_prod=p.id_prod");
while ($req2 = mysql_fetch_array($req1)) {

	 ?>

  <div class="col-md-12">
                            <section class="panel">
                              <header class="panel-heading">
                             modifier le produit
                              </header>
                              <div class="panel-body">
                                  <form class="form-horizontal tasi-form" method="POST" action="#">
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Nom du produit</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" value="<?php echo $req2['nom_prod']; ?>" name="nom_prod">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">quantité commander</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" value="<?php echo $req2['qte_prod']; ?>" name="nom_prod">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">prix du produit</label>
                                          <div class="col-sm-10">
                                              <input type="number" class="form-control" value="<?php echo $req2['prix_prod']; ?>" name="prix_prod">
                                              <span class="help-block">prix total  <?php echo $req2['qte_prod']*$req2['prix_prod']; ?> FCFA </span>
                                          </div>
                                      </div>      
                                       <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                          <div class="col-sm-10">
                                             <button type="submit" class="form-control btn btn-warning"> Modifier </button>
                                          </div>
                                      </div>
                                     
                                  </form>
                              </div>
                            </section>
                            </div>

<?php }
}
 ?>





              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>