<?php include 'head.php'; ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">
<?php //code d'insertion 
if(isset($_POST['btn-save']))
{
 $nom_prod = $_POST['nom_prod'];
$prix_prod = $_POST['prix_prod'];
$categorie_prod = $_POST['cat_prod'];
$description_prod = $_POST['desc_prod'];
$photo_prod = $_POST['photo'];
$date_ajou = time();
   $crud = new crud();
  if($crud->add_prod($nom_prod,$prix_prod,$description_prod,$categorie_prod,$photo_prod,$date_ajou))
  {
   echo ' <div class="container">
  <div class="alert alert-success">
    <strong> WOW! </strong>nouveau produit ajouté <a href="home.php">retour</a>!
  </div>
  </div>';
  }
  else
  {
    echo ' <div class="container">
  <div class="alert alert-danger">
    <strong> OUPS! </strong> erreur lord de l\'ajout du produit !
  </div>
  </div>';
  }
}


/*
if (isset($_POST['nom_prod'],$_POST['prix_prod'],$_POST['cat_prod'],$_POST['desc_prod'],$_POST['photo'])) {
	# code...



mysql_query("INSERT INTO `produits` (`nom_prod`, `prix_prod`, `description_prod`, `categorie_prod`, `photo_prod`, `date_ajou`) VALUES ('".$nom_prod."', '".$prix_prod."', '".$desc_prod."', '".$cat_prod."', '".$photo."', '".time()."' );");


}*/
?>

                 <div class="col-md-12">
                            <section class="panel">
                              <header class="panel-heading">

<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
  ?>
    <div class="container">
  <div class="alert alert-info">
    <strong>WOW!</strong>nouveau produit ajouté <a href="home.php">retour</a>!
  </div>
  </div>
    <?php
}
else if(isset($_GET['failure']))
{
  ?>
    <div class="container">
  <div class="alert alert-warning">
    <strong>OUPS!</strong> erreur lord de l'ajout du produit !
  </div>
  </div>
    <?php
}
?>

<div class="clearfix"></div><br />

                              Ajouter un produit
                              </header>
                              <div class="panel-body">
                                  <form class="form-horizontal tasi-form" method="POST" action="#">
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Nom du produit</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" name="nom_prod">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">prix du produit</label>
                                          <div class="col-sm-10">
                                              <input type="number" class="form-control" name="prix_prod">
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
                                            <textarea class="form-control" name="desc_prod"></textarea>
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
                                             <button type="submit" name="btn-save" class="form-control btn btn-primary"> Ajouter </button>
                                          </div>
                                      </div>
                                     
                                  </form>
                              </div>
                            </section>
                            </div>
                 
              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>