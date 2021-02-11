<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  
class admin extends CI_Controller
{
	private $token;
	private $connected;
	public function __construct()
	{
	  parent::__construct();
	  if(!$this->session->userdata('admin_login'))
	  {
	      	redirect(base_url().'login');
	  }
	  $this->load->library('form_validation');
	  $this->load->library('encrypt');
      $this->load->library('pdf');
	  $this->load->model('crud_model'); 

	  $this->load->helper('url');

	  $this->token = "sk_test_51GzffmHcKfZ3B3C9DATC3YXIdad2ummtHcNgVK4E5ksCLbFWWLYAyXHRtVzjt8RGeejvUb6Z2yUk740hBAviBSyP00mwxmNmP1";
	  $this->connected = $this->session->userdata('admin_login');

	  /*
	  je script pour les galeries du contrat d'expiration
	
		// $this->crud_model->show_galery_expire();
		$this->crud_model->show_galery_expire();
	  */



	}

	function index(){
		$data['title']="mon profile admin";
		$this->load->view('backend/admin/exemple', $data);
  		// $this->load->view('backend/admin/templete_admin', $data);
	}

	function dashbord(){
		  $data['title']="Tableau de bord";
	      $data['nombre_location'] = $this->crud_model->statistiques_nombre("profile_location");

	      $data['nombre_paiement'] = $this->crud_model->statistiques_nombre("paiement");

	      $data['nombre_chambre'] = $this->crud_model->statistiques_nombre("profile_chambre");
	      $data['nombre_users'] = $this->crud_model->statistiques_nombre("users");
	      $this->load->view('backend/admin/dashbord', $data);
	}

	function profile(){
      $data['title']="mon profile admin";
      $data['users'] = $this->crud_model->fetch_connected($this->connected);
      // $this->load->view('backend/admin/viewx', $data);
      $this->load->view('backend/admin/profile', $data);
    }

    function basic(){
        $data['title']="Information basique de mon compte";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $this->load->view('backend/admin/basic', $data);
    }

    function basic_image(){
        $data['title']="Information basique de ma photo";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $this->load->view('backend/admin/basic_image', $data);
    }

    function basic_secure(){
        $data['title']="Paramètrage de sécurité de mon compte";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $this->load->view('backend/admin/basic_secure', $data);
    }

    function notification($param1=''){
      $data['title']    ="Listes des formations";
      $data['users']    = $this->crud_model->fetch_connected($this->connected);
      $this->load->view('backend/admin/notification', $data);
    }

	function role(){
		$data['title']="Paramétrage  privilège  au système";
		$this->load->view('backend/admin/role', $data);		
	}

	function poste(){
		$data['title']="Paramétrage  de poste";
		$this->load->view('backend/admin/poste', $data);		
	}

	function type(){
		$data['title']="Paramétrage  de type de chambres";
		$this->load->view('backend/admin/type', $data);		
	}

	function entreprise(){
		$data['title']="Paramétrage  des entreprises";
		$this->load->view('backend/admin/entreprise', $data);		
	}

	function galerie(){
		$data['title']="Paramétrage  des galeries";
		$data['entreprises']  = $this->crud_model->Select_entreprises();
		$this->load->view('backend/admin/galerie', $data);		
	}

	function client(){
		$data['title']="Paramétrage  des clients";
		$data['entreprises']  = $this->crud_model->Select_entreprises();
		$this->load->view('backend/admin/client', $data);		
	}

	function chambre(){
		$data['title']="Paramétrage  des clients";
		$data['types']  	= $this->crud_model->Select_types();
		$data['galeries']  	= $this->crud_model->Select_galeries();
		$this->load->view('backend/admin/chambre', $data);		
	}

	function location(){
		$data['title']="Paramétrage  des locations";
		$data['chambres']  	= $this->crud_model->Select_chambres();
		$data['clients']  	= $this->crud_model->Select_clients();
		$this->load->view('backend/admin/location', $data);		
	}

	// script pour la sauvegarge de données 
    function database($param1 = '', $param2 = '')
    {
        
        if($param1 == 'restore')
        {
            // $this->crud_model->import_db();
            $this->session->set_flashdata('message',"Importation de la base des données avec succès!!!");
            redirect(base_url() . 'admin/database/', 'refresh');
        }
        if($param1 == 'create')
        {
          $this->crud_model->create_backup();
          $this->session->set_flashdata('message',"Sauvegarde de la base des données avec succès!!!");
          redirect(base_url() . 'admin/database/', 'refresh');

        }

        $this->crud_model->show_galery_expire();

        $data['title'] = "Sauvegarde et restauration de la base des données";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $this->load->view('backend/admin/database', $data);
    }
    // fin script sauvegarde des données 



