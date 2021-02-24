<!-- les scripts commencent  -->

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-11">


		<div class="col-md-12 row">
			<div class="col-md-1">
			
			</div>
			<div class="col-md-10">
				<div class="col-md-12">
					<form class="row" method="post" action="<?php echo(base_url()) ?>admin/filtrage_comptabilite">

						<div class="col-5">
							<div class="form-group col-md-12">
		                        
		                           <select  name="date1" id="date1" class="form-control selectpicker" data-live-search="true">
		                           	<?php 
		                           	if ($dates->num_rows() > 0) {
		                           		?>
		                           		<option value="">Selectionnez la date</option>
		                           		<?php
		                           		foreach ($dates->result_array() as $key) {
		                           			?>
		                           			<option value="<?php echo($key['date_paie']) ?>">
		                           				<?php echo(

		                           					nl2br(substr(date(DATE_RFC822, strtotime($key['date_paie'])), 0, 23))

		                           				) ?>
		                           					
		                           				</option>
		                           			<?php
		                           		}
		                           	}
		                           	else{

		                           		?>
		                           		<option value="">Aucune date n'est diponible</option>
		                           		<?php
		                           	}
		                           	?>
		                           	
		                           </select> 
		                    </div>

						</div>

						<div class="col-5">
							
							<div class="form-group col-md-12">
		                        
		                           <select  name="date2" id="date2" class="form-control selectpicker" data-live-search="true">
		                           	<?php 
		                           	if ($dates->num_rows() > 0) {
		                           		?>
		                           		<option value="">Selectionnez la date</option>
		                           		<?php
		                           		foreach ($dates->result_array() as $key) {
		                           			?>
		                           			<option value="<?php echo($key['date_paie']) ?>">
		                           				<?php echo(

		                           					nl2br(substr(date(DATE_RFC822, strtotime($key['date_paie'])), 0, 23))

		                           				) ?>
		                           					
		                           				</option>
		                           			<?php
		                           		}
		                           	}
		                           	else{

		                           		?>
		                           		<option value="">Aucune date n'est diponible</option>
		                           		<?php
		                           	}
		                           	?>
		                           	
		                           </select> 
		                    </div>


						</div>

						<div class="col-2">
							<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-send"></i> Envoyer</button>
						</div>

					</form>
				</div>
				
			</div>

			<div class="col-md-1"></div>
		</div>

		<?php 

			$url;

			if ($dates1 !='' && $dates2 !='') {

			$url = "impression_pdf_paiement_au_system_filtrage/".$dates1."/".$dates2;
			
			}
			else{
				$url = "impression_pdf_paiement_au_system";
			}
		?>

		<!-- debut -->
        <!-- mes script commencent -->
      <div class="col-md-12">
         <div class="row">
           <div class="col-md-12">

           	 &nbsp;<a href="<?php echo(base_url()) ?>admin/<?php echo($url) ?>" class="btn btn-default"><i class="fa fa-print"></i>PDF</a>   &nbsp;&nbsp;&nbsp;&nbsp;  <a href="" class="btn btn-default text-muted"><i class="fa fa-refresh"></i>actualiser</a>

             <button class="btn btn-dim btn-sm btn-outline-primary pull-right  mb-4" id="add_button" data-toggle="modal" data-target="#userModal"><i class="fa fa-plus"></i>Effectuer l'opération</button>
           </div>
         </div>
      </div>

        <div class="col-md-12">
        	<div class="table-responsive">
                <table id="user_data" class="table table-bordered table-striped">
                    <thead>  
                        <tr>  
                        	 <th width="5%">Imprimmer</th>
                             <th width="20%">Nom complet</th>

                             <th width="10%"> Montant</th>
                             <th width="15%"> Motifs</th>

                             <th width="10%"> N° de téléphone</th>

                             <th width="15%">Date de paiement</th>
                             <th width="15%">Mise àjour</th>
                             
                             <th width="5%">Editer</th> 

                             <!-- <th width="5%">Supprimer</th>   --> 
                        </tr>  
                   </thead>   

                   <tbody>
                   		<?php 
	                   	if ($donnees->num_rows() > 0) {
	                   		foreach ($donnees->result_array() as $key) {
	                   			
	                   			?>
	                   			<tr>
	                   				<td>
	                   					<a href="<?php echo(base_url()) ?>admin/impression_pdf_paiemant_list/<?php echo($key['idp']) ?>" class="btn btn-primary btn-sm btn-circle"><i class="fa fa-print"></i></a>
	                   				</td>

	                   				<td><?php echo($key['nom'].' - '.$key['fullname']) ?></td>
	                   				<td><?php echo($key['montant']) ?></td>
	                   				<td><?php echo($key['motif']) ?></td>

	                   				<td><?php echo($key['tel']) ?></td>

	                   				<td><?php echo($key['date_paie']) ?></td>
	                   				<td>

	                   				<?php echo(nl2br(substr(date(DATE_RFC822, strtotime($key['created_at'])), 0, 23))) ?>
	                   						
	                   				</td>

	                   				<?php 

	                   				if ($key['etat_paie'] == 0) {
	                   					?>
	                   					<td>
		                   					<a href="javascript:void(0);" class="btn btn-danger btn-sm btn-circle delete" idchambre="<?php echo($key['idchambre']) ?>"  idp="<?php echo($key['idp']) ?>"><i class="fa fa-trash"></i></a>
		                   				</td>
	                   					<?php
	                   				}
	                   				else{
	                   					
	                   					?>
	                   					<td>
		                   					<a href="javascript:void(0);" class="btn btn-success  btn-sm btn-circle"  idp="<?php echo($key['idp']) ?>"><i class="fa fa-check"></i></a>
		                   				</td>
	                   					<?php

	                   				}



	                   				 ?>

	                   				

	                   				
	                   				


	                   			</tr>
	                   			<?php
	                   		}
	                   	}

                   	?>
                   </tbody>

                   <tfoot>  
                        <tr>  
                        	 <th width="5%">Imprimmer</th>
                             <th width="20%">Nom complet</th>

                             <th width="10%"> Montant</th>
                             <th width="15%"> Motifs</th>

                             <th width="10%"> N° de téléphone</th>

                             <th width="15%">Date de paiement</th>
                             <th width="15%">Mise àjour</th>
                             
                             <th width="5%">Editer</th> 

                             <!-- <th width="5%">Supprimer</th>   --> 
                        </tr>  
                   </tfoot>   
                    
                </table>
            </div>
        </div>
        <!-- fin  -->
		
	</div>
	

</div>


<!-- fin de mes scripts