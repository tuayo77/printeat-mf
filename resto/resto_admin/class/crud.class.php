<?php
require_once('bd_class.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("select nom_admin,passe_admin,id_admin from admin WHERE nom_admin=:uname");
			$stmt->execute(array(':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				$passe_admin = md5($upass);
				if ($passe_admin == $userRow['passe_admin']) {
					

					$_SESSION['userid'] = $userRow['id_admin'];
					$_SESSION['username'] = $userRow['nom_admin'];
					return true;
				}
				/*if(password_verify($upass, $userRow['passe_admin']))
				{
					
					$_SESSION['userid'] = $userRow['id_admin'];
					$_SESSION['user_session'] = $userRow['nom_admin'];
					return true;
				}*/
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['userid']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['userid']);
		unset($_SESSION['user_name']);
		return true;
	}
}
class crud
{
	private $db;
	private $un; 
	private $zero; 
	private $conn;
	
	function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->db = $db;
		
	}
	//action sur le produit
	
	public function add_prod($nom_prod,$prix_prod,$description_prod,$categorie_prod,$photo_prod,$date_ajou)
	{
		try
		{
			
			
			$stmt = $this->db->prepare("INSERT INTO `produits` (`nom_prod`, `prix_prod`, `description_prod`, `categorie_prod`, `photo_prod`, `date_ajou`) VALUES (:nom_prod, :prix_prod, :description_prod, :categorie_prod, :photo_prod, :date_ajou )");
			$stmt->bindparam(":nom_prod",$nom_prod);
			$stmt->bindparam(":prix_prod",$prix_prod);
			$stmt->bindparam(":description_prod",$description_prod);
			$stmt->bindparam(":categorie_prod",$categorie_prod);
			$stmt->bindparam(":photo_prod",$photo_prod);
			$stmt->bindparam(":date_ajou",$date_ajou);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}

	public function dell_prod($id_prod){
		$stmt = $this->db->prepare("DELETE FROM produits WHERE id_prod=:id_prod");
		$stmt->bindparam(":id_prod",$id_prod);
		$stmt->execute();
		return true;
	} 

	public function update_prod($id_prod,$nom_prod,$prix_prod,$description_prod,$categorie_prod,$photo_prod)
	{
     	try
		{
			$stmt=$this->db->prepare("UPDATE produits SET nom_prod=:nom_prod, 
		                                               prix_prod=:prix_prod, 
													   description_prod=:description_prod, 
													   categorie_prod=:categorie_prod,
													   photo_prod=:photo_prod
													WHERE id_prod=:id_prod ");
			$stmt->bindparam(":nom_prod",$nom_prod);
			$stmt->bindparam(":prix_prod",$prix_prod);
			$stmt->bindparam(":description_prod",$description_prod);
			$stmt->bindparam(":categorie_prod",$categorie_prod);
			$stmt->bindparam(":photo_prod",$photo_prod);
			$stmt->bindparam(":id_prod",$id_prod);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}

	}
	public function active_prod($id_prod){
		
			try
		{
			$stmt=$this->db->prepare("UPDATE produits SET dispo_prod=1 
													WHERE id_prod=:id_prod ");
			
			$stmt->bindparam(":id_prod",$id_prod);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
		public function desactive_prod($id_prod){
		
			try
		{
			$stmt=$this->db->prepare("UPDATE produits SET dispo_prod=0 
													WHERE id_prod=:id_prod ");
			$stmt->bindparam(":id_prod",$id_prod);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
		public function view_prod($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($req2=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>

<!-- view produit -->
  <div class="col-xs-6 col-md-4 produit<?php echo $req2['id_prod']; ?>">
    <div class="thumbnail">
      <img src="../photos/<?php echo $req2['photo_prod']; ?>" alt="...">
      <div class="caption">
        <h3><?php echo $req2['nom_prod']; ?></h3>
        <p><?php echo $req2['description_prod']; ?></p>
        <p>
        	<button class="btn btn-xs btn-primary"><?php echo $req2['prix_prod']; ?> fcfa</button>
          <?php if ($req2['categorie_prod'] == 1) {
          ?> 
            <button class="btn btn-xs btn-info">A manger</button>
            <?php }  
              else if ($req2['categorie_prod'] == 2 ) {
                ?>
                 <button class="btn btn-xs btn-info">A boire</button>
                <?php  } ?>
          <?php if ($req2['dispo_prod'] == 0) {
          ?> 
            <button class="btn btn-xs btn-danger">non disponible</button>
            <?php }  
              else if ($req2['dispo_prod'] == 1 ) {
                ?>
                 <button class="btn btn-xs btn-info">disponible</button>
                <?php  } ?>
         </p>
        <button class="btn btn-success btn-xs" ><i class="fa fa-check desactiver" id="<?php echo $req2['id_prod']; ?>"></i></button>
        <a href="edit_product.php?id_prod=<?php echo $req2['id_prod']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
        <button class="btn btn-danger btn-xs"><i class="fa fa-times supprimer" id="<?php echo $req2['id_prod']; ?>"></i></button>
      </div>
    </div>
  </div>
<!-- fin view produit -->

            
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td> Fin </td>
            </tr>
            <?php
		}
		
	}
	//fin action sur le produit


// action sur le livreur


	public function add_liv($nom_liv,$email_liv,$telephone_liv,$num_cni_liv,$date_ajou_liv){
			try
		{
			
			
			$stmt = $this->db->prepare("INSERT INTO `livreurs` (`nom_liv`, `email_liv`, `telephone_liv`, `num_cni_liv`, `id_admin`, `date_ajou_liv`) VALUES (:nom_liv, :email_liv, :telephone_liv, :num_cni_liv, :id_admin, :date_ajou_liv )");
			$stmt->bindparam(":nom_liv",$nom_liv);
			$stmt->bindparam(":email_liv",$email_liv);
			$stmt->bindparam(":telephone_liv",$telephone_liv);
			$stmt->bindparam(":num_cni_liv",$num_cni_liv);
			$stmt->bindparam(":id_admin",$_SESSION['userid']);
			$stmt->bindparam(":date_ajou_liv",$date_ajou_liv);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
// fin action sur le livreur

	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function get_prod($id_prod)
	{
		$stmt = $this->db->prepare("SELECT * FROM produits WHERE id_prod=:id_prod");
		$stmt->execute(array(":id_prod"=>$id_prod));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	public function view_liv()
	{
		$stmt = $this->db->prepare("SELECT * 
FROM  `livreurs` as l, admin as a where l.id_admin = a.id_admin order by date_ajou_liv desc");
		$stmt->execute();
		while ($req2=$stmt->fetch(PDO::FETCH_ASSOC)) {
			//return $editRow;
			?>
 		<div class="col-xs-6 col-md-4">
 <div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading"> nom du livreur: <?php echo $req2['nom_liv']; ?> </h4>
    <p class="list-group-item-text"> email: <?php echo $req2['email_liv']; ?> </p>
    <p class="list-group-item-text"> telephone: <?php echo $req2['telephone_liv']; ?> </p>
    <p class="list-group-item-text"> numero de CNI: <?php echo $req2['num_cni_liv']; ?> </p>
    <p class="list-group-item-text"> nom du parain: <?php echo $req2['nom_admin']; ?> </p> <br>
    <p class="list-group-item-text"> <button type="submit" id="<?php echo $req2['id_liv']; ?>" class="btn btn-danger sup_liv"> supprimer</button>  </p>
  </a>
</div> 
</div>
					<?php }
 
		
	}
	public function get_liv()
	{
		$stmt = $this->db->prepare("SELECT * FROM livreurs");
		$stmt->execute();
		while ($editRow=$stmt->fetch(PDO::FETCH_ASSOC)) {
			//return $editRow;
			?>

	 <option value="<?php echo $editRow['id_liv']; ?>"> <?php echo $editRow['nom_liv']; ?> </option>
					<?php }
 
		
	}
	public function attrib_com($id_cmd,$id_liv)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE commande SET id_admin='".$_SESSION['userid']."', 
		                                               id_liv=:id_liv, etat_cmd = 1 
													WHERE id_cmd=:id_cmd ");
			$stmt->bindparam(":id_liv",$id_liv);
			$stmt->bindparam(":id_cmd",$id_cmd);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
		public function update($id,$nom_prod,$prix_prod,$description_prod,$categorie_prod)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE tbl_users SET first_name=:nom_prod, 
		                                               last_name=:prix_prod, 
													   description_prod_id=:description_prod, 
													   categorie_prod_no=:categorie_prod
													WHERE id=:id ");
			$stmt->bindparam(":nom_prod",$nom_prod);
			$stmt->bindparam(":prix_prod",$prix_prod);
			$stmt->bindparam(":description_prod",$description_prod);
			$stmt->bindparam(":categorie_prod",$categorie_prod);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function del_cmd($id)
	{
		$stmt = $this->db->prepare("DELETE FROM commande WHERE id_cmd=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$stmt1 = $this->db->prepare("DELETE FROM ls_prod_cmd WHERE id_cmd=:id");
		$stmt1->bindparam(":id",$id);
		$stmt1->execute();
		return true;
	}
		public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM tbl_users WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	/* paging */
	
	public function view_cmd($query)
	{
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($req2=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>


  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
    <div class="row">
    <?php 

$stmt1 = $this->db->prepare("SELECT * 
FROM  ls_prod_cmd as l,produits as p WHERE id_cmd=:id_cmd and l.id_prod=p.id_prod");
		$stmt1->execute(array(":id_cmd"=>$req2['id_cmd']));
		while ($req4=$stmt1->fetch(PDO::FETCH_ASSOC)) {
		?>	
		
		
   <?php echo $req4['prix_prod']; ?> X <?php echo $req4['qte_prod']; ?> = <?php echo $req4['prix_prod']*$req4['qte_prod']; ?>  <br>
      <img src="../photos/<?php echo $req4['photo_prod']; ?>" alt="..." class="col-xs-4 col-sm-4 col-md-4">
   <?php } ?>
     
    </div>
      <div class="caption">
        <h4> nom client:  <?php echo $req2['nom_clt']; ?></h4>
        <h4> numero: <?php echo $req2['telephone_clt']; ?></h4>
        <h4> prix : <?php echo $req2['prix_cmd']; ?> fcfa</h4>
        <p>statut: <span class="text-warning"><strong><?php if($req2['etat_cmd']==0){?>  commande non attribué <?php }
elseif ($req2['etat_cmd']==1) { ?> 
 commande attribué  à <span class="text-success"><?php echo $req2['nom_liv']; ?></span><?php  ?>
<?php } else{?>
commande livrée par <span class="text-warning"><?php $req2['nom_liv']; ?></span><?php  ?>
<?php  } ?>

 </strong></span>
        </p>
        <p> date:  <span class="text-warning"><?php echo $req2['date_cmd']; ?></span> </p>
        <p> id com: <span class="text-warning"><strong><?php echo $req2['id_cmd']; ?></strong></span></p>
        <p> nombres de produits   <span class="label label-success"><?php echo $req2['nbre_cmd']; ?></span>  </p>
        <p>prix total de cacommande:  <span class="label label-success"><?php echo $req2['prix_cmd']; ?> fcfa </span></p>
        <p>           <?php if($req2['etat_cmd']==0){ ?>  <a href="attrib_com.php?id_cmd=<?php echo $req2['id_cmd']; ?>" class="btn btn-success btn-block">
                            <span class="glyphicon glyphicon-share"></span> attribuer
                        </a>
                         <a href="modif_com.php?id_cmd=<?php echo $req2['id_cmd']; ?>" class="btn btn-warning btn-block">
                            <span class="glyphicon glyphicon-edit"></span> modifier
                        </a>
                        <?php } ?>
                         <button type="button" class="btn btn-danger del_com btn-block" id="<?php echo $req2['id_cmd']; ?>">
                            <span class="glyphicon glyphicon-remove"></span> supprimer
                        </button>
         </p>
       
      </div>
    </div>
  </div>

            
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}

	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?>

			<ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>page 1</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>precedente</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Suivantes</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>derniere page</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
