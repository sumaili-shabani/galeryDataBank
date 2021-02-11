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
                          <?php include('_paiement_compte_filtrage.php') ?>
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
                        <span class="nk-block-title modal-title">Paramètrage paiement</span>
                        
                    </div>
                    <div class="nk-block">

                      

                      <form method="post" id="user_form" enctype="multipart/form-data" class="col-md-12">
                        
                        <div class="col-md-12">
                            <div class="row">

                               <div class="form-group col-md-12">
                                  <label><i class="fa fa-user"></i> Nom de location</label>
                                     <select  name="Hommes" id="Hommes" class="form-control selectpicker" data-live-search="true">
                                      <?php 
                                      if ($locations->num_rows() > 0) {
                                        ?>
                                        <option value="">Selectionnez le nom de location</option>
                                        <?php
                                        foreach ($locations->result_array() as $key) {
                                          ?>
                                          <option value="<?php echo($key['idl']) ?>">
                                            <?php echo($key['nom'].' - '.$key['fullname']) ?></option>
                                          <?php
                                        }
                                      }
                                      else{

                                        ?>
                                        <option value="">Aucune location n'est diponible</option>
                                        <?php
                                      }
                                      ?>
                                      
                                     </select> 
                              </div>

                                

                                <div class="form-group col-md-12">
                                    <label><i class="fa fa-calendar"></i> Date de  paiement </label>
                                    <input type="date" name="date_paie" id="date_paie" class="form-control" />  
                                </div>

                                <div class="form-group col-md-6">
                                    <label><i class="fa fa-calendar"></i> Entrez le montant</label>
                                    <input type="number" min="1" name="montant" id="montant" class="form-control" placeholder="10 $" />  
                                </div>

                                <div class="form-group col-md-6">
                                    <label><i class="fa fa-certificate"></i> Nombre de mois</label>
                                    <input type="number" min="1" name="mois" id="mois" class="form-control" placeholder="2 mois" />  
                                </div>

                                 <div class="form-group col-md-12">
                              <label><i class="fa fa-map"></i> Entrez le motif de paiement</label>
                              <textarea name="motif" id="motif" placeholder="Entrez le motif de paiement" class="form-control"></textarea>
                          </div>

                          <div class="col-md-12 aff">
                              <div class="row">
                                <div class="col-md-5">
                                  <span id="nom_complet" class="text-center"></span>
                                </div>
                                
                                <div class="col-md-5">
                                  <span id="info" class="text-center"></span>
                                </div>
                                <div class="col-md-2">
                                  <span id="user_uploaded_image"></span>
                                </div>

                              </div>
                            </div>

                            </div>
                        </div>


                        

                        <div class="buysell-field form-action text-center mb-2">
                              <div>

                                <input type="hidden" name="idl" id="idl" placeholder="idlocation" />

                                <input type="hidden" name="idclient" id="idclient" placeholder="idclient" />

                                <input type="hidden" name="mount" id="mount" />

                                <input type="hidden" name="idp" id="idp" />
                                <input type="hidden" name="operation" id="operation" />

                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                              </div>
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



    
    <script type="text/javascript">
      $(document).ready(function(){
        // alert("cool");
        $('.selectpicker').selectpicker();
      });
    </script>

    <script type="text/javascript" language="javascript" >  
     $(document).ready(function(){  
          $('#add_button').click(function(){  
               $('#user_form')[0].reset();  
               $('.modal-title').text("Paiement de clients");  
               $('#action').val("Add");  
               $('#user_uploaded_image').html(''); 
               $('.aff').hide(); 
          }) ;

          var dataTable = $('#user_data').DataTable();

          // var dataTable = $('#user_data').DataTable({  
          //      "processing":true,  
          //      "serverSide":true,  
          //      "order":[],  
          //      "ajax":{  
          //           url:"<?php echo base_url() . 'admin/fetch_paiement'; ?>",  
          //           type:"POST"  
          //      },  
          //      "columnDefs":[  
          //           {  
          //                "targets":[0, 3, 4],  
          //                "orderable":false,  
          //           },  
          //      ],  
          // });

          $(document).on('submit', '#user_form', function(event){  
               event.preventDefault();  
               var idl = $('#idl').val(); 
               var date_paie = $('#date_paie').val();
               var montant = $('#montant').val();
               var motif = $('#motif').val();
               
               var nom_complet = $('#nom_complet').val();
               
               
               var action = $('#action').val();

               // alert(nomtbl_info+" description:"+description+" action:"+action);


               if(idl != ''  && date_paie != '' && montant !='' && motif !='')
                {

                  if (action =="Add") {
                       
                     if (montant >= 1) {

                       $.ajax({  
                             url:"<?php echo base_url() . 'admin/operation_paiement'?>",  
                             method:'POST',  
                             data:new FormData(this),  
                             contentType:false,  
                             processData:false,  
                             success:function(data)  
                             {  
                                  swal('succès', ''+data, 'success'); 
                                  $('#user_form')[0].reset();  
                                  $('#userModal').modal('hide');  
                                  dataTable.ajax.reload();  
                             }  
                        });

                     }
                     else{
                      swal('erreur!!!', "veillez entrer un montant supperieur à 1$", 'info');
                     }
                        // alert("insertion");

                  }
                  if (action == 'Edit') {

                      if (montant >= 1) {

                         $.ajax({  
                               url:"<?php echo base_url() . 'admin/modification_paiement'?>",  
                               method:'POST',  
                               data:new FormData(this),  
                               contentType:false,  
                               processData:false,  
                               success:function(data)  
                               {  
                                    swal('succès', ''+data, 'success'); 
                                    $('#user_form')[0].reset();  
                                    $('#userModal').modal('hide');  
                                    dataTable.ajax.reload();  
                               }  
                          });

                      }
                       else{
                        swal('erreur!!!', "veillez entrer un montant supperieur à 1$", 'info');
                      }

                        

                  }

                }
                else
                {
                  // swall("Tous les champs doivent être remplis", "", "danger");
                  swal("Erreur!!!", "Tous les champs doivent être remplis", "error");
                }


                 
          });  


          $(document).on('click', '.update', function(){  
               var idp = $(this).attr("idp");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_paiement",  
                    method:"POST",  
                    data:{idp:idp},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                       $('.aff').show();
                         $('#userModal').modal('show');  
                         $('#date_paie').val(data.date_paie);
                         $('#idl').val(data.idl);
                         $('#montant').val(data.montant);
                         $('#motif').val(data.motif);

                         $('#mount').val(data.montant);
                         var idl = data.idl;

                         detail_user(idl);
                         
                         $('.modal-title').text("modification de paiement ");  
                         $('#idp').val(idp);  
                         $('#user_uploaded_image').html(data.user_image);  
                         $('#action').val("Edit"); 
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var idp = $(this).attr("idp");

              if(confirm("Etes-vous sûre de vouloire le supprimer?"))
            {
              
                $.ajax({
                      url:"<?php echo base_url(); ?>admin/supression_paiement",
                      method:"POST",
                      data:{idp:idp},
                      success:function(data)
                      {
                         swal("succès!", ''+data, "success");
                         dataTable.ajax.reload();
                      }
                    });
            }
            else
            {
              swal("Ouf!!!", "opération annulée :)", "error");
            }

                


          });

          $(document).on('change', '#Hommes',function(){
              var idl = $(this).val();
              if (idl !='') {
                $('#idl').val(idl);
                detail_user(idl);
              }
              else{
                swal("Erreur!!!","veillez selectionner le nom de la location","error");
              }
              
            
          });


          $(document).on('keyup', '#mois', function(event) {
            event.preventDefault();
            var nombre  = $(this).val();
            var montant = $('#mount').val();

            if (montant !='') {

              var produit  = montant * nombre;
              $('#montant').val(produit);

            }
            else{
              swal("Erreur!!!", "veillez completer le montant", 'error');
            }
            
            /* Act on the event */
          });



          function detail_user(idl){

            if (idl !='') {
              
              $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_location_2",  
                    method:"POST",  
                    data:{idl:idl},  
                    dataType:"json",  
                    success:function(data)  
                    {   
                         
                         $('.aff').show();

                         $('#idclient').val(data.idclient);
                         $('#montant').val(data.montant);
                         $('#mount').val(data.montant);
            
                         $('#nom_complet').html('<i class="fa fa-user"> Nom:</i> '+data.fullname+' <br/><i class="fa fa-phone"> N° de téléphone:</i> '+data.tel+' <i class="fa fa-google"> Email:</i> '+data.email+' <i class="fa fa-calendar"> Date debit:</i><br/> '+data.date_debit);

                         $('#info').html('<i class="fa fa-map-marker"> Adresse:</i> '+data.adresse+' <i class="fa fa-home"> Chambre</i> :<br/>'+data.nom+ '<br/><i class="fa fa-calendar"> Date fin:</i> <br/>'+data.date_fin);
                         
                    }  
               });  

            }
            else{
              swal("Erreur!!!","veillez selectionner le nom de la location","error");
            }

          }




     });  
     </script>




</body>

</html>