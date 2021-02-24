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
		                                        <th width="10%">Type de chambre</th> 
		                                        <th width="10%">Galerie</th> 
		                                        <th width="15%">Montant</th> 
		                                        <th width="15%">Etat de la chambre</th> 
		                                        <th width="20%">Mise à jour</th>
		                                         
		                                        <th width="5%">Modifier</th> 
		                                        <th width="5%">Supprimer</th>  
		                                    </tr>  
		                               </thead> 

		                               <tfoot>  
		                                    <tr>  
		                                        <th width="20%">Nom de la chambre</th>  
		                                        <th width="10%">Type de chambre</th> 
		                                        <th width="10%">Galerie</th> 
		                                        <th width="15%">Montant</th> 
		                                        <th width="15%">Etat de la chambre</th> 
		                                        <th width="20%">Mise à jour</th>
		                                         
		                                        <th width="5%">Modifier</th> 
		                                        <th width="5%">Supprimer</th>
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
                              <label><i class="fa fa-tag"></i> Galerie</label>  
                              <select name="galerie_ok" id="galerie_ok" class="form-control selectpicker" data-live-search="true">
                                <option value="">Selectionnez sa galerie</option>
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
                                    <option value="">aucune galerie n'est disponible</option>
                                    <?php
                                  }
                                ?>
                                
                              </select>
                            </div>

                            <div class="col-md-12">
                                <label><i class="fa fa-home"></i> Nom de la chambre</label>
                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de la chambre" />
                            </div>

                            <div class="form-group col-md-12">
                              <label><i class="fa fa-glass"></i> Type de la chambre</label>  
                              <select name="type_ok" id="type_ok" class="form-control selectpicker" data-live-search="true">
                                <option value="">Selectionez son type</option>
                                <?php
                                  if ($types->num_rows() > 0) {
                                   foreach ($types->result_array() as $key) {
                                        ?>
                                       <option value="<?php echo($key['idtype']) ?>"><?php echo($key['designation']) ?></option>
                                       <?php
                                   }
                                  }
                                  else{
                                    ?>
                                    <option value="">aucun type  n'est disponible</option>
                                    <?php
                                  }
                                ?>
                                
                              </select>
                            </div>


                            <div class="form-group col-md-12">
                              <label><i class="fa fa-money"></i>Saisissez le montant à payer en $</label>  
                                  <input type="number" min="1" name="montant" id="montant" class="form-control" placeholder="Saisissez le montant">
                            </div>

                            
                            

                            <div class="form-group col-md-12 text-center">
                            	<input type="hidden" name="idchambre" id="idchambre" />

                            	<input type="hidden" name="idg" id="idg" />
                            	<input type="hidden" name="idtype" id="idtype" />

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


     <script type="text/javascript" language="javascript" >  
     $(document).ready(function(){  

     	 var  $message = '';
          $('#add_button').click(function(){  
               $('#user_form')[0].reset();  
               $('.modal-title').text("Paramètrage des chambres");  
               $('#action').val("Add");  
          })  
          // var dataTable = $('#user_data').DataTable();
          var dataTable = $('#user_data').DataTable({  
               "processing":true,  
               "serverSide":true,  
               "order":[],  
               "ajax":{  
                    url:"<?php echo base_url() . 'admin/fetch_chambre'; ?>",  
                    type:"POST"  
               },  
               "columnDefs":[  
                    {  
                         "targets":[0, 0, 0],  
                         "orderable":false,  
                    },  
               ],  
          });

          $(document).on('submit', '#user_form', function(event){  
               event.preventDefault();  
               var nom = $('#nom').val(); 
               var montant = $('#montant').val(); 
               var idg = $('#idg').val(); 
               var idtype = $('#idtype').val();  
               
               var action = $('#action').val();


               if(nom != '' && montant != '' && idg != '' && idtype != '')
                {

                  if (action =="Add") {
                       
                      $.ajax({  
                           url:"<?php echo base_url() . 'admin/operation_chambre'?>",  
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
                             url:"<?php echo base_url() . 'admin/modification_chambre'?>",  
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
                else
                {
                  swal("Erreur 🙆!!!", "Tous les champs doivent être remplis", "error");
                }


                 
          });  


          $(document).on('click', '.update', function(){  
               var idchambre = $(this).attr("idchambre");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_chambre",  
                    method:"POST",  
                    data:{idchambre:idchambre},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#userModal').modal('show');  
                         $('#nom').val(data.nom);
                         $('#montant').val(data.montant);
                         $('#idtype').val(data.idtype);
                         $('#idg').val(data.idg);
                         
                         
                         $('.modal-title').text("modification du client  "+data.nom);  
                         $('#idchambre').val(idchambre);   
                         $('#action').val("Edit");  
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var idchambre = $(this).attr("idchambre");

              if(confirm("Are you sure you want to delete this?"))
		          {
		            
		           		$.ajax({
	                    url:"<?php echo base_url(); ?>admin/supression_chambre",
	                    method:"POST",
	                    data:{idchambre:idchambre},
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

          $("#type_ok").on("change", function(t) {

            var idtype = $(this).val();
            if (idtype !='') {
                $('#idtype').val(idtype);
            }
            else{

                 $('#idtype').val("");                 
                swal("Ouf!!!", "Veillez complèter le type de la chambre 😰", "error"); 
            }
        });

        $("#galerie_ok").on("change", function(t) {

            var idg = $(this).val();
            if (idg !='') {
                $('#idg').val(idg);
            }
            else{

                 $('#idg').val("");                 
                swal("Ouf!!!", "Veillez complèter la galerie 😰", "error"); 
            }
        });

          





     });  
     </script>






</body>

</html>