	function compte(){
		$data['title']="Paramétrage  des clients";
		$data['chambres']  	= $this->crud_model->Select_chambres();
		$data['locations']  	= $this->crud_model->Select_locations();

		$data['title']    ="Paramétrage  de paiement des apprenants";

      	$data['users']    = $this->crud_model->fetch_connected($this->connected);

      	$data['dates']    = $this->crud_model->fetch_categores_dates_compt();


		$this->load->view('backend/admin/compte', $data);		
	}

	function impression_pdf_paiemant_list($param1=''){
       $customer_id = "paiement facture ".$param1;
       $html_content = '';
       $html_content .= $this->crud_model->fetch_single_details_comptabilite_system($param1);

       // echo($html_content);
       $this->pdf->loadHtml($html_content);
       $this->pdf->render();
       $this->pdf->stream("paiement reçu_".$customer_id.".pdf", array("Attachment"=>0));
    }

    function impression_pdf_paiement_au_system_filtrage($param1='', $param2=''){
       $customer_id = "liste des paiements par fultrage du ".$param1."jusqu'au ".$param2;
       $html_content = "";
       $html_content .= $this->crud_model->fetch_single_details_comptabilite_filtre_paiement($param1,$param2);
       // echo($html_content);
       $this->pdf->loadHtml($html_content);
       $this->pdf->render();
       $this->pdf->stream("liste".$customer_id.".pdf", array("Attachment"=>0));
    }

    function filtrage_comptabilite(){
        $param1 = $this->input->post('date1');
        $param2 = $this->input->post('date2');

        $data['title']="Paramètrage de la comptabilité";

        $data['chambres']  	= $this->crud_model->Select_chambres();
		$data['locations']  	= $this->crud_model->Select_locations();

        $data['dates']    = $this->crud_model->fetch_categores_dates_compt();

        if ($param1 > $param2) {

	          $data['dates1'] = $param2;
	          $data['dates2'] = $param1;
	          $data['donnees'] = $this->crud_model->fetch_all_paiements($param2, $param1);
        }
        else{

	          $data['dates1'] = $param1;
	          $data['dates2'] = $param2;
	          $data['donnees'] = $this->crud_model->fetch_all_paiements($param1, $param2);

        }

        $this->load->view('backend/admin/filtrage_comptabilite', $data);

    }

	function stat_filtrage_galerie_ap(){
        $param1 = $this->input->post('date1');
        
        $data['dates1'] = $param1;

        $data['title']="Statistique et liste des galeries";

        $data['users']      = $this->crud_model->fetch_connected($this->connected);

        $data['entreprises']   = $this->crud_model->Select_entreprises();

        if ($param1 !='') {
          
          $data['donnees'] = $this->crud_model->fetch_all_entreprise_inscrits($param1);
          
        }
        else{

          $data['donnees'] = $this->crud_model->fetch_all_entreprise_all();
         
        }
       

        $this->load->view('backend/admin/stat_filtrage_galerie_ap', $data);

    }

    function impression_pdf_entreprise_filtrage($param1='', $param2=''){

       $nom_entreprise = $this->crud_model->fetch_nom_etreprise_by_id($param1);

       $customer_id = "liste des galeries de l'entreprise ".$nom_entreprise;
       $html_content = "";
       $html_content .= $this->crud_model->fetch_single_details_formations_filtre($param1);

       // echo($html_content);

       $this->pdf->loadHtml($html_content);
       $this->pdf->render();
       $this->pdf->stream("".$customer_id.".pdf", array("Attachment"=>0));
    }

    function stat_paiement(){
      $data['title']="statistique sur le paiement";
      $data['nombre_location'] = $this->crud_model->statistiques_nombre("profile_location");

      $data['nombre_paiement'] = $this->crud_model->statistiques_nombre("paiement");

      $data['nombre_chambre'] = $this->crud_model->statistiques_nombre("profile_chambre");
      $data['nombre_users'] = $this->crud_model->statistiques_nombre("users");
      $this->load->view('backend/admin/stat_paiement', $data);
    }

	function users(){
      $data['title']="Opération sur les utilisateurs";
      $data['nombre_users']   = $this->crud_model->statistiques_nombre("users");
      $data['nombre_users_m'] = $this->crud_model->statistiques_nombre_where("users","sexe","M");
      $data['nombre_users_f'] = $this->crud_model->statistiques_nombre_where("users","sexe","F");
      $data['nombre_users_a'] = $this->crud_model->statistiques_nombre_where_null("users","sexe","NULL");
      $data['users']  = $this->crud_model->Select_users();   
      $data['roles']  = $this->crud_model->Select_roles(); 
      $data['postes']  = $this->crud_model->Select_postes();   
      $this->load->view('backend/admin/users', $data);
    }

