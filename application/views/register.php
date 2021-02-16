<!DOCTYPE html>
<html lang="en">

<head>

    <?php include('_meta.php') ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            	 <!-- <img src="<?php echo(base_url()) ?>upload/annumation/logo.jpg" class="img-responsive img-fluid" style="margin-top: 150px; padding-left: 50px;"> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Création de compte</h1>
                                       <span>
                                    		Créer un nouveau compte au système Gestion de galerie.
                                    	</span>
                                    </div>
                                    <form class="user" method="post" id="user_form" enctype="multipart/form-data" action="<?= base_url(); ?>login/register_validation">
                                    	<div class="form-group">
                                    		<?php
												if($this->session->flashdata('message'))
												{
													echo '
													<div class="alert alert-success" style="background:white;font-size: 14px;">
													<button class="close" data-dismiss="alert">x</button>
														'.$this->session->flashdata("message").'
													</div>
													';
												}
												elseif ($this->session->flashdata('message2')) {
												  echo '
													<div class="alert alert-danger" style="background:white;font-size: 14px;">
													<button class="close" data-dismiss="alert">x</button>
														'.$this->session->flashdata("message2").'
													</div>
													';
												}
												else{

												}
											?>
                                    	</div>
		                                <div class="form-group row">
		                                    <div class="col-sm-12 mb-3 mb-sm-0">
		                                        <input type="text"  name="first_name" class="form-control form-control-user" id="exampleFirstName" placeholder="Entrez votre nom">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <input type="email" name="mail_ok" class="form-control form-control-user" id="exampleInputEmail" placeholder="Entrez votre adresse mail">
		                                </div>
		                                <div class="form-group row">
		                                    <div class="col-sm-12 mb-3 mb-sm-0">
		                                        <input type="password" name="user_password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe secret">
		                                    </div>
		                                    
		                                </div>
		                                <button type="submit" class="btn btn-primary btn-user btn-block">
		                                  S'inscrire
		                                </button>
		                                <hr>
		                                <button type="button" class="btn btn-google btn-user btn-block">
		                                    <i class="fab fa-google fa-fw"></i> S'enregistrer avec Google
		                                </button>
		                                <button type="button" class="btn btn-facebook btn-user btn-block">
		                                    <i class="fab fa-facebook-f fa-fw"></i> S'enregistrer avec Facebook
		                                </button>
		                            </form>
                                    <hr>

                                    <div class="text-center">
                                        Vous avez déjà un compte ?<a class="small" href="<?php echo(base_url()) ?>login">&nbsp; S'identifier</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

   <?php include('_script.php') ?>

</body>

</html>