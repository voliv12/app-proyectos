<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro_proyecto extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        $this->load->library('grocery_CRUD');
        $this->numpersonal = $this->session->userdata('numpersonal');

    }

    public function index()
    {
     if ($this->session->userdata('logged_in'))
      {
        $crud = new grocery_CRUD();
        $crud->where('numpersonal', $this->numpersonal);
        $crud->set_table('proyecto');
        $crud->set_subject('Proyecto');
        $crud->required_fields('numpersonal','folio','nomproyec','fecha_registro');
        $crud->columns( 'folio','nomproyec','fecha_registro');
        $crud->field_type('numpersonal', 'hidden',$this->numpersonal); 
        $output = $crud->display_as('folio','Folio')
                       ->display_as('nomproyec','Nombre del Proyecto') 
                       ->display_as('fecha_registro','Fecha de Registro'); 
        $crud->unset_texteditor('nomproyec','full_text');     
        $crud->add_action('Detalles', '../assets/uploads/detalles.png', 'detalles/agrega_detalle');                             
        $output = $crud->render();
        $this->_example_output($output);
      }
     else { redirect('login');
             }   
    }



    function _example_output($output = null)

    {
        $output->titulo_tabla = "Registro de Proyectos";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_view', $datos_plantilla);
    }
}