    function stat_users(){
	    $data['title']="Statistique sur nos utilisateurs";
	    $data['nombre_users']   = $this->crud_model->statistiques_nombre("users");
	    $data['nombre_users_m'] = $this->crud_model->statistiques_nombre_where("users","sexe","M");
	    $data['nombre_users_f'] = $this->crud_model->statistiques_nombre_where("users","sexe","F");
	    $data['nombre_users_a'] = $this->crud_model->statistiques_nombre_where_null("users","sexe","NULL");
	    $this->load->view('backend/admin/stat_users', $data);
	}


	function modification_panel($param1='', $param2='', $param3=''){

      if ($param1="option1") {
         $data = array(
            'first_name'        => $this->input->post('first_name'),
            'last_name'       => $this->input->post('last_name'),
            'telephone'       => $this->input->post('telephone'),
            'full_adresse'      => $this->input->post('full_adresse'),
            'biographie'        => $this->input->post('biographie'),
            'date_nais'       => $this->input->post('date_nais'),
            'sexe'          => $this->input->post('sexe'),
            'email'         => $this->input->post('mail_ok'), 

            'facebook'        => $this->input->post('facebook'),
            'linkedin'        => $this->input->post('linkedin'),
            'twitter'         => $this->input->post('twitter')
        );

        $id_user= $this->connected;
        $query = $this->crud_model->update_crud($id_user, $data);
        $this->session->set_flashdata('message', 'votre profile a été mis à jour avec succès!!!🆗');
         redirect('admin/basic', 'refresh');
      }

  }

  function modification_photo(){

     $id_user= $this->connected;
     if ($_FILES['user_image']['size'] > 0) {
       # code...
        $data = array(
          'image'     => $this->upload_image()
        );
       $query = $this->crud_model->update_crud($id_user, $data);
       $this->session->set_flashdata('message', 'modification avec succès');
           redirect('admin/basic_image', 'refresh');
     }
     else{

        $this->session->set_flashdata('message2', 'Veillez selectionner la photo');
        redirect('admin/basic_image', 'refresh');

     }
     
  }


  function upload_image()  
  {  
       if(isset($_FILES["user_image"]))  
       {  
            $extension = explode('.', $_FILES['user_image']['name']);  
            $new_name = rand() . '.' . $extension[1];  
            $destination = './upload/photo/' . $new_name;  
            move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
            return $new_name;  
       }  
  }

  function modification_account($param1=''){
       $id_user= $this->connected;
       $first_name;

       $passwords = md5($this->input->post('user_password_ancien'));
       
       $users = $this->db->query("SELECT * FROM users WHERE passwords='".$passwords."' AND id='".$id_user."' ");

       if ($users->num_rows() > 0) {
          
          foreach ($users->result_array() as $row) {
            $first_name = $row['first_name'];
            // echo($first_name);
             $nouveau   =  $this->input->post('user_password_nouveau');
             $confirmer =  $this->input->post('user_password_confirmer');
             if ($nouveau == $confirmer) {
              $new_pass= md5($nouveau);

              $data = array(
                  'passwords'  => $new_pass
                );

                 $query = $this->crud_model->update_crud($id_user, $data);
                 $this->session->set_flashdata('message', 'votre clée de sécurité a été changer avec succès '.$first_name);
                   redirect('admin/basic_secure', 'refresh');

               }
               else{
   
                $this->session->set_flashdata('message2', 'les deux mot de passe doivent être identiques');
                redirect('admin/basic_secure', 'refresh');
               }
         
          }

       }
       else{

          $this->session->set_flashdata('message2', 'information incorecte');
          redirect('admin/basic_secure', 'refresh');
       }
     
  } 

  function view_1($param1='', $param2='', $param3=''){
      
	  if($param1=='display_delete') {
	  	$this->session->set_flashdata('message', 'suppression avec succès ');
	    $query = $this->crud_model->delete_notifacation_tag($param2);
	    redirect('admin/notification');
	  }

	  if($param1=='display_delete_message') {

	    $query = $this->crud_model->delete_message_tag($param3);
	    redirect('admin/message/'.$param2);
	  }
	  else{

	  }

  }

