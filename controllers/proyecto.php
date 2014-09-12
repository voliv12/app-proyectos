<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Proyecto extends CI_Controller {
 
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
        $crud->set_table('proyecto');
        $crud->set_subject('Proyecto');
        $output = $crud->display_as('idproyecto','Folio')
                       ->display_as('numpersonal','Nombre')
                       ->display_as('nomproyec','Nombre del Proyecto')
                       ->display_as('fecha_registro','Fecha de Registro');
        $crud->add_action('Agregar Dictamen', 'assets/imagenes/dictamen.png', 'dictamen');
        $crud->set_relation('numpersonal','investigador','Nombre');
        $crud->unset_delete();
        $crud->unset_export();
        $crud->unset_print();
        $crud->unset_edit();                            
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
 