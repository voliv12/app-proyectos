<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dictamen extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */ 
 
        $this->load->library('grocery_CRUD');
 
    }
 
    public function dictamen_proyecto($id)
    {
     if ($this->session->userdata('logged_in'))
     {
        $crud = new grocery_CRUD();
        $crud->where('proyecto_idproyecto', $id);
        $crud->set_table('proyecto_comite');
        $crud->set_subject('Dictamen');
        $output = $crud->display_as('proyecto_idproyecto','Nombre del proyecto')
                       ->display_as('comite_idcomite','Nombre del comite')
                       ->display_as('dictamen','Dictamen')
                       ->display_as('fecha_dictamen','Fecha del Dictamen')
                       ->display_as('archivo_dictamen','Dictamen'); 
        
        $output = $crud->render();
        $this->_example_output($output);   
      }
             else { redirect('login');
             }
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Registro de Dictamen";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('plantilla_view', $datos_plantilla);  
    }
}
 
