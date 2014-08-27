<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Comite extends CI_Controller {
 
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
     if ($this->session->userdata('logged_in'))
     {
        $crud = new grocery_CRUD();
        $crud->set_table('comite');
        $crud->set_subject('comite');
        $crud->required_fields('nombre_comite');
         $output = $crud->display_as('nombre_comite','Nombre del comite'); 
        
        $output = $crud->render();
        $this->_example_output($output);   
      }
             else { redirect('login');
             }
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Registro de Comite";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('plantilla_view', $datos_plantilla);  
    }
}
 
