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

                   <div class="col-md-12 card">
                       <div class="row card-body">
                           <!-- mes scripts commencent -->
                           <?php include('component/_stat_galerie.php') ?>
                           <!-- fin de mes scripts commencent -->
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
                    			<label><i class="fa fa-map-marker"></i> Adresse de la galerie</label>
                    			<input type="text" name="adresse" id="adresse" class="form-control" placeholder="Entrez l'adresse de galerie" />
                    		</div>

                    		 <div class="form-group col-md-12">
                              <label><i class="fa fa-home"></i> Entreprise</label>  
                                  <select name="entreprise_ok" id="entreprise_ok" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Selectionnez son entreprise</option>
                                    <?php
                                      if ($entreprises->num_rows() > 0) {
                                       foreach ($entreprises->result_array() as $key) {
                                          ?>
                                           <option value="<?php echo($key['ide']) ?>"><?php echo($key['designation']) ?></option>
                                           <?php
                                       }
                                      }
                                      else{
                                        ?>
                                        <option value="">aucune entreprise n'est disponible</option>
                                        <?php
                                      }
                                    ?>
                                    
                                  </select>
                            </div>

                    		

                    		<div class="col-md-12" style="margin-bottom: 20px;">
                    			<div class="row">
                    				<div class="col-md-4"></div>
                    				<div class="col-md-4">

                    					<div class="buysell-field form-action text-center mb-2">
				                            <div>

				                            	<input type="hidden" name="ide" id="ide" />
				                            	<input type="hidden" name="idg" id="idg" />
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
               $('.modal-title').text("Paramètrage des galeries");  
               $('#action').val("Add");  
          })  
          var dataTable = $('#user_data').DataTable();
          // var dataTable = $('#user_data').DataTable({  
          //      "processing":true,  
          //      "serverSide":true,  
          //      "order":[],  
          //      "ajax":{  
          //           url:"<?php echo base_url() . 'admin/fetch_galerie'; ?>",  
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
               var adresse = $('#adresse').val();  
               
               var action = $('#action').val();


               if(adresse != '')
                {

                  if (action =="Add") {
                       
                      $.ajax({  
                           url:"<?php echo base_url() . 'admin/operation_galerie'?>",  
                           method:'POST',  
                           data:new FormData(this),  
                           contentType:false,  
                           processData:false,  
                           success:function(data)  
                           {  
                                swal('succès 👌', 'Opération reussie avec succès 👌'+data, 'success'); 
                               

                                $('#user_form')[0].reset();  
                                $('#userModal').modal('hide');  
                                // dataTable.ajax.reload();  
                           }  
                      });

                  }
                  if (action == 'Edit') {

                        $.ajax({  
                             url:"<?php echo base_url() . 'admin/modification_galerie'?>",  
                             method:'POST',  
                             data:new FormData(this),  
                             contentType:false,  
                             processData:false,  
                             success:function(data)  
                             {  
                                  swal('succès 👌', 'Opération reussie avec succès 👌'+data, 'success');
                                   

                                  $('#user_form')[0].reset();  
                                  $('#userModal').modal('hide');  
                                  // dataTable.ajax.reload();  
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
               var idg = $(this).attr("idg");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_galerie",  
                    method:"POST",  
                    data:{idg:idg},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#userModal').modal('show');  
                         $('#adresse').val(data.adresse);
                         $('#ide').val(data.ide);
                         
                         $('.modal-title').text("modification de galerie "+data.adresse);  
                         $('#idg').val(idg);   
                         $('#action').val("Edit");  
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var idg = $(this).attr("idg");

              if(confirm("Are you sure you want to delete this?"))
		          {
		            
		           		$.ajax({
	                    url:"<?php echo base_url(); ?>admin/supression_galerie",
	                    method:"POST",
	                    data:{idg:idg},
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

          $("#entreprise_ok").on("change", function(t) {

            var ide = $(this).val();
            if (ide !='') {
                $('#ide').val(ide);
            }
            else{

                 $('#ide').val("");                 
                swal("Ouf!!!", "Veillez complèter son entreprise 😰", "error"); 
            }
        });





     });  
     </script>



</body>

</html>