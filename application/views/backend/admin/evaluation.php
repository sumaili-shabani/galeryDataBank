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
					                             <button class="btn btn-dim btn-sm btn-outline-primary pull-right  mb-4" id="add_button" data-toggle="modal" data-target="#userModal"><i class="fa fa-plus"></i>Effectuer l'opération</button>
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

					                                        <th width="10%">Date debit contrat</th> 
					                                        <th width="10%">Date fin contrat</th> 

					                                        <th width="10%">Etat de la chambre</th> 
					                                        <th width="20%">Mise à jour</th>
					                                         
					                                         
					                                    </tr>  
					                               </thead> 

					                               <tfoot>  
					                                    <tr>  
					                                        <th width="20%">Nom de la chambre</th>  
					                                        <th width="20%">Nom du client</th>
					                                        <th width="10%">Montant</th> 

					                                        <th width="10%">Date debit contrat</th> 
					                                        <th width="10%">Date fin contrat</th> 

					                                        <th width="10%">Etat de la chambre</th> 
					                                        <th width="20%">Mise à jour</th>
					                                         
					                                        
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
                 <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <div class="nk-block-head nk-block-head-xs text-center">
                        <span class="nk-block-title modal-title">Paramètrage</span>
                       
                        
                    </div>
                    <div class="nk-block">

                    	<form method="post" id="user_form" enctype="multipart/form-data" class="col-md-12 row">

                        <div class="form-group col-md-12">
                          <label><i class="fa fa-university"></i>&nbsp; Nom  de la galerie</label>  
                          <select name="galerie_ok" id="galerie_ok" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selectionez la galerie</option>
                            <?php
                              if ($galeries->num_rows() > 0) {
                               foreach ($galeries->result_array() as $key) {
                                  ?>
                                   <option value="<?php echo($key['idg']) ?>"><?php echo($key['adresse']) ?></option>
                                   <?php
                               }
                              }
                              else{
                                ?>
                                <option value="">aucune galerie  n'est disponible</option>
                                <?php
                              }
                            ?>
                            
                          </select>
                        </div>

                    		<div class="form-group col-md-6">
                              <label><i class="fa fa-home"></i>&nbsp; Nom  de la chambre</label>  
                              <select name="chambre_ok" id="chambre_ok" class="form-control selectpicker" data-live-search="true">
                                <option value="">Selectionez la chambre</option>
                                <!---->
                                
                              </select>
                            </div>

                            <div class="form-group col-md-6">
                              <label><i class="fa fa-user"></i>&nbsp; Nom  du client</label>  
                              <select name="client_ok" id="client_ok" class="form-control selectpicker" data-live-search="true">
                                <option value="">Selectionez le client</option>
                                <?php
                                  if ($clients->num_rows() > 0) {
                                   foreach ($clients->result_array() as $key) {
                                    	?>
                                       <option value="<?php echo($key['idclient']) ?>"><?php echo($key['fullname']) ?></option>
                                       <?php
                                   }
                                  }
                                  else{
                                    ?>
                                    <option value="">aucun client  n'est disponible</option>
                                    <?php
                                  }
                                ?>
                                
                              </select>
                            </div>
                    		
                            <div class="form-group col-md-6">
                              <label><i class="fa fa-calendar"></i>&nbsp; Date debit contrat</label>  
                                  <input type="date" name="date_debit" id="date_debit" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                              <label><i class="fa fa-calendar"></i>&nbsp; Date fin contrat</label>  
                                  <input type="date" name="date_fin" id="date_fin" class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                              <label><i class="fa fa-money"></i>&nbsp; Saisissez le montant à payer en $</label>  
                                  <input type="number" min="1" name="montant" id="montant" class="form-control" placeholder="Saisissez le montant">
                            </div>


                            <div class="form-group col-md-12 text-center">
                            	<input type="hidden" name="idl" id="idl" />

                            	<input type="hidden" name="idclient" id="idclient" />
                            	<input type="hidden" name="idchambre" id="idchambre" />

								<input type="hidden" name="operation" id="operation" />
								<input type="submit" name="action" id="action" class="btn btn-primary btn-lg" value="Add" />

								 <div class="pt-3">
	                                <a href="javascript:void(0);" data-dismiss="modal" class="link link-danger">Annuler l'opération</a>
	                            </div>

                            </div>


                    	</form>
                        
                        
                        
                    </div><!-- .nk-block -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div>
    <!-- fin modal-->

    <?php 

    $json[] = array(
        'title'      => '',
        'start'      => '',
        'end'        => '',
        'className'  => 'bg-info' 
    );

    ?>

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
     </script>s


     <script type="text/javascript" language="javascript">  
     $(document).ready(function(){  

     	 var  $message = '';
          $('#add_button').click(function(){  
               $('#user_form')[0].reset();  
               $('.modal-title').text("Paramètrage des locations");  
               $('#action').val("Add");  
          })  
          var dataTable = $('#user_data').DataTable();

          // var dataTable = $('#user_data').DataTable({  
          //      "processing":true,  
          //      "serverSide":true,  
          //      "order":[],  
          //      "ajax":{  
          //           url:"<?php echo base_url() . 'admin/fetch_location'; ?>",  
          //           type:"POST"  
          //      },  
          //      "columnDefs":[  
          //           {  
          //                "targets":[0, 0, 0],  
          //                "orderable":false,  
          //           },  
          //      ],  
          // });

          $(document).on('submit', '#user_form', function(event){  
               event.preventDefault();  
               var montant 		= $('#montant').val(); 
               var idclient 	= $('#idclient').val(); 
               var idchambre 	= $('#idchambre').val(); 

               var date_debit 	= $('#date_debit').val(); 
               var date_fin 	= $('#date_fin').val();  
               
               var action = $('#action').val();


               if(date_debit != '' && date_fin != '' && montant != '' && idclient != '' 
               	&& idchambre != '')
                {

                  if (date_debit > date_fin) {
                  	swal("Erreur 🙆!!!", "la date debit doit être superieur à la date de fin contrat", "error");
                  }
                  else{
	                  if (action =="Add") {
	                       
	                      $.ajax({  
	                           url:"<?php echo base_url() . 'admin/operation_location'?>",  
	                           method:'POST',  
	                           data:new FormData(this),  
	                           contentType:false,  
	                           processData:false,  
	                           success:function(data)  
	                           {  
	                                swal('succès 👌', 'Opération reussie avec succès 👌'+data, 'success'); 
	                               

	                                $('#user_form')[0].reset();  
	                                $('#userModal').modal('hide');  
	                                dataTable.ajax.reload();  
	                           }  
	                      });

	                  }
	                  if (action == 'Edit') {

	                        $.ajax({  
	                             url:"<?php echo base_url() . 'admin/modification_location'?>",  
	                             method:'POST',  
	                             data:new FormData(this),  
	                             contentType:false,  
	                             processData:false,  
	                             success:function(data)  
	                             {  
	                                  swal('succès 👌', 'Opération reussie avec succès 👌'+data, 'success');
	                                   

	                                  $('#user_form')[0].reset();  
	                                  $('#userModal').modal('hide');  
	                                  dataTable.ajax.reload();  
	                             }  
	                        });

	                  }
                  }

                }
                else
                {
                  swal("Erreur 🙆!!!", "Tous les champs doivent être remplis", "error");
                }


                 
          });  


          $(document).on('click', '.update', function(){  
               var idl = $(this).attr("idl");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_location",  
                    method:"POST",  
                    data:{idl:idl},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#userModal').modal('show');  
                         $('#date_debit').val(data.date_debit);
                         $('#date_fin').val(data.date_fin);
                         $('#montant').val(data.montant);
                         $('#idclient').val(data.idclient);
                         $('#idchambre').val(data.idchambre);
                         
                         
                         $('.modal-title').text("modification de location");  
                         $('#idl').val(idl);   
                         $('#action').val("Edit");  
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var idl = $(this).attr("idl");
              var idchambre = $(this).attr("idchambre");

              if(confirm("Are you sure you want to delete this?"))
		          {
		            
		           		$.ajax({
	                    url:"<?php echo base_url(); ?>admin/supression_location",
	                    method:"POST",
	                    data:{
	                    	idl:idl,
	                    	idchambre: idchambre
	                    },
	                    success:function(data)
	                    {
	                       swal('succès 👌', 'Opération reussie avec succès 👌'+data, 'success');
	                        
	                       dataTable.ajax.reload();
	                    }

                  });
		          }
		          else
		          {
		            swal("Ouf!!!", "opération annulée :)", "info");
		          }

          });

          

        $("#chambre_ok").on("change", function(t) {

            var idchambre = $(this).val();
            if (idchambre !='') {
                $('#idchambre').val(idchambre);

	               $.ajax({  
	                    url:"<?php echo base_url(); ?>admin/fetch_single_chambre",  
	                    method:"POST",  
	                    data:{idchambre:idchambre},  
	                    dataType:"json",  
	                    success:function(data)  
	                    {  
	                         $('#montant').val(data.montant);   
	                    }  
	               });  
            }
            else{

                 $('#idchambre').val(""); 
                 $('#montant').val("");                
                swal("Ouf!!!", "Veillez complèter la chambre 😰", "error"); 
            }
        });

        $("#client_ok").on("change", function(t) {

            var idclient = $(this).val();
            if (idclient !='') {
                $('#idclient').val(idclient);
            }
            else{

                 $('#idclient').val("");                 
                swal("Ouf!!!", "Veillez complèter le client 😰", "error"); 
            }
        });

        $(document).on('change', '#galerie_ok', function(){
      
            var idg = $(this).val();
            if(idg != '')
            {
              // alert(idg);
               $.ajax({
                  url:"<?php echo base_url(); ?>admin/fetch_chambre_reference_galerie",
                  method:"POST",
                  data:{idg:idg},
                  success:function(data)
                  {
                   $('#chambre_ok').html(data);
                  }
               });
            }
            else
            {
               $('#chambre_ok').html('<option value="">Selectionner la chambre</option>');
               swal("Ouf!!!", "Veillez complèter la galerie 😰", "error");
            }
            // alert(idv);
        });


          





     });  
     </script>






</body>

</html>