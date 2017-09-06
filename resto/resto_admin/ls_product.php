<?php include 'head.php'; ?>

                    <aside class="right-side">
 				
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <?php
$crud = new crud();
                $query = "SELECT * FROM  `produits` order by date_ajou desc ";
                $records_per_page=40;
      $newquery = $crud->paging($query,$records_per_page);
    $crud->view_prod($newquery);
?>
 </div>
 <p> <?php $crud->paginglink($query,$records_per_page); ?></p>
              <!-- row end -->
                </section><!-- /.content -->
               
                <div class="footer-main">
                    Copyright &copy Admin 2017
                </div>
            </aside><!-- /.right-side -->
<?php include 'foot.php'; ?>