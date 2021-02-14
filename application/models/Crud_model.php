<?php 
class crud_model extends CI_Model{

  // opertion role
  var $table1 = "role";  
  var $select_column1 = array("idrole", "nom", "created_at");  
  var $order_column1 = array(null, "nom", "created");
  // fin de la role

  // opertion poste
  var $table2 = "poste";  
  var $select_column2 = array("idposte", "designation", "created_at");  
  var $order_column2 = array(null, "designation", "created");
  // fin de la poste

  // opertion entreprise
  var $table3 = "entreprise";  
  var $select_column3 = array("ide", "designation","numrcm", "created_at");  
  var $order_column3 = array(null, "designation","numrcm", "created");
  // fin de la entreprise

  // opertion profile_galerie
  var $table4 = "profile_galerie";  
  var $select_column4 = array("idg","ide","adresse", "designation","numrcm", "created_at");  
  var $order_column4 = array(null, "adresse","designation","numrcm", "created");
  // fin de la profile_galerie

  // opertion type
  var $table5 = "type";  
  var $select_column5 = array("idtype", "designation", "created_at");  
  var $order_column5 = array(null, "designation", "created");
  // fin de la type

  // opertion client
  var $table6 = "client";  
  var $select_column6 = array("idclient", "fullname","tel","email","adresse", "created_at");  
  var $order_column6 = array(null, "fullname","tel","email","adresse", "created");
  // fin de la client

  // opertion profile_chambre
  var $table7 = "profile_chambre";  
  var $select_column7 = array("idchambre", "nom","idg","idtype","etat","montant","adresse","ide","designation", "created_at");  
  var $order_column7 = array(null, "nom","idg","idtype","etat","montant","adresse","ide","designation", "created");
  // fin de la profile_chambre

  //users
  var $table8 = "profile_users";  
  var $select_column8 = array("id","idposte", "first_name","nom","designation", "last_name", "email","image","telephone","full_adresse","biographie","date_nais","facebook","twitter","linkedin","idrole","sexe");  
  var $order_column8 = array(null, "nom","designation","first_name", "last_name","telephone","sexe","id", null, null);
  // fin information

  // opertion profile_location
  var $table9 = "profile_location";  
  var $select_column9 = array("idl","idchambre", "idclient", "montant","date_debit","date_fin","etat","nom","fullname","tel", "created_at");  
  var $order_column9 = array(null, "montant","date_debit","date_fin","etat","nom","fullname","tel", "created");
  // fin de la profile_location

  // opertion paie
  var $table10 = "profile_paiement";  
  var $select_column10 = array("idp", "montant","motif","idl","date_paie",
    "fullname","nom","tel","created_at");  
  var $order_column10 = array(null, "montant","motif","idl","date_paie",
    "fullname","nom","tel","created_at",null, null);
  // fin de la paie


  
  // utilisateur connecte
  function fetch_connected($id){
      $this->db->where('id',$id);
      return $this->db->get('users')->result_array();
  }
  // online 
  function insert_online($data){
      $this->db->insert('online', $data);
  }
  // creation de compte
  function insert_user($data)
  {
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  } 

  // insertion dans la table recuper pwd 
  function insert_recupere($data){
     $this->db->insert('recupere', $data);
  }

  // suppression deconnexion en ligne 
  function delete_online($id_user){
    $this->db->where('id_user', $id_user);
    $this->db->delete("online");
  }

  //modification des utilisateurs
  function update_user($email, $data)
  {
    $this->db->where('email', $email);
    return $this->db->update('users', $data);
  }

  // insertion des notifications 
  function insert_notification($data)  
  {  
     $this->db->insert('notification', $data);  
  }
  function update_crud($user_id, $data)  
  {  
       $this->db->where("id", $user_id);  
       $this->db->update("users", $data);  
  }
  //supression de notification
  function delete_notifacation_tag($id){
    $this->db->where('id', $id);
    $this->db->delete('notification');
  }

