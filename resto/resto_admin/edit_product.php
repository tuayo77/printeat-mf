<?php include 'head.php'; ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">
<?php 





 ?>



<?php if(isset($_GET['id_prod']))
{
	$id_prod = intval($_GET['id_prod']);
 $crud = new crud();
 $req2 = $crud->get_prod($id_prod);

if(isset($_POST['btn-save']))
{
  $nom_prod = $_POST['nom_prod'];
$prix_prod = $_POST['prix_prod'];
$categorie_prod = $_POST['cat_prod'];
$desc_prod = $_POST['desc_prod'];
$photo_prod = $_POST['photo'];
if ($crud->update_prod($id_prod,$nom_prod,$prix_prod,$desc_prod,$categorie_prod,$photo_prod)) {
$msg = "<div class='alert alert-info'>
        <strong>WOW! </strong> vous avez modifier un produit <a href='home.php'>Retour</a>!
        </div>";
}else{
  $msg = "<div class='alert alert-danger'>
        <strong>OUPS! </strong> erreur lord de la modification du produit <a href='home.php'>retour</a>!
        </div>";
}}
?>

  <div class="col-md-12">
                            <section class="panel">
                              <header class="panel-heading">
                             modifier le produit
                             <p><?php
if(isset($msg))
{
  echo $msg;
}
?></p>
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
                                          <label class="col-sm-2 col-sm-2 control-label">prix du produit</label>
                                          <div class="col-sm-10">
                                              <input type="number" class="form-control" value="<?php echo $req2['prix_prod']; ?>" name="prix_prod">
                                              <!--span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span-->
                                          </div>
                                      </div>
                                      <div class="form-group">
                                      	<label class="col-sm-2 col-sm-2 control-label">categorie</label>
                                      		
                                      <div class="col-sm-10">
                                             <select class="form-control" name="cat_prod">
                                             	<option value="1">a manger</option>
                                             	<option value="2">a boire</option>
                                             </select>
                                          </div>
                                      </div> 
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">description</label>
                                          <div class="col-sm-10">
                                            <textarea class="form-control" name="desc_prod" value=""><?php echo $req2['description_prod']; ?></textarea>
                                          </div>
                                      </div>
                                     
                                      
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">photo</label>
                                          <div class="col-sm-10 ensembleAppli">
                                              <input type="file" class="form-control" id="champFile">
                                              <div id="resultat"></div>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                          <div class="col-sm-10">
                                             <button type="submit" name="btn-save" class="form-control btn btn-warning"> Modifier </button>
                                          </div>
                                      </div>
                                     
                                  </form>
                              </div>
                            </section>
                            </div>

<?php 
}
 ?>


                 
              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>