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

    }

    public function index()
    {
        $this->grocery_crud->set_table('proyecto');
        $this->grocery_crud->set_subject('Proyecto');
        $this->grocery_crud->required_fields('numpersonal','folio','nomproyec','fecha_registro');

        $output = $this->grocery_crud->display_as('folio','Folio')
                                     ->display_as('numpersonal','Numero de Personal')
                                     ->display_as('nomproyec','Nombre del Proyecto')
                                     ->display_as('fecha_registro','Fecha de Registro');
        $this->grocery_crud->unset_texteditor('nomproyec','full_text');
        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }



    function _example_output($output = null)

    {
        $output->titulo_tabla = "Registro de Proyectos";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_view', $datos_plantilla);
    }
}
