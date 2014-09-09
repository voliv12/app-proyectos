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
        $crud = new grocery_CRUD();
        $crud->where('proyecto_folio', $this->desconcatena($id));
        $crud->set_table('detalles_proyecto');
        $crud->set_subject('Detalles');  
        $crud->columns( 'proyecto_folio','descripcion');      
        $crud->required_fields('descripcion','objetivo','justificacion');
        $output = $crud->display_as('descripcion','Descrición') 
                       ->display_as('objetivo','Objetivo') 
                       ->display_as('proyecto_folio','Folio') 
                       ->display_as('justificacion','Justificación');
        $crud->callback_column('proyecto_folio',array($this,'folio_ics'));

        $crud->unset_add();
        $output = $crud->render();
        $this->_example_output($output);   
      }
             else { redirect('login');
             }    
    }
 


    function folio_ics($value, $row)
    {
        return ' ICS-'.$value;
    }

    function desconcatena($id){
    list($ics, $id) = explode("-", $id);
        return $id;
    }   

    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Detalles del Proyecto";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('plantilla_view', $datos_plantilla);  
    }
}
 
