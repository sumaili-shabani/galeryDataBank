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
                            	 <img src="<?php echo(base_url()) ?>upload/annumation/logo.jpg" class="img-responsive img-fluid" style="margin-top: 150px; padding-left: 50px;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Authentification</h1>
                                       <span>
                                    		Accédez au portail  en utilisant votre e-mail et votre code d'accès.
                                    	</span>
                                    </div>
                                    <form class="user" method="post" action="<?php echo base_url(); ?>login/validation">
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
                                        <div class="form-group">
                                            <input type="email" name="user_email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Entrez votre adresse mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="user_password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Entrez votre mot de passe">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Souvenez-vous de moi
                                                </label>
                                            </div>
                                        </div>
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            Se connecter
                                        </button>
                                        <hr>
                                        <button  type="button" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Se connecter avec Google
                                        </button>
                                        <button  type="button" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Se connecter avec Facebook
                                        </button>
                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="<?php echo(base_url()) ?>login/forgot">Mot de passe oublié?</a>
                                    </div>
                                    <div class="text-center">
                                        <!-- <a class="small" href="register.html">Create an Account!</a> -->
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