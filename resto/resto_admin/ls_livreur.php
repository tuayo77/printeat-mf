<?php include 'head.php'; ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">

                <div class="list-group">
 						 <a href="#" class="list-group-item active">
   						 <h4 class="list-group-item-heading">Liste des livreurs</h4>
 						 </a>
			    </div> 
			    <div class="row">
			     <?php 
 $crud = new crud();
 $crud->view_liv();
 				 ?>
           </div>
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>