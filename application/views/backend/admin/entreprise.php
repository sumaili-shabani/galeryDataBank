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
		                                        <th width="35%">Nom du poste</th> 
		                                        <th width="30%">N° RCM</th> 
		                                        <th width="25%">Mise à jour</th>
		                                         
		                                        
		                                        <th width="5%">Modifier</th> 
		                                        <th width="5%">Supprimer</th>  
		                                    </tr>  
		                               </thead> 

		                               <tfoot>  
		                                    <tr>  
		                                        <th width="35%">Nom du poste</th> 
		                                        <th width="30%">N° RCM</th> 
		                                        <th width="25%">Mise à jour</th>
		                                         
		                                        
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
                    		
                    		<div class="col-md-12">
                    			<div class="input-group flex-nowrap mb-2">
  								  <div class="input-group-prepend">
  								    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-edit"></i></span>
  								  </div>
  								  <input type="text" name="designation" id="designation" class="form-control" placeholder="Entrez la designation de poste" />
  								</div>
                    		</div>

                    		<div class="col-md-12">
                    			<div class="input-group flex-nowrap mb-2">
  								  <div class="input-group-prepend">
  								    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-credit-card"></i></span>
  								  </div>
  								  <input type="text" name="numrcm" id="numrcm" class="form-control" placeholder="N° de registre du commerce" />
  								</div>
                    		</div>


                    		

                    		<div class="col-md-12" style="margin-bottom: 20px;">
                    			<div class="row">
                    				<div class="col-md-4"></div>
                    				<div class="col-md-4">

                    					<div class="buysell-field form-action text-center mb-2">
				                            <div>

				                            	<input type="hidden" name="ide" id="ide" />
	     									    <input type="hidden" name="operation" id="operation" />
		                    				     <input type="submit" name="action" id="action" class="btn btn-primary btn-lg" value="Add" />
				                            </div>
				                            <div class="pt-3">
				                                <a href="javascript:void(0);" data-dismiss="modal" class="link link-danger">Annuler l'opération</a>
				                            </div>
				                        </div>
                    					
                    				</div>
                    				<div class="col-md-4"></div>
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
               $('.modal-title').text("Paramètrage des entreprises");  
               $('#action').val("Add");  
          })  
          // var dataTable = $('#user_data').DataTable();
          var dataTable = $('#user_data').DataTable({  
               "processing":true,  
               "serverSide":true,  
               "order":[],  
               "ajax":{  
                    url:"<?php echo base_url() . 'admin/fetch_entreprise'; ?>",  
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
               var designation = $('#designation').val();  
               var numrcm = $('#numrcm').val(); 
               
               var action = $('#action').val();


               if(designation != '' && numrcm !='')
                {

                  if (action =="Add") {
                       
                      $.ajax({  
                           url:"<?php echo base_url() . 'admin/operation_entreprise'?>",  
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
                             url:"<?php echo base_url() . 'admin/modification_entreprise'?>",  
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
               var ide = $(this).attr("ide");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_entreprise",  
                    method:"POST",  
                    data:{ide:ide},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#userModal').modal('show');  
                         $('#designation').val(data.designation);
                         $('#numrcm').val(data.numrcm);
                         
                         $('.modal-title').text("modification de l'entreprise "+data.designation);  
                         $('#ide').val(ide);   
                         $('#action').val("Edit");  
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var ide = $(this).attr("ide");

              if(confirm("Are you sure you want to delete this?"))
		          {
		            
		           		$.ajax({
	                    url:"<?php echo base_url(); ?>admin/supression_entreprise",
	                    method:"POST",
	                    data:{ide:ide},
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





     });  
     </script>






</body>

</html>