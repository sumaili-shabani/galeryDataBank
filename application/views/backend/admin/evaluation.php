<!DOCTYPE html>
<html lang="fr">

<head>

   <?php include('_meta.php') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <?php include('_navigation.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('_menuheader.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div id="load_data"></div>
                    <div id="load_data_message"></div>

                    <div class="col-md-12 card">
                    	<div class="row card-body">

                    		<div class="col-md-12">
                    			<div class="row">
                    				<div class="col-md-4">
                    					<div id="calendar"></div>
                    				</div>

                    				<div class="col-md-8">

                    					<!-- mes script commencent -->
					                      <div class="col-md-12">
					                         <div class="row">
					                           <div class="col-md-12">
					                             <button class="btn btn-dim btn-sm btn-outline-primary pull-right  mb-4" id="add_button" data-toggle="modal" data-target="#userModal"><i class="fa fa-envelope"></i>
					                              &nbsp;&nbsp;Les Faire un message</button>
					                           </div>
					                         </div>
					                      </div>
					                      <!-- insertion de tableau -->
					                      <div class="col-md-12">
					                        <div class="table-responsive">
					                            <table id="user_data" class="table table-bordered table-light table-white">
					                                <thead class="tb-member-head thead-light">  
					                                    <tr>  
					                                        <th width="20%">Nom de la chambre</th>  
					                                        <th width="20%">Nom du client</th>
					                                        <th width="10%">Montant</th> 

					                                        <th width="20%">Date debit contrat</th> 
					                                        <th width="20%">Date fin contrat</th> 

					                                        <th width="10%">Etat de la chambre</th> 
					                                         
					                                         
					                                    </tr>  
					                               </thead>

					                               <tbody>
					                               	<?php 
					                               	  $date_jour = date('Y-m-d');
												      $request = $this->db->query("SELECT * FROM profile_paiement WHERE date_fin <='".$date_jour."' GROUP BY idchambre");
												      if ($request->num_rows() > 0) {
												          
												          foreach ($request->result_array() as $key) {
												            $nom_chambre = $key['nom'];
												            $nom_client  = $key['fullname'];
												            $date_fin    = $key['date_fin'];
												            $date_debit    = $key['date_debit'];
												            $date_expire_format = nl2br(substr(date(DATE_RFC822, strtotime($key['date_fin'])), 0, 23));

												            $idchambre   = $key['idchambre'];

												     

														    $json[] = array(
														        'title'      => $nom_chambre,
														        'start'      => '2020-02-10',
														        'end'        => '2020-02-13',
														        'className'  => 'bg-primary' 
														    );



												            if ($key['etat'] == 0) {
												             	$etat ='<span class="badge badge-info">innocupée</span>';
												            }
												            else{
												            	$etat ='<span class="badge badge-success">occupée</span>';
												            } 

												              if ($idchambre !='') {
												          
												                $updated_data = array(  
												                    'etat'   =>     0
												                );

												                $this->crud_model->update_chambre($idchambre, $updated_data);
												              }

												              $users_cool = $this->crud_model->get_info_user();
												              foreach ($users_cool as $key2) {

												                  if ($key2['idrole'] == 1) {
													                    $url ="admin/location";

													                    $id_user_recever = $key2['id'];

													                    $message = $nom_chambre." a expiré ".$date_fin;

													                    $notification = array(
													                      'titre'     =>    "Expiration du contrat",
													                      'icone'     =>    "fa fa-bell",
													                      'message'   =>     $message,
													                      'url'       =>     $url,
													                      'id_user'   =>     $id_user_recever
													                    );
													                    
													                   // $not = $this->crud_model->insert_notification($notification);

												                  }

												                  ?>
												                  <tr>
												                  	<td>
												                  		<input type="checkbox" name="checkbox_id" id="checkbox_id" class="checkbox_id" value="<?= $key['email']; ?>">&nbsp;&nbsp;&nbsp;
												                  		<?php echo($key['nom']); ?>
												                  	</td>
												                  	<td><?php echo($key['fullname']); ?></td>
												                  	<td><?php echo($key['montant']); ?></td>
												                  	<td>
												                  		<?php echo(nl2br(substr(date(DATE_RFC822, strtotime($key['date_debit'])), 0, 23))) ?>
												                  	</td>
												                  	<td>
												                  		<?php echo(nl2br(substr(date(DATE_RFC822, strtotime($key['date_fin'])), 0, 23))) ?>
												                  	</td>
												                  	<td>
												                  		<?php echo($etat); ?>
												                  	</td>
												                  	
												                  </tr>
												                  <?php
												                  
												                    # code...
												              }

												          }
												      }
												      else{

												      	$json[] = array(
													        'title'      => '',
													        'start'      => '',
													        'end'        => '',
													        'className'  => 'bg-info' 
													    );


												      }



					                               	 ?>
					                               </tbody> 

					                               <tfoot>  
					                                    <tr>  
					                                        <th width="20%">Nom de la chambre</th>  
					                                        <th width="20%">Nom du client</th>
					                                        <th width="10%">Montant</th> 

					                                        <th width="20%">Date debit contrat</th> 
					                                        <th width="20%">Date fin contrat</th> 

					                                        <th width="10%">Etat de la chambre</th> 
					                                        
					                                         
					                                        
					                                    </tr>  
					                               </tfoot>   
					                                
					                            </table>
					                        </div>
					                      </div>
					                      <!-- fin insertion tableau -->
					                      <!-- fin de mes scripts -->
					                   
					        			<!-- fin -->
                    					
                    				</div>

                    			</div>
                    		</div>
                    		
                    	</div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('_footer.php') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

   
   <?php include('_script.php') ?>

          <!-- modal ajout radio -->
    <div class="modal fade" tabindex="-1" role="dialog" id="userModal">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                
                <div class="modal-body modal-body-lg">
                    <div class="nk-block-head nk-block-head-xs text-center">
                        <span class="nk-block-title modal-title">Paramètrage des informations</span>
                        <a href="#" class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
                        
                    </div>
                    <div class="nk-block">

                    	<form method="post" id="user_form" enctype="multipart/form-data" class="form-contact">
			                <div class="row g-3">
			                    
			                    <div class="col-12">

			                    	

			                        <div class="form-group">
			                            
			                            <div class="form-control-wrap">
			                                <div class="form-editor-custom">
			                                    <textarea name="message" id="message"  class="form-control form-control-lg no-resize" placeholder="Quoi des news?" rows="5"></textarea>
			                                    
			                                </div>
			                            </div>
			                        </div>
			                        <div class="form-group">
			                        	<button type="submit" name="valider" id="envoyer_message" class="btn btn-primary btm-sm pull-right envoyer_message">
			                        		<i class="fa fa-send"></i> &nbsp; Envoyer
			                        	</button>
			                        </div>
			                    </div><!-- .col -->
			                    
			                   
			                    
			                </div><!-- .row -->
			            </form><!-- .form-contact -->
                        
                        
                        
                    </div><!-- .nk-block -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div>
    <!-- fin modal-->

   

    <script type="text/javascript">
         $(document).ready(function(){
              "use strict";
              $('#calendar').fullCalendar({
                  defaultView: 'month',

                  header: {
                      left: 'title', // you can add today btn
                      center: '',
                      right: 'month, agendaWeek, listWeek, prev, next', // you can add agendaDay btn
                  },
                  contentHeight: 'auto',
                  defaultDate: '<?= date('Y-m-d'); ?>',
                  editable: true,
                  droppable: false, // this allows things to be dropped onto the calendar
                  eventLimit: false, // allow "more" link when too many events
                      
                  events: <?= json_encode($json); ?>
              });
            });
     </script>

     <script type="text/javascript" language="javascript">
$(document).ready(function(){
 
	$('.checkbox_id').click(function(){
	  if($(this).is(':checked'))
	  {
	  	
	  }
	  else
	  {
	  }
	});


 	$('#envoyer_message').click(function(event){
 		  event.preventDefault();
	  	  var checkbox = $('.checkbox_id:checked');

	  	  var message = $('#message').val();

	  	  if (message !='') {
	  	  	alert(" message "+message);

	  	  	  if(checkbox.length > 0)
			  {
				   var checkbox_value = [];
				   $(checkbox).each(function(){
				    checkbox_value.push($(this).val());
				   });

				   // alert("email:"+checkbox_value);
				    $.ajax({
					    url:"<?php echo base_url(); ?>admin/infomation_par_mail_delai_contrat",
					    method:"POST",
					    data:{
					    	checkbox_value:checkbox_value,
					    	message: message
					    },
					    success:function(data)
					    {
					    	
					    	swal("succès!!!👌", ""+data, 'success');  
					    	
					    }
				   });
			  }
			  else
			  {
			  	swal("error!!!🙆", "Veillez selectionner aumoins un client pour éffectuer cette opération", "error");
			  	
			  }

	  	  }
	  	  else{
	  	  	
	  	  	if (message=='') {
	  	  		swal("error!!!🙆", "Veillez Entrer le contenu pour la réponse au message", "error");
	  	  	}
	  	  }

	  	  

	  	
		  
	 });

 	

    $('#example-tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

 	

});
</script>


</body>

</html>