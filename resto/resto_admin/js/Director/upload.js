var maxW=800;
var maxH=800;
var tailleVignette=80;

$(function() {
	// verification de la compatibilité du navigateur avec  File
	if(window.File && window.FileList && window.FileReader)
	{
		// l'action se fait au change sur le champs "file"
		$('#champFile').change(function() {
			// la liste complete de fichiers
			var lesFichiers = event.target.files;
			// on parcour ts les fichier
			for(var i = 0; i< lesFichiers.length; i++)
			{
				var fichierActif = lesFichiers[i];
				var fileType=fichierActif.type;
	
				// Verification du type de fichier, image seulement
				if(!fileType.match('image'))
				  continue;

				// instance du FileReader
				var FileReaderImage = new FileReader();
				FileReaderImage.nom=fichierActif.name;
				
				// lecture du fichier terminé
				FileReaderImage.onload=function(e){
				   var fichierImage = e.target;
				   
					// instance de l'objet image
					var img = new Image();   
						img.nom=this.nom
						
					img.onload = function() {
						var orrigineW=img.width;
						var orrigineH=img.height;
						
						// appel de fuction qui defini les tailles finales
						var taille=tailleFinal(orrigineW, orrigineH, maxW, maxH)
						
						// ajout des div de mise en forme
						$('#resultat').append('<div class="ligneResultatTotal"><div class="ligneResultatImg"></div></div>');
						$('.ligneResultatImg').css('width', tailleVignette+'px');
						$('.ligneResultatImg').css('height', tailleVignette+'px');
						
						// creation du canvas 2d au dimensions définies plus haut
						var canvas = document.createElement('canvas');
						canvas.width = taille.width;
						canvas.height = taille.height;
						var context = canvas.getContext('2d');
						
						// integration de notre image dans le canvas
						context.drawImage(img, 0, 0, taille.width, taille.height);
						
						// recuperation du nouveau fichier image en jpg compression qualité 80%
						canvasData=canvas.toDataURL('image/jpeg', 0.8)

						// integration de la vignette de preview
						if (taille.height<taille.width)
							var margin='margin-top:'+((maxH-taille.height)/2)*tailleVignette/maxH+'px';
						else
							var margin='margin-left:'+((maxW-taille.width)/2)*tailleVignette/maxW+'px';

						$('.ligneResultatImg').last().append('<img src="'+canvasData+'" style="'+margin+'" >');
						$('.ligneResultatTotal').last().append(
										'<div class="zoneInfo">'+
											'<div class="titre">'+
												this.nom+	
											'</div>'+
											'<div class="detailInfo">Type : '+fileType+
											'<br>Taille d\'origine : '+orrigineW+' X '+orrigineH+' px'+
											'<br>Taille finale : '+taille.width+' X '+taille.height+' px</div>'+
											'<div class="zoneProgress"><div class="barreProgress"> %</div></div>'+
											'<input type="text" value="'+this.nom+'" name="photo">'+
										'</div>'
										)
						cibleProgress=$('.ligneResultatTotal').last().find('.barreProgress');
						
						// envoi de l'ajax d'upload et du formdata
						uploadFile(canvasData, 'jpg', cibleProgress, this.nom);
					};
					img.src = fichierImage.result;
				};
				 //lecture de l'image
				FileReaderImage.readAsDataURL(fichierActif);
			}
		});
	}
	else
	{
		console.log("Votre navigateur ne supporte pas l'API File");
	}
});



var tailleFinal=function(orrigineW, OrrigineH, maxW, maxH){
	var tailleFinalW = orrigineW, 
		tailleFinalH = OrrigineH;
	
	if (orrigineW > OrrigineH) {
	  if (orrigineW > maxW) {
		tailleFinalH *= maxW / orrigineW;
		tailleFinalW = maxW;
	  }
	} else {
	  if (OrrigineH > maxH) {
		tailleFinalW *= maxH / OrrigineH;
		tailleFinalH = maxH;
	  }
	}
 
	return { width: tailleFinalW, height: tailleFinalH };
}


function uploadFile(fichier, ext , cibleProgress, nomFichier){
	var formdata = new FormData();
	formdata.append("fichier", fichier);
	formdata.append("ext", ext);
	formdata.append("name", nomFichier);
	var ajax = new XMLHttpRequest();
	
	ajax.upload.addEventListener("load", function(e){
					cibleProgress.css('background-color','#0a0');
					cibleProgress.text('Upload terminé')
				}, false);	
				
	ajax.upload.addEventListener("error", function(e){
					var pourcentage = Math.round((e.loaded * 100) / e.total);
					cibleProgress.css('width',"100%");
					cibleProgress.text('erreur d\'upload')
				}, false);	
				
	ajax.upload.addEventListener("progress", function(e){
					var pourcentage = Math.round((e.loaded * 100) / e.total);
					cibleProgress.css('width',pourcentage+"%");
					cibleProgress.text(pourcentage+"%")
					
				}, false);

	ajax.open("POST", "upload.php");
	ajax.send(formdata);
}