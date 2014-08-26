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
        $this->grocery_crud->set_table('comite');
        $this->grocery_crud->set_subject('comite');
        $this->grocery_crud->required_fields('nombre_comite');
         $output = $this->grocery_crud->display_as('nombre_comite','Nombre del comite'); 
        
        $output = $this->grocery_crud->render();
        $this->_example_output($output);   
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Registro de Comite";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('principal_view', $datos_plantilla);  
    }
}
 