  function Select_users()
  {
      $this->db->order_by('first_name','ASC');
      $this->db->limit(50);
      return $this->db->get('users');
  }

  function Select_roles()
  {
      $this->db->order_by('nom','ASC');
      $this->db->limit(50);
      return $this->db->get('role');
  }

   function Select_postes()
  {
      $this->db->order_by('designation','ASC');
      $this->db->limit(50);
      return $this->db->get('poste');
  }

  function Select_entreprises()
  {
      $this->db->order_by('designation','ASC');
      $this->db->limit(50);
      return $this->db->get('entreprise');
  }

  function Select_types()
  {
      $this->db->order_by('designation','ASC');
      $this->db->limit(50);
      return $this->db->get('type');
  }

  function Select_galeries()
  {
      $this->db->order_by('adresse','ASC');
      $this->db->limit(50);
      return $this->db->get('galerie');
  }

  function Select_chambres()
  {   
      $this->db->where('etat', 0);
      $this->db->order_by('nom','ASC');
      $this->db->limit(50);
      return $this->db->get('chambre');
  }

  function get_info_user(){
      $nom = $this->db->get("users")->result_array();
      return $nom;
  }

  function get_name_client($idclient){
      $this->db->where("idclient", $idclient);
      $nom = $this->db->get("client")->result_array();
      foreach ($nom as $key) {
        return $key["fullname"];
      }

  }

