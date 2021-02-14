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
					<hr>
				</div>
				
			</div>

			<div class="col-md-1"></div>
		</div>

		<!-- debut -->
        <!-- mes script commencent -->
      <div class="col-md-12">
         <div class="row">
           <div class="col-md-12">
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