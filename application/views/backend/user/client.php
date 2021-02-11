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
		                                        <th width="20%">Nom client</th>  
		                                        <th width="15%">Téléphone</th> 
		                                        <th width="15%">Email</th> 
		                                        <th width="20%">fullname domicile</th> 
		                                        <th width="20%">Mise à jour</th>
		                                         
		                                        <th width="5%">Modifier</th> 
		                                        <th width="5%">Supprimer</th>  
		                                    </tr>  
		                               </thead> 

		                               <tfoot>  
		                                    <tr>  
		                                        <th width="20%">Nom client</th>  
		                                        <th width="15%">Téléphone</th> 
		                                        <th width="15%">Email</th> 
		                                        <th width="20%">fullname domicile</th> 
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
                    		
                    		<div class="col-md-12">
                    			<label><i class="fa fa-user"></i> Nom du client</label>
                    			<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Entrez le nom complet du client" />
                    		</div>

                    		<div class="form-group col-md-12">
                              <label><i class="fa fa-phone"></i>N° de Téléphone</label>  
                                  <input type="text" name="tel" id="tel" class="form-control" placeholder="Saisissez son numéro de téléphone">
                            </div>

                            <div class="form-group col-md-12">
                              <label><i class="fa fa-google"></i> Adresse mail</label>  
                                  <input type="email" name="email" id="email" class="form-control" placeholder="adresse mail">
                            </div>

                            <div class="form-group col-md-12">
                              <label><i class="fa fa-map-marker"></i> Adresse domicile</label>  
                                  <textarea name="adresse" id="adresse" class="form-control" placeholder="Adresse domicile du client">
                                  	
                                  </textarea>
                            </div>

                            <div class="form-group col-md-12 text-center">
                            	<input type="hidden" name="idclient" id="idclient" />
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
               $('.modal-title').text("Paramètrage des clients");  
               $('#action').val("Add");  
          })  
          // var dataTable = $('#user_data').DataTable();
          var dataTable = $('#user_data').DataTable({  
               "processing":true,  
               "serverSide":true,  
               "order":[],  
               "ajax":{  
                    url:"<?php echo base_url() . 'user/fetch_client'; ?>",  
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
               var fullname = $('#fullname').val(); 
               var tel = $('#tel').val(); 
               var email = $('#email').val(); 
               var adresse = $('#adresse').val();  
               
               var action = $('#action').val();


               if(fullname != '' && tel != '' && email != '' && adresse != '')
                {

                  if (action =="Add") {
                       
                      $.ajax({  
                           url:"<?php echo base_url() . 'user/operation_client'?>",  
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
                             url:"<?php echo base_url() . 'user/modification_client'?>",  
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
               var idclient = $(this).attr("idclient");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>user/fetch_single_client",  
                    method:"POST",  
                    data:{idclient:idclient},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#userModal').modal('show');  
                         $('#fullname').val(data.fullname);
                         $('#tel').val(data.tel);
                         $('#adresse').val(data.adresse);
                         $('#email').val(data.email);
                         
                         
                         $('.modal-title').text("modification du client  "+data.fullname);  
                         $('#idclient').val(idclient);   
                         $('#action').val("Edit");  
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var idclient = $(this).attr("idclient");

              if(confirm("Are you sure you want to delete this?"))
		          {
		            
		           		$.ajax({
	                    url:"<?php echo base_url(); ?>user/supression_client",
	                    method:"POST",
	                    data:{idclient:idclient},
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