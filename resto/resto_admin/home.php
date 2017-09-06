<?php include 'head.php';
 ?>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">

<!-- header statistic --> 

                    <div class="row" style="margin-bottom:5px;">


                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-check-square-o"></i></span>
                                <div class="sm-st-info">
                                    <span>3200</span>
                                   nombre de commande(s) en attentes
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-envelope-o"></i></span>
                                <div class="sm-st-info">
                                    <span>2200</span>
                                     nombre de commande(s) en cour de livraison 
                                </div>
                            </div>
                        </div>
                       
                    </div>
<!-- fin header statistic-->

<!-- nouvelle commande --> 
<div class="alert alert-warning"> information sur les commandes </div>
<div class="row">
                <?php 
                $crud = new crud();
                $query = "select * from commande as c INNER JOIN clients as clt ON c.id_clt = clt.id_clt LEFT JOIN livreurs as l ON  c.id_liv = l.id_liv order by c.etat_cmd";
                $records_per_page=40;
      $newquery = $crud->paging($query,$records_per_page);
    $crud->view_cmd($newquery);

 ?>
              
</div>
<p> <?php $crud->paginglink($query,$records_per_page); ?></p>

<!-- fin nouvelle commande -->               
              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>