<?php include 'head.php'; ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">

                 <div class="alert alert-success"> attribuer cette commande</div>
             <?php if(isset($_GET['id_cmd']))
{
	$id_cmd = intval($_GET['id_cmd']);
 $crud = new crud();
if (isset($_POST['id_liv'])) {
	
$id_liv = $_POST['id_liv'];


if ($crud->attrib_com($id_cmd,$id_liv)) {
echo "";
}
//mysql_query("UPDATE  `commande` SET  `id_admin` = '".$_SESSION['userid']."',
//`id_liv` = '".$id_liv."', `etat_cmd` = '1' WHERE  `id_cmd` =  '".$id_cmd."' ");


}






   
	 ?>
                  <form method="POST" action="#">
                  <div class="form-group">
                                      	<label class="col-sm-2 col-sm-2 control-label">choisir le livreur</label>
                                      		
                                      <div class="col-sm-10">
                                             <select class="form-control" name="id_liv">
                                             <option value=""> selectionné un livreur </option>
                                             <?php $crud->get_liv(); ?>
                                               </select>
                                          </div>
                                      </div> 
                                      <?php } ?>
                                       <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                          <div class="col-sm-10">
                                             <button type="submit" class="form-control btn btn-success"> Attribuer </button>
                                          </div>
                                      </div>
                </form>                      
              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>