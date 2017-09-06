<?php include 'head.php'; ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">

                 <?php //code d'insertion 
if (isset($_POST['btn-save'])) {
	# code...

$nom_liv       = $_POST['nom_liv'];
$email_liv     = $_POST['email_liv'];
$telephone_liv = $_POST['telephone_liv'];
$num_cni_liv   = $_POST['num_cni_liv'];
$date_ajou_liv = time();
$crud = new crud();
if ($crud->add_liv($nom_liv,$email_liv,$telephone_liv,$num_cni_liv,$date_ajou_liv)) {
 echo "string";
}
//mysql_query("INSERT INTO `livreurs` (`nom_liv`, `email_liv`, `telephone_liv`, `num_cni_liv`, `id_admin`, `date_ajou_liv`) VALUES ('".$nom_liv."', '".$email_liv."', '".$telephone_liv."', '".$num_cni_liv."', '".$_SESSION['userid']."', '".time()."' );");


}
?>

                 <div class="col-md-12">
                            <section class="panel">
                              <header class="panel-heading">
                              Ajouter un livreur
                              </header>
                              <div class="panel-body">
                                  <form class="form-horizontal tasi-form" method="POST" action="#">
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Nom du livreur</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" name="nom_liv">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">email du livreur</label>
                                          <div class="col-sm-10">
                                              <input type="email" class="form-control" name="email_liv">
                                              <!--span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span-->
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">numero de telephone</label>
                                          <div class="col-sm-10">
                                              <input type="number" class="form-control" name="telephone_liv">
                                              <!--span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span-->
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">numero CNI</label>
                                          <div class="col-sm-10">
                                              <input type="number" class="form-control" name="num_cni_liv">
                                             
                                          </div>
                                      </div>
                                  
                                       <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                          <div class="col-sm-10">

                                           <span class="help-block">Le mot de passe du livreur est " <i><u> livreur</u></i>" et lui seul poura le changer </span>
                                             <button type="submit" name="btn-save" class="form-control btn btn-primary"> Ajouter </button>
                                          </div>
                                      </div>
                                     
                                  </form>
                              </div>
                            </section>
                            </div>
                 
              <!-- row end -->
                 
              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>