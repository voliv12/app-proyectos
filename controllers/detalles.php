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
 
    public function agrega_detalle($id)
    { if ($this->session->userdata('logged_in'))
      {
        $this->grocery_crud->where('proyecto_idproyecto', $id);
        $this->grocery_crud->set_table('detalles_proyecto');
        $this->grocery_crud->set_subject('Detalles');        
        $this->grocery_crud->required_fields('descripcion','objetivo','justificacion');
        $output = $this->grocery_crud->display_as('descripcion','Descrición') 
                                     ->display_as('objetivo','Objetivo') 
                                     ->display_as('justificacion','Justificación');
        $crud->unset_add();
        $output = $this->grocery_crud->render();
        $this->_example_output($output);   
      }
             else { redirect('login');
             }    
    }
 
   
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Detalles del Proyecto";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('plantilla_view', $datos_plantilla);  
    }
}
 
