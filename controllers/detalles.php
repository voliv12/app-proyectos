<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Detalles extends CI_Controller {
 
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
        $this->grocery_crud->set_table('detalles_proyecto');
        $this->grocery_crud->set_subject('detalles');
        $this->grocery_crud->required_fields('proyecto_idproyecto','descripcion','objetivo','justificacion');
        
        $output = $this->grocery_crud->display_as('proyecto_idproyecto','Nombre proyecto')
                                     ->display_as('descripcion','Descrición') 
                                     ->display_as('objetivo','Objetivo') 
                                     ->display_as('justificacion','Justificación');
        
        $output = $this->grocery_crud->render();
        $this->_example_output($output);   
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Detalles del Proyecto";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('principal_view', $datos_plantilla);  
    }
}
 
