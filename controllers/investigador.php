<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Investigador extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */ 
 
        $this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
     //if($this->session->userdata('logged_in'))
      //{
        $crud = new grocery_CRUD();
        $crud->set_table('investigador');
        $crud->set_subject('Investigador');
        $crud->required_fields('numpersonal','nombre','password','correo');
        
        $output = $crud->display_as('nombre','Nombre Completo')
                       ->display_as('password','Contraseña')
                       ->display_as('numpersonal','Numero de Personal')
                       ->display_as('integrante_comite','Integrante del comite')
                       ->display_as('perfil_comite','Perfil dentro del comite'); 
        $crud->field_type('integrante_comite', 'true_false', array('No', 'SI'));
        $crud->set_rules('correo','Correo','valid_email');
        $crud->columns('numpersonal','nombre','correo','perfil_comite');
        $crud-> field_type ('password', 'password' ) ;
        $crud->unset_print();
        $crud->unset_export();
        $crud->callback_before_insert(array($this,'encrypt_password_callback'));
        $crud->callback_before_update(array($this,'encrypt_password_callback'));
                                     
        $output = $crud->render();
        $this->_example_output($output);  
      //}
        //     else { redirect('login');
          //   } 
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Alta de Investigador";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('plantilla_view', $datos_plantilla);  
    }


     function encrypt_password_callback($post_array)
    {
        $this->load->library('encrypt');
        //$post_array['password'] = strtoupper($post_array['password']); //Aprovecho éste callback para convertir a mayúsculas la Matricula
        $post_array['password'] = $this->encrypt->sha1($post_array['password']);

        return $post_array;
    }

}
 