  // script de role
  function fetch_role(){  

       $fetch_data = $this->crud_model->make_datatables_role();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->nom, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idrole="'.$row->idrole.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idrole="'.$row->idrole.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_role(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_role(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_role()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_role($_POST["idrole"]);  
       foreach($data as $row)  
       {  
            $output['nom'] 		= $row->nom;  
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_role(){

      $insert_data = array(  
           'nom'           	=>     $this->input->post('nom')
	  );  

      $requete=$this->crud_model->insert_role($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_role(){

      $updated_data = array(  
           'nom'           	=>     $this->input->post('nom')
	  );

      $this->crud_model->update_role($this->input->post("idrole"), $updated_data);

      echo("modification avec succès");
  }

  function supression_role(){

      $this->crud_model->delete_role($this->input->post("idrole"));
      echo("suppression avec succès");
    
  }

  // script des utilisateurs 
      function fetch_users(){  

           $fetch_data = $this->crud_model->make_datatables_users();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

           		if ($row->idrole != 1) {
           			
           			$sub_array = array();  
	                $sub_array[] = '<img src="'.base_url().'upload/photo/'.$row->image.'" class="img-thumbnail user-avatar bg-success  d-sm-flex" width="50" height="35" />';  
	                $sub_array[] = nl2br(substr($row->first_name, 0,50)).'...';  
	                $sub_array[] = nl2br(substr($row->last_name, 0,50)).'...'; 

	                $sub_array[] = nl2br(substr($row->sexe, 0,50)).'';

	                $sub_array[] = nl2br(substr($row->email, 0,50));

	                $sub_array[] = nl2br(substr($row->telephone, 0,50));
	                $sub_array[] = nl2br(substr($row->nom.'/'.$row->designation, 0,20)).'...';

	                
	 
	                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-sm btn-circle update"><i class="fa fa-edit"></i></button>'; 

	                $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-sm btn-circle delete"><i class="fa fa-trash"></i></button>';
	                
	                $data[] = $sub_array; 
           		}
                
           }  
           $output = array(  
                "draw"                =>     intval($_POST["draw"]),  
                "recordsTotal"        =>     $this->crud_model->get_all_data_users(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_users(),  
                "data"                =>     $data  
           );  
           echo json_encode($output);  
      }

      function operation_users(){

          if($_FILES["user_image"]["size"] > 0)  
          {  
               $insert_data = array(  
                   'first_name'     =>     $this->input->post('first_name'),  
                   'last_name'      =>     $this->input->post("last_name"),
                   'email'          =>     $this->input->post("email"),
                   'telephone'      =>     $this->input->post("telephone"),
                   'full_adresse'   =>     $this->input->post("full_adresse"),
                   'date_nais'      =>     $this->input->post("date_nais"), 
                   'idrole'         =>     $this->input->post("idrole"),
                   'idposte'        =>     $this->input->post("idposte"),
                   'sexe'           =>     $this->input->post("sexe"),
                   'facebook'       =>     $this->input->post("facebook"),
                   'twitter'        =>     $this->input->post("twitter"),
                   'linkedin'       =>     $this->input->post("linkedin"),
                   'passwords'      =>     md5(123456),
                   'image'          =>     $this->upload_image_users()
                );    
          }  
          else  
          {  
                 $user_image = "icone-user.png";  
                 $insert_data = array(  
                   'first_name'     =>     $this->input->post('first_name'),  
                   'last_name'      =>     $this->input->post("last_name"),
                   'email'          =>     $this->input->post("email"),
                   'telephone'      =>     $this->input->post("telephone"),
                   'full_adresse'   =>     $this->input->post("full_adresse"),
                   'date_nais'      =>     $this->input->post("date_nais"), 
                   'idrole'         =>     $this->input->post("idrole"),
                   'idposte'        =>     $this->input->post("idposte"),
                   'sexe'           =>     $this->input->post("sexe"),
                   'facebook'       =>     $this->input->post("facebook"),
                   'twitter'        =>     $this->input->post("twitter"),
                   'linkedin'       =>     $this->input->post("linkedin"),
                   'image'          =>     $user_image
                );   
          }

        $requete=$this->crud_model->insert_users($insert_data);
        echo("Ajout information avec succès");
        
      }

      function modification_users(){

          if($_FILES["user_image"]["size"] > 0)  
          {  
               $updated_data = array(  
                   'first_name'     =>     $this->input->post('first_name'),  
                   'last_name'      =>     $this->input->post("last_name"),
                   'email'          =>     $this->input->post("email"),
                   'telephone'      =>     $this->input->post("telephone"),
                   'full_adresse'   =>     $this->input->post("full_adresse"),
                   'date_nais'      =>     $this->input->post("date_nais"), 
                   'sexe'           =>     $this->input->post("sexe"),
                   'facebook'       =>     $this->input->post("facebook"),
                   'twitter'        =>     $this->input->post("twitter"),
                   'linkedin'       =>     $this->input->post("linkedin"),
                   'idposte'        =>     $this->input->post("idposte"),
                   'image'          =>     $this->upload_image_users()
                );    
          }  
          
          else  
          {   
               $updated_data = array(  
                   'first_name'     =>     $this->input->post('first_name'),  
                   'last_name'      =>     $this->input->post("last_name"),
                   'email'          =>     $this->input->post("email"),
                   'telephone'      =>     $this->input->post("telephone"),
                   'full_adresse'   =>     $this->input->post("full_adresse"),
                   'date_nais'      =>     $this->input->post("date_nais"), 
                   'sexe'           =>     $this->input->post("sexe"),
                   'facebook'       =>     $this->input->post("facebook"),
                   'twitter'        =>     $this->input->post("twitter"),
                   'idposte'        =>     $this->input->post("idposte"),
                   'linkedin'       =>     $this->input->post("linkedin")
                );   
          }
  
          
          $this->crud_model->update_users($this->input->post("id"), $updated_data);

          echo("modification avec succès");
      }

      function supression_users(){
 
          $this->crud_model->delete_users($this->input->post("id"));
          echo("suppression avec succès");
        
      }


      function fetch_single_users()  
      {  
           $output = array();  
           $data = $this->crud_model->fetch_single_users($this->input->post('id'));  
           foreach($data as $row)  
           {  
                $output['first_name'] = $row->first_name;  
                $output['last_name'] = $row->last_name; 

                $output['email'] = $row->email;
                $output['telephone'] = $row->telephone;
                $output['full_adresse'] = $row->full_adresse;
                $output['biographie'] = $row->biographie;
                $output['date_nais'] = $row->date_nais;
                $output['sexe'] = $row->sexe;
                $output['idrole'] = $row->idrole;
                $output['idposte'] = $row->idposte;

                $output['facebook'] = $row->facebook;
                $output['linkedin'] = $row->linkedin;
                $output['twitter'] = $row->twitter;
                $output['image'] = $row->image;

                if($row->image != '')  
                {  
                     $output['user_image'] = '<img src="'.base_url().'upload/photo/'.$row->image.'" class="img-thumbnail" width="300" height="250" /><input type="hidden" name="hidden_user_image" value="'.$row->image.'" />';  
                }  
                else  
                {  
                     $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
                }  

                
           }  
           echo json_encode($output);  
      }

    // script de poste
  function fetch_poste(){  

       $fetch_data = $this->crud_model->make_datatables_poste();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->designation, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idposte="'.$row->idposte.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idposte="'.$row->idposte.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_poste(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_poste(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_poste()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_poste($_POST["idposte"]);  
       foreach($data as $row)  
       {  
            $output['designation'] 		= $row->designation;  
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_poste(){

      $insert_data = array(  
           'designation'           	=>     $this->input->post('designation')
	  );  

      $requete=$this->crud_model->insert_poste($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_poste(){

      $updated_data = array(  
           'designation'           	=>     $this->input->post('designation')
	  );

      $this->crud_model->update_poste($this->input->post("idposte"), $updated_data);

      echo("modification avec succès");
  }

  function supression_poste(){

      $this->crud_model->delete_poste($this->input->post("idposte"));
      echo("suppression avec succès");
    
  }

// fin de script  poste 

  // script de entreprise
  function fetch_entreprise(){  

       $fetch_data = $this->crud_model->make_datatables_entreprise();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->designation, 0,50)).' ...';
            $sub_array[] = nl2br(substr($row->numrcm, 0,50)).' ...'; 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" ide="'.$row->ide.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" ide="'.$row->ide.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_entreprise(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_entreprise(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_entreprise()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_entreprise($_POST["ide"]);  
       foreach($data as $row)  
       {  
            $output['designation']  = $row->designation;
            $output['numrcm'] 		= $row->numrcm;  
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_entreprise(){

      $insert_data = array(  
           'designation'        =>     $this->input->post('designation'),
           'numrcm'           	=>     $this->input->post('numrcm')
	  );  

      $requete=$this->crud_model->insert_entreprise($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_entreprise(){

      $updated_data = array(  
          'designation'        =>     $this->input->post('designation'),
          'numrcm'           	=>     $this->input->post('numrcm')
	  );

      $this->crud_model->update_entreprise($this->input->post("ide"), $updated_data);

      echo("modification avec succès");
  }

  function supression_entreprise(){

      $this->crud_model->delete_entreprise($this->input->post("ide"));
      echo("suppression avec succès");
    
  }

// fin de script  entreprise 

  // script de galerie
  function fetch_galerie(){  

       $fetch_data = $this->crud_model->make_datatables_galerie();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
            $sub_array[] = nl2br(substr($row->adresse, 0,50)).' ...';
            $sub_array[] = nl2br(substr($row->designation, 0,50)).' ...';
            $sub_array[] = nl2br(substr($row->numrcm, 0,50)).' ...'; 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idg="'.$row->idg.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idg="'.$row->idg.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_galerie(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_galerie(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_galerie()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_galerie($_POST["idg"]);  
       foreach($data as $row)  
       {  
            $output['adresse'] 		= $row->adresse; 
            $output['ide'] 		= $row->ide;   
       }  
       echo json_encode($output);  
  }  


  function operation_galerie(){

      $insert_data = array(  
           'adresse'        =>     $this->input->post('adresse'),
           'ide'           	=>     $this->input->post('ide')
	  );  

      $requete=$this->crud_model->insert_galerie($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_galerie(){

      $updated_data = array(  
          'adresse'        =>     $this->input->post('adresse'),
          'ide'           	=>     $this->input->post('ide')
	  );

      $this->crud_model->update_galerie($this->input->post("idg"), $updated_data);

      echo("modification avec succès");
  }

  function supression_galerie(){

      $this->crud_model->delete_galerie($this->input->post("idg"));
      echo("suppression avec succès");
  }

// fin de script  galerie 

  // script de type
  function fetch_type(){  

       $fetch_data = $this->crud_model->make_datatables_type();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->designation, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idtype="'.$row->idtype.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idtype="'.$row->idtype.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_type(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_type(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_type()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_type($_POST["idtype"]);  
       foreach($data as $row)  
       {  
            $output['designation'] 		= $row->designation;  
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_type(){

      $insert_data = array(  
           'designation'     =>     $this->input->post('designation')
	  );  

      $requete=$this->crud_model->insert_type($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_type(){

      $updated_data = array(  
           'designation'           	=>     $this->input->post('designation')
	  );

      $this->crud_model->update_type($this->input->post("idtype"), $updated_data);

      echo("modification avec succès");
  }

  function supression_type(){

      $this->crud_model->delete_type($this->input->post("idtype"));
      echo("suppression avec succès");
    
  }

// fin de script  type 

    // script de client
  function fetch_client(){  

       $fetch_data = $this->crud_model->make_datatables_client();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->fullname, 0,50));
            $sub_array[] = nl2br(substr($row->tel, 0,15));
            $sub_array[] = nl2br(substr($row->email, 0,20));

            $sub_array[] = nl2br(substr($row->adresse, 0,20));

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idclient="'.$row->idclient.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idclient="'.$row->idclient.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_client(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_client(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_client()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_client($_POST["idclient"]);  
       foreach($data as $row)  
       {  
            $output['fullname'] 	= $row->fullname;
            $output['tel'] 			= $row->tel;
            $output['email'] 		= $row->email;
            $output['adresse'] 		= $row->adresse;
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_client(){

      $insert_data = array(  
           'fullname'   =>     $this->input->post('fullname'),
           'tel'     	=>     $this->input->post('tel'),
           'email'     	=>     $this->input->post('email'),
           'adresse'    =>     $this->input->post('adresse')
	  );  

      $requete=$this->crud_model->insert_client($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_client(){

      $updated_data = array(  
           'fullname'   =>     $this->input->post('fullname'),
           'tel'     	=>     $this->input->post('tel'),
           'email'     	=>     $this->input->post('email'),
           'adresse'    =>     $this->input->post('adresse')
	  );

      $this->crud_model->update_client($this->input->post("idclient"), $updated_data);
      echo("modification avec succès");
  }

  function supression_client(){

      $this->crud_model->delete_client($this->input->post("idclient"));
      echo("suppression avec succès");
    
  }

  // fin de script  client 

  // script de chambre
  function fetch_chambre(){  

       $fetch_data = $this->crud_model->make_datatables_chambre();  
       $data = array(); 
       $etat =''; 
       foreach($fetch_data as $row)  
       {  
            $sub_array = array(); 

            if ($row->etat == 0) {
             	$etat ='<span class="badge badge-info">innocupée</span>';
            }
            else{
            	$etat ='<span class="badge badge-success">occupée</span>';
            } 
           
            $sub_array[] = nl2br(substr($row->nom, 0,50)).' ...';
            $sub_array[] = nl2br(substr($row->designation, 0,15)).' ...';
            $sub_array[] = nl2br(substr($row->adresse, 0,20)).' ...';

            $sub_array[] = nl2br(substr($row->montant, 0,20));
            $sub_array[] = $etat;

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idchambre="'.$row->idchambre.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idchambre="'.$row->idchambre.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_chambre(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_chambre(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_chambre()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_chambre($_POST["idchambre"]);  
       foreach($data as $row)  
       {  
            $output['nom'] 	= $row->nom;
            $output['idg'] 			= $row->idg;
            $output['idtype'] 		= $row->idtype;
            $output['montant'] 		= $row->montant;
       }  
       echo json_encode($output);  
  }  


  function operation_chambre(){

      $insert_data = array(  
           'nom'   		=>     $this->input->post('nom'),
           'idg'     	=>     $this->input->post('idg'),
           'idtype'    	=>     $this->input->post('idtype'),
           'montant'    =>     $this->input->post('montant')
	  );  

      $requete=$this->crud_model->insert_chambre($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_chambre(){

      $updated_data = array(  
           'nom'   		=>     $this->input->post('nom'),
           'idg'     	=>     $this->input->post('idg'),
           'idtype'    	=>     $this->input->post('idtype'),
           'montant'    =>     $this->input->post('montant')
	  );

      $this->crud_model->update_chambre($this->input->post("idchambre"), $updated_data);
      echo("modification avec succès");
  }

  function supression_chambre(){

      $this->crud_model->delete_chambre($this->input->post("idchambre"));
      echo("suppression avec succès");
    
  }

// fin de script  chambre 

  // script de location
  function fetch_location(){  

       $fetch_data = $this->crud_model->make_datatables_location();  
       $data = array(); 
       $etat =''; 
       foreach($fetch_data as $row)  
       {  
            $sub_array = array(); 

            if ($row->etat == 0) {
             	$etat ='<span class="badge badge-info">innocupée</span>';
            }
            else{
            	$etat ='<span class="badge badge-success">occupée</span>';
            } 
           
            $sub_array[] = nl2br(substr($row->nom, 0,50)).' ...';
            $sub_array[] = nl2br(substr($row->fullname, 0,15)).' ...';

            $sub_array[] = nl2br(substr($row->montant, 0,20));

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_debit)), 0, 23));
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_fin)), 0, 23));
            $sub_array[] = $etat;

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idl="'.$row->idl.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idl="'.$row->idl.'" idchambre="'.$row->idchambre.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_location(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_location(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_location()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_location($_POST["idl"]);  
       foreach($data as $row)  
       {  
            $output['montant'] 			= $row->montant;
            $output['idclient'] 		= $row->idclient;
            $output['idchambre'] 		= $row->idchambre;
            $output['date_debit'] 		= $row->date_debit;
            $output['date_fin'] 		= $row->date_fin;
       }  
       echo json_encode($output);  
  }  

  function fetch_single_location_2()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_location_2($_POST["idl"]);  
       foreach($data as $row)  
       {  
            $output['montant'] 			= $row->montant;
            $output['idclient'] 		= $row->idclient;
            $output['idchambre'] 		= $row->idchambre;

            $output['date_debit'] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_debit)), 0, 23));
            $output['date_fin'] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_fin)), 0, 23));
           
            $output['nom'] 				= $row->nom;
            $output['fullname'] 		= $row->fullname;
            $output['adresse'] 			= $row->adresse;

            $output['tel'] 				= $row->tel;
            $output['email'] 			= $row->email;
            $output['montant'] 			= $row->montant;

       }  
       echo json_encode($output);  
  }  


  function operation_location(){

  	// 	$idchambre = $this->input->post('idchambre');
  	// 	if ($idchambre !='') {
  			
  	// 		$updated_data = array(  
	  //          'etat'   =>     1
			// );

		 //    $this->crud_model->update_chambre($idchambre, $updated_data);
  	// 	}

      $insert_data = array(  
           'montant'   		=>     $this->input->post('montant'),
           'idchambre'  	=>     $this->input->post('idchambre'),
           'idclient'   	=>     $this->input->post('idclient'),
           'date_debit'     =>     $this->input->post('date_debit'),
           'date_fin'    	=>     $this->input->post('date_fin')
	  );  

      $requete=$this->crud_model->insert_location($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_location(){

      $updated_data = array(  
           'montant'   		=>     $this->input->post('montant'),
           'idchambre'  	=>     $this->input->post('idchambre'),
           'idclient'   	=>     $this->input->post('idclient'),
           'date_debit'     =>     $this->input->post('date_debit'),
           'date_fin'    	=>     $this->input->post('date_fin')
	  );

      $this->crud_model->update_location($this->input->post("idl"), $updated_data);
      echo("modification avec succès");
  }

  function supression_location(){

  		$idchambre = $this->input->post('idchambre');
  		if ($idchambre !='') {
  			
  			$updated_data = array(  
	           'etat'   =>     0
			);

		    $this->crud_model->update_chambre($idchambre, $updated_data);
  		}

      $this->crud_model->delete_location($this->input->post("idl"));
      echo("suppression avec succès");
    
  }

  // fin de script  location 

	// script de paiement
	function fetch_paiement(){  

	       $fetch_data = $this->crud_model->make_datatables_paiement();  
	       $data = array();  
	       foreach($fetch_data as $row)  
	       {  
	            $sub_array = array(); 

	            $sub_array[] = '<a href="'.base_url().'admin/impression_pdf_paiemant_list/'.$row->idp.'" name="update" id="'.$row->idp.'" class="btn btn-circle btn-primary btn-sm print"><i class="fa fa-print"></i></a>';
	            
	            $sub_array[] = nl2br(substr($row->nom.' '.$row->fullname, 0,50)).' 
	            ...'; 
	            
	            $sub_array[] = nl2br(substr($row->montant, 0,10)).''; 
	            $sub_array[] = nl2br(substr($row->motif, 0,10)).''; 

	            $sub_array[] = nl2br(substr($row->tel, 0,10)).''; 


	            $sub_array[] = nl2br(substr($row->date_paie, 0,10)).'...';  

	            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23));
	            

	            $sub_array[] = '<button type="button" name="update" idp="'.$row->idp.'" class="btn btn-circle btn-primary btn-sm update"><i class="fa fa-edit"></i></button>';  
	            // $sub_array[] = '<button type="button" name="delete" idp="'.$row->idp.'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>';  
	            $data[] = $sub_array;  
	       }  
	       $output = array(  
	            "draw"                =>     intval($_POST["draw"]),  
	            "recordsTotal"        =>     $this->crud_model->get_all_data_paiement(),  
	            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_paiement(),  
	            "data"                =>     $data  
	       );  
	       echo json_encode($output);  
	  }

	  function fetch_single_paiement()  
	  {  
	       $output = array();  
	       $data = $this->crud_model->fetch_single_paiement($_POST["idp"]);  
	       foreach($data as $row)  
	       {  
	            $output['nom']        = $row->nom;  
	            $output['fullname']      = $row->fullname;  
	            $output['idl']     = $row->idl; 

	            $output['date_paie']    = $row->date_paie; 

	            $output['montant']      = $row->montant;  
	            $output['motif']      = $row->motif; 
	           
	           
	       }  
	       echo json_encode($output);  
	  }  


	  function operation_paiement(){

	      $idl   = $this->input->post('idl');
	      $idclient   = $this->input->post('idclient');
	      $montant      = $this->input->post('montant');

	      $idchambre = $this->input->post('idchambre');
	  	  if ($idchambre !='') {
	  			
	  			$updated_data = array(  
		           'etat'   =>     1
				);

			    $this->crud_model->update_chambre($idchambre, $updated_data);
	  	  }

	      $insert_data = array(  
	           'idl'         		=>     $this->input->post('idl'),  
	           'date_paie'          =>     $this->input->post("date_paie"), 
	           'montant'            =>     $this->input->post("montant"), 
	           'motif'              =>     $this->input->post("motif")
	      );


	      $users_cool = $this->crud_model->get_info_user();
	      foreach ($users_cool as $key) {

	          if ($key['idrole'] == 1) {
	            $url ="admin/compte";

	            $id_user_recever = $key['id'];

	            $nom   = $this->crud_model->get_name_client($idclient);
	            $message =$nom." vient de payer ".$montant."$";

	            $notification = array(
	              'titre'     =>    "nouveau paiement",
	              'icone'     =>    "fa fa-money",
	              'message'   =>     $message,
	              'url'       =>     $url,
	              'id_user'   =>     $id_user_recever
	            );
	            
	            $not = $this->crud_model->insert_notification($notification);

	          }
	          
	            # code...
	      }


	    $requete=$this->crud_model->insert_paiement($insert_data);
	    echo("Ajout information avec succès");
	    
	  }

	  function modification_paiement(){

	        $updated_data = array(  
	             'idl'     =>     $this->input->post('idl'),  
	             'date_paie'      =>     $this->input->post("date_paie"), 
	             'montant'        =>     $this->input->post("montant"), 
	             'motif'          =>     $this->input->post("motif")
	        ); 

	      $this->crud_model->update_paiement($this->input->post("idp"), $updated_data);
	      echo("modification avec succès");
	  }

	  function supression_paiement(){ 
	      $this->crud_model->delete_paiement($this->input->post("idp"));
	      echo("suppression avec succès");
	    
	  }
	  // fin des scripts paiement 




      // fun script utilisateurs 

       function upload_image_users()  
      {  
           if(isset($_FILES["user_image"]))  
           {  
                $extension = explode('.', $_FILES['user_image']['name']);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/photo/' . $new_name;  
                move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
                return $new_name;  
           }  
      }
















		

}



 ?>