   function show_galery_expire()
  {   
      $date_jour = date('Y-m-d');
      $request = $this->db->query("SELECT * FROM profile_location WHERE date_fin <='".$date_jour."' ");
      if ($request->num_rows() > 0) {
          
          foreach ($request->result_array() as $key) {
            $nom_chambre = $key['nom'];
            $nom_client  = $key['fullname'];
            $date_fin    = $key['date_fin'];

            $idchambre   = $key['idchambre'];

              if ($idchambre !='') {
          
                $updated_data = array(  
                    'etat'   =>     0
                );

                $this->update_chambre($idchambre, $updated_data);
              }

              $users_cool = $this->get_info_user();
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
                    
                   $not = $this->insert_notification($notification);

                  }
                  
                    # code...
              }

          }
      }
      else{

      }

      
  }


  function Select_clients()
  {
      $this->db->order_by('fullname','ASC');
      $this->db->limit(50);
      return $this->db->get('client');
  }

  function Select_locations()
  {
      $this->db->order_by('nom','ASC');
      $this->db->limit(50);
      return $this->db->get('profile_location');
  }

  function fetch_categores_dates_compt()
  {
      $this->db->group_by('date_paie');
      $this->db->order_by('date_paie','DESC');
      return $this->db->get('paiement');
  }

  function fetch_all_entreprise_inscrits($ide)
  {

        return $this->db->query("SELECT * FROM profile_galerie WHERE ide=".$ide." ");
  }
  function fetch_all_entreprise_all()
  {

        return $this->db->query("SELECT * FROM profile_galerie ");
  }

  function fetch_nom_etreprise_by_id($ide){
      $this->db->limit(1);
      $this->db->where('ide',$ide);
      $query =$this->db->get("profile_galerie")->result_array();
      foreach ($query as $key) {
        $designation = $key['designation'];
        return $designation;
      }
  }

  function statistiques_nombre($query){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;
  }

  function statistiques_nombre_where($query, $colone,$value){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." WHERE ".$colone."='".$value."' ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;

  }

  function statistiques_nombre_where_null($query, $colone,$value){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." WHERE ".$colone." is ".$value." ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;

  }



   // script pour role du site
   function make_query_role()  
   {  
          
         $this->db->select($this->select_column1);  
         $this->db->from($this->table1);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idrole", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idrole', 'DESC');  
         }  
    }

   function make_datatables_role(){  
         $this->make_query_role();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_role(){  
         $this->make_query_role();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_role()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table1);  
         return $this->db->count_all_results();  
    }

    function insert_role($data)  
    {  
         $this->db->insert('role', $data);  
    }

    
    function update_role($idrole, $data)  
    {  
         $this->db->where("idrole", $idrole);  
         $this->db->update("role", $data);  
    }


    function delete_role($idrole)  
    {  
         $this->db->where("idrole", $idrole);  
         $this->db->delete("role");  
    }

    function fetch_single_role($idrole)  
    {  
         $this->db->where("idrole", $idrole);  
         $query=$this->db->get('role');  
         return $query->result();  
    } 
    // fin de script role

    // script pour poste du site
   function make_query_poste()  
   {  
          
         $this->db->select($this->select_column2);  
         $this->db->from($this->table2);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idposte", $_POST["search"]["value"]);  
              $this->db->or_like("designation", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idposte', 'DESC');  
         }  
    }

   function make_datatables_poste(){  
         $this->make_query_poste();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_poste(){  
         $this->make_query_poste();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_poste()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table2);  
         return $this->db->count_all_results();  
    }

    function insert_poste($data)  
    {  
         $this->db->insert('poste', $data);  
    }

    
    function update_poste($idposte, $data)  
    {  
         $this->db->where("idposte", $idposte);  
         $this->db->update("poste", $data);  
    }


    function delete_poste($idposte)  
    {  
         $this->db->where("idposte", $idposte);  
         $this->db->delete("poste");  
    }

    function fetch_single_poste($idposte)  
    {  
         $this->db->where("idposte", $idposte);  
         $query=$this->db->get('poste');  
         return $query->result();  
    } 
  // fin de script poste

     // script pour entreprise 
   function make_query_entreprise()  
   {  
          
         $this->db->select($this->select_column3);  
         $this->db->from($this->table3);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("ide", $_POST["search"]["value"]);  
              $this->db->or_like("designation", $_POST["search"]["value"]);
              $this->db->or_like("numrcm", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('ide', 'DESC');  
         }  
    }

   function make_datatables_entreprise(){  
         $this->make_query_entreprise();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_entreprise(){  
         $this->make_query_entreprise();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_entreprise()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table3);  
         return $this->db->count_all_results();  
    }

    function insert_entreprise($data)  
    {  
         $this->db->insert('entreprise', $data);  
    }

    
    function update_entreprise($ide, $data)  
    {  
         $this->db->where("ide", $ide);  
         $this->db->update("entreprise", $data);  
    }


    function delete_entreprise($ide)  
    {  
         $this->db->where("ide", $ide);  
         $this->db->delete("entreprise");  
    }

    function fetch_single_entreprise($ide)  
    {  
         $this->db->where("ide", $ide);  
         $query=$this->db->get('entreprise');  
         return $query->result();  
    } 
  // fin de script entreprise


     // script pour galerie 
   function make_query_galerie()  
   {  
          
         $this->db->select($this->select_column4);  
         $this->db->from($this->table4);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idg", $_POST["search"]["value"]);  
              $this->db->or_like("designation", $_POST["search"]["value"]);
              $this->db->or_like("numrcm", $_POST["search"]["value"]);
              $this->db->or_like("adresse", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column4[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idg', 'DESC');  
         }  
    }

   function make_datatables_galerie(){  
         $this->make_query_galerie();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_galerie(){  
         $this->make_query_galerie();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_galerie()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table4);  
         return $this->db->count_all_results();  
    }

    function insert_galerie($data)  
    {  
         $this->db->insert('galerie', $data);  
    }

    
    function update_galerie($idg, $data)  
    {  
         $this->db->where("idg", $idg);  
         $this->db->update("galerie", $data);  
    }


    function delete_galerie($idg)  
    {  
         $this->db->where("idg", $idg);  
         $this->db->delete("galerie");  
    }

    function fetch_single_galerie($idg)  
    {  
         $this->db->where("idg", $idg);  
         $query=$this->db->get('galerie');  
         return $query->result();  
    } 
  // fin de script galerie

     // script pour type du site
   function make_query_type()  
   {  
          
         $this->db->select($this->select_column5);  
         $this->db->from($this->table5);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idtype", $_POST["search"]["value"]);  
              $this->db->or_like("designation", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column5[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idtype', 'DESC');  
         }  
    }

   function make_datatables_type(){  
         $this->make_query_type();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_type(){  
         $this->make_query_type();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_type()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table5);  
         return $this->db->count_all_results();  
    }

    function insert_type($data)  
    {  
         $this->db->insert('type', $data);  
    }

    
    function update_type($idtype, $data)  
    {  
         $this->db->where("idtype", $idtype);  
         $this->db->update("type", $data);  
    }


    function delete_type($idtype)  
    {  
         $this->db->where("idtype", $idtype);  
         $this->db->delete("type");  
    }

    function fetch_single_type($idtype)  
    {  
         $this->db->where("idtype", $idtype);  
         $query=$this->db->get('type');  
         return $query->result();  
    } 
  // fin de script type

    // script users
    function make_query_users()  
    {  
          
         $this->db->select($this->select_column8);  
         $this->db->from($this->table8);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("first_name", $_POST["search"]["value"]);  
              $this->db->or_like("last_name", $_POST["search"]["value"]); 
              $this->db->or_like("full_adresse", $_POST["search"]["value"]); 
              $this->db->or_like("biographie", $_POST["search"]["value"]); 
              $this->db->or_like("nom", $_POST["search"]["value"]); 
              $this->db->or_like("designation", $_POST["search"]["value"]);  
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column8[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('id', 'DESC');  
         }  
    }

    function make_datatables_users(){  
         $this->make_query_users();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_users(){  
         $this->make_query_users();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_users()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table8);  
         return $this->db->count_all_results();  
    }

    function insert_users($data)  
    {  
         $this->db->insert('users', $data);  
    }

    
    function update_users($id, $data)  
    {  
         $this->db->where("id", $id);  
         $this->db->update("users", $data);  
    }


    function delete_users($id)  
    {  
         $this->db->where("id", $id);  
         $this->db->delete("users");  
    }

    function fetch_single_users($id)  
    {  
         $this->db->where("id", $id);  
         $query=$this->db->get('users');  
         return $query->result();  
    }
    //fin de script users

    // script pour client du site
   function make_query_client()  
   {  
          
         $this->db->select($this->select_column6);  
         $this->db->from($this->table6);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idclient", $_POST["search"]["value"]);  
              $this->db->or_like("adresse", $_POST["search"]["value"]);
              $this->db->or_like("fullname", $_POST["search"]["value"]);
              $this->db->or_like("tel", $_POST["search"]["value"]);
              $this->db->or_like("email", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column6[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idclient', 'DESC');  
         }  
    }

   function make_datatables_client(){  
         $this->make_query_client();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_client(){  
         $this->make_query_client();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_client()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table6);  
         return $this->db->count_all_results();  
    }

    function insert_client($data)  
    {  
         $this->db->insert('client', $data);  
    }

    
    function update_client($idclient, $data)  
    {  
         $this->db->where("idclient", $idclient);  
         $this->db->update("client", $data);  
    }


    function delete_client($idclient)  
    {  
         $this->db->where("idclient", $idclient);  
         $this->db->delete("client");  
    }

    function fetch_single_client($idclient)  
    {  
         $this->db->where("idclient", $idclient);  
         $query=$this->db->get('client');  
         return $query->result();  
    } 
  // fin de script client

    // script pour chambre 
   function make_query_chambre()  
   {  
          
         $this->db->select($this->select_column7);  
         $this->db->from($this->table7);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idchambre", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
              $this->db->or_like("montant", $_POST["search"]["value"]);
              $this->db->or_like("adresse", $_POST["search"]["value"]);
              $this->db->or_like("designation", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idchambre', 'DESC');  
         }  
    }

   function make_datatables_chambre(){  
         $this->make_query_chambre();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_chambre(){  
         $this->make_query_chambre();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_chambre()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table7);  
         return $this->db->count_all_results();  
    }

    function insert_chambre($data)  
    {  
         $this->db->insert('chambre', $data);  
    }

    
    function update_chambre($idchambre, $data)  
    {  
         $this->db->where("idchambre", $idchambre);  
         $this->db->update("chambre", $data);  
    }


    function delete_chambre($idchambre)  
    {  
         $this->db->where("idchambre", $idchambre);  
         $this->db->delete("chambre");  
    }

    function fetch_single_chambre($idchambre)  
    {  
         $this->db->where("idchambre", $idchambre);  
         $query=$this->db->get('chambre');  
         return $query->result();  
    } 
  // fin de script chambre

    // script pour location 
   function make_query_location()  
   {  
          
         $this->db->select($this->select_column9);  
         $this->db->from($this->table9);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idchambre", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
              $this->db->or_like("montant", $_POST["search"]["value"]);
              $this->db->or_like("date_debit", $_POST["search"]["value"]);
              $this->db->or_like("date_fin", $_POST["search"]["value"]);
              $this->db->or_like("fullname", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column9[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idl', 'DESC');  
         }  
    }

   function make_datatables_location(){  
         $this->make_query_location();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_location(){  
         $this->make_query_location();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_location()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table9);  
         return $this->db->count_all_results();  
    }

    function insert_location($data)  
    {  
         $this->db->insert('location', $data);  
    }

    
    function update_location($idl, $data)  
    {  
         $this->db->where("idl", $idl);  
         $this->db->update("location", $data);  
    }


    function delete_location($idl)  
    {  
         $this->db->where("idl", $idl);  
         $this->db->delete("location");  
    }

    function fetch_single_location($idl)  
    {  
         $this->db->where("idl", $idl);  
         $query=$this->db->get('location');  
         return $query->result();  
    } 

    function fetch_single_location_2($idl)  
    {  
         $this->db->where("idl", $idl);  
         $query=$this->db->get('profile_location');  
         return $query->result();  
    } 
    // fin de script location

    // script pour information sur le paiement 
    function make_query_paiement()  
    {  
            
           $this->db->select($this->select_column10);  
           $this->db->from($this->table10);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("fullname", $_POST["search"]["value"]);  
                $this->db->or_like("nom", $_POST["search"]["value"]);
                $this->db->or_like("tel", $_POST["search"]["value"]); 
                $this->db->or_like("montant", $_POST["search"]["value"]);
                $this->db->or_like("date_paie", $_POST["search"]["value"]);
                
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column10[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('idp', 'DESC');  
           }  
      }

     function make_datatables_paiement(){  
           $this->make_query_paiement();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }

      function get_filtered_data_paiement(){  
           $this->make_query_paiement();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_paiement()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table10);  
           return $this->db->count_all_results();  
      }

      function insert_paiement($data)  
      {  
           $this->db->insert('paiement', $data);  
      }

      
      function update_paiement($idp, $data)  
      {  
           $this->db->where("idp", $idp);  
           $this->db->update("paiement", $data);  
      }


      function delete_paiement($idp)  
      {  
           $this->db->where("idp", $idp);  
           $this->db->delete("paiement");  
      }

      function fetch_single_paiement($idp)  
      {  
           $this->db->where("idp", $idp);  
           $query=$this->db->get('profile_paiement');  
           return $query->result();  
      }
      // fin script pour information sur le paiement

      // le script pour le chargement des chambres
      function fetch_chambre_by_galerie($idg)
       {

        $this->db->order_by('nom', 'ASC');
        $query = $this->db->get_where('chambre', array(
          'etat'  =>  0,
          'idg'   =>  $idg
        ));
        $output = '<option value="">Selectionner la chambre</option>';
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->idchambre.'">'.$row->nom.'</option>';
        }
        return $output;
       }

       function fetch_chambre_by_galerie_location($idg)
       {

        $this->db->order_by('nom', 'ASC');
        $query = $this->db->get_where('profile_location', array(
          'etat'  =>  0,
          'idg'   =>  $idg
        ));
        $output = '<option value="">Selectionner la chambre à louer </option>';
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->idl.'">'.$row->nom.' - '.$row->fullname.'</option>';
        }
        return $output;
       }










    function fetch_single_details_formations_filtre($ide)
    {

      
      $data = $this->db->query("SELECT * FROM profile_galerie WHERE ide=".$ide." ");
      
      $nom_entreprise = $this->fetch_nom_etreprise_by_id($ide);

      $output = '';
      $nomf;
      $created_at;
      $nom;
      $icone;

        $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO "."<br>DATABANK LOCATION <br>
         <h3>
         LISTE ENTIERE DES GALERIE DE L'ENTREPRISE ".$nom_entreprise."
         <h3>
         ";

       $output = '<div align="right">';
       $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data">';
       $output .= '
       <tr>
        <td width="25%"><img src="'.base_url().'upload/annumation/logo.jpg" width="150" height="100"/></td>
        <td width="50%" align="center">
         <p><b>'.$message.' </b></p>
         <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

         <hr>
         
        </td>

        <td width="25%">
        <img src="'.base_url().'upload/annumation/logo.jpg" width="150" height="100" />
        </td>


       </tr>
       ';
      
      $output .= '</table>';

       $output .= '</div>';

       $output .= '
          <div class="table-responsive">
           
           <br />
           <table class="table table-bordered panier_table" width="100%" cellspacing="5" cellpadding="5" id="user_data" border="0">
            <tr>
             <th width="20%">Adresse</th>
             <th width="20%">Nom de l\'entreprise</th>
             <th width="20%">N° RCM</th>

             <th width="40%">Mise à jour</th>
             
            </tr>

        ';

          foreach($data->result_array() as $items)
          {

             $output .= '
             <tr>

              <td>'.$items["adresse"].'</td>
              <td>'.$items["designation"].'</td>
              <td>'.$items["numrcm"].'</td>

              <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>

             </tr>
             ';
          }
          $output .= '

            
             
            </table>

            </div>

            <hr>

            <div align="right" style="margin-botton:20px;">

                <a href="'.base_url().'admin/stat_filtrage_galerie_ap" style="text-decoration: none; color: black;">signature:</a>
          
            </div>
        
          ';


      
        return $output;
    }

    function fetch_all_paiements($dates1, $dates2)
    {

          return $this->db->query("SELECT * FROM profile_paiement WHERE date_paie BETWEEN '".$dates1."' 
            AND '".$dates2."' LIMIT 40");
    }

      // impression paiement de galerie
    function fetch_single_details_comptabilite_system($idp)
    {

        $this->db->where('idp', $idp);
        $data = $this->db->get('profile_paiement');

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

         $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO "."<br><span style='color: rgb(204, 205, 207);'><font color='yellow'>DATA</font><font color='blue'>BANK</font><font color='green'> DRC</font></span><br>
         <h3>
         RECU DE PAIEMENT POUR LOYER DE GALERIE
         <h3>
         ";

         $output = '<div align="right">';
         $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data">';
         $output .= '
         <tr>
          <td width="25%"><img src="'.base_url().'upload/annumation/logo.jpg" width="150" height="100"/></td>
          <td width="50%" align="center">
           <p><b>'.$message.' </b></p>
           <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

           <hr>
           
          </td>

          <td width="25%">
          <img src="'.base_url().'upload/annumation/logo.jpg" width="150" height="100" />
          </td>


         </tr>
         ';
      
        $output .= '</table>';

         $output .= '</div>';

         $output .= '
            <div class="table-responsive">
             
             <br />
             <table class="table table-bordered panier_table" width="100%" cellspacing="5" cellpadding="5"  id="user_data" border="0">
              <tr>
               <th width="5%">Chambre</th>
               <th width="30%">Nom du client</th>
               <th width="5%">téléphone</th>

               <th width="15%">Montant</th>
               <th width="25%">Designation</th>

               <th width="20%">Date</th>
               
              </tr>

          ';

            foreach($data->result_array() as $items)
            {
              $maison = $items["nom"];
              $idl   = $items["idl"];
              $montantT;
              $montantRestant;

              $montant_a_payer = 30;


            $data_paie = $this->db->query("SELECT SUM(montant) AS montant FROM paiement WHERE idl=".$idl." ");
            if ($data_paie->num_rows() > 0) {
              # code...
              foreach($data_paie->result_array() as $items2)
                {
                  $montantT =  $items2["montant"];
                }
            }
            else{
              $montantT = 0;
            }

            // $montantRestant =  $montant_a_payer - $montantT;
            $retour = "javascript:history.go(-1);";



              $nom_complet = $items["fullname"];
               $output .= '
               <tr>
                <td width="15%">'.$maison.'</td> 
                <td>'.$nom_complet.'</td>
                <td>'.$items["tel"].'</td>
                <td>'.$items["montant"].'$</td>
                <td>'.$items["motif"].'</td>

                <td width="15%">'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>


               </tr>
               ';

               $output .= '
               <tr>
                <td colspan="5">
                  <div align="right">Total montant payé</div>
                </td> 
                <td >'.$montantT.'$</td>
                
               </tr>
               ';

               
            }
            $output .= '
             
        </table>

        </div>

        <hr>
    
        <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/compte" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
        
        ';


      
        return $output;
    }
      // fin de script 
    function fetch_single_details_comptabilite_filtre_paiement($dates1, $dates2)
    {

      
      $data = $this->db->query("SELECT * FROM profile_paiement WHERE date_paie BETWEEN '".$dates1."' AND '".$dates2."' ");
      $montant_total;

      $tot = $this->db->query("SELECT SUM(montant) AS total FROM profile_paiement WHERE date_paie BETWEEN '".$dates1."' AND '".$dates2."'");
      if ($tot->num_rows() > 0) {
        foreach ($tot->result_array() as $key) {
          $montant_total = $key['total'];
        }
      }
      else{
        $montant_total = 0;
      }

      $output = '';
      $nomf;
      $created_at;
      $nom;
      $icone;

       

        $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO "."<br><span style='color: rgb(204, 205, 207);'><font color='yellow'>DATA</font><font color='blue'>BANK</font><font color='green'>DRC</font></span><br>
         <h3>
         RECU DE PAIEMENT POUR LE LOYER
         <h3>
         ";

       $output = '<div align="right">';
       $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data">';
       $output .= '
       <tr>
        <td width="25%"><img src="'.base_url().'upload/annumation/logo.jpg" width="150" height="100"/></td>
        <td width="50%" align="center">
         <p><b>'.$message.' </b></p>
         <p><b>Mise à jour : </b>'.date('d/m/y').'</p>

         <hr>
         
        </td>

        <td width="25%">
        <img src="'.base_url().'upload/annumation/logo.jpg" width="150" height="100" />
        </td>


       </tr>
       ';
      
      $output .= '</table>';

       $output .= '</div>';

       $output .= '
          <div class="table-responsive">
           
           <br />
           <table class="table table-bordered panier_table" width="100%" cellspacing="5" cellpadding="5" id="user_data" border="0">
            <tr>
             <th width="5%">Chambre</th>
               <th width="30%">Nom du client</th>
               <th width="5%">téléphone</th>

               <th width="15%">Montant</th>
               <th width="25%">Designation</th>

               <th width="20%">Date</th>
             
            </tr>

        ';

          foreach($data->result_array() as $items)
          {
            
            $nom_complet = $items["fullname"];
            $maison = $items["nom"];
             $output .= '
              <tr>
                <td width="15%">'.$maison.'</td> 
                <td>'.$nom_complet.'</td>
                <td>'.$items["tel"].'</td>
                <td>'.$items["montant"].'$</td>
                <td>'.$items["motif"].'</td>

                <td width="15%">'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>

               </tr>
             ';
          }
          $output .= '

            <tr>
              <td colspan="3"><div align="">Montant total de paiement</div></td>
              <td>'.$montant_total.'$</td>
              <td></td>
              <td></td>

            </tr>
             
            </table>

            </div>

            <hr>

            <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/compte" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
        
          ';


      
        return $output;
    }











  



// validation
  function can_login($email, $password_ok)
  {
      $this->db->where('email', $email);
      $query = $this->db->get('users');
      if($query->num_rows() > 0)
      {
       foreach($query->result() as $row)
       {
          if($row->idrole == '1')
          {

             $password = md5($password_ok);
             $store_password = $row->passwords;
             if($password == $store_password)
             {
              $this->session->set_userdata('admin_login', $row->id);
             }
             else
             {
              return 'mot de passe incorrect';
             }

          }
          elseif($row->idrole == '2')
          {
             $password = md5($password_ok);
             $store_password = $row->passwords;
             if($password == $store_password)
             {
              $this->session->set_userdata('id', $row->id);
             }
             else
             {
              return 'mot de passe incorrect';
             }

          }
          elseif($row->idrole == '3')
          {
             $password = md5($password_ok);
             $store_password = $row->passwords;
             if($password == $store_password)
             {
              $this->session->set_userdata('instuctor_login', $row->id);
             }
             else
             {
              return 'mot de passe incorrect';
             }

            }
          else
          {
           return 'les informations incorrectes';
          }
          



       }
      }
      else
      {
       return 'adresse email incorrecte';
      }
    
  }


  function can_recuperation($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
               
            }
        }
        else
        {
        return 'Adresse email non trouvée!!!!';
        }
    }


      // sauvegarde des donnees 
    function create_backup() 
    {
        $this->load->dbutil();
        $options = array(
            'format' => 'txt', 
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n"
        );
        $tables = array('');
        $file_name = 'gestiongalerie';
        $backup = & $this->dbutil->backup(array_merge($options, $tables));
        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    function import_db()
    {
        $this->load->database();
        // $this->db->truncate('users');
        // $this->db->truncate('categorie_aprenant');
        // $this->db->truncate('derogation');
        // $this->db->truncate('edition');
        // $this->db->truncate('formation');
        // $this->db->truncate('inscription_formation');
        // $this->db->truncate('messagerie');
        // $this->db->truncate('notification');
        // $this->db->truncate('online');
        // $this->db->truncate('paiement');
        // $this->db->truncate('presence');
        // $this->db->truncate('question');
        // $this->db->truncate('recouvrement');
        // $this->db->truncate('recupere');
        // $this->db->truncate('reponse');
        // $this->db->truncate('role');
        // $this->db->truncate('rubrique');
        // $this->db->truncate('tbl_info');
        // $this->db->truncate('tranche');
        

        $file_n = $_FILES["file_name"]["name"];
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "upload/" . $_FILES["file_name"]["name"]);
        $filename = "upload/".$file_n;
        $mysql_host = 'localhost';
        $mysql_username = 'root';
        $mysql_password = '';
        $mysql_database = 'media';
        mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connect to MySQL: ' . mysql_error());
        mysql_select_db($mysql_database) or die('Error to connect MySQL: ' . mysql_error());
        $templine = '';
        $lines = file($filename);
        foreach ($lines as $line)
        {
                if (substr($line, 0, 2) == '--' || $line == '')
                {
                    continue;
                }
                $templine .= $line;
                if (substr(trim($line), -1, 1) == ';')
                {
                    mysql_query($templine) or print('Error \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                    $templine = '';
                if (mysql_errno() == 1062) 
                {
                print 'no way!';
                }
            }
        }
        unlink("upload/" . $file_n);

    }

  }

?>