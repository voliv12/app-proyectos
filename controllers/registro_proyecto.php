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
        $crud->required_fields('numpersonal','nomproyec','fecha_registro');
        $crud->columns( 'idproyecto','nomproyec','fecha_registro');
        $crud->field_type('numpersonal', 'hidden',$this->numpersonal);
        $output = $crud->display_as('idproyecto','Folio')
                       ->display_as('nomproyec','Nombre del Proyecto')
                       ->display_as('fecha_registro','Fecha de Registro');
        $crud->unset_texteditor('nomproyec','full_text');
        $crud->add_action('Agregar Detalles', 'assets/imagenes/detalles.png', 'detalles/agrega_detalle');

        $crud->callback_after_insert(array($this, 'insert_detalles_folio'));
        $crud->callback_after_update(array($this, 'insert_detalles_folio'));

        $crud->set_relation('idproyecto','folioproyecto','folio');

        $crud->unset_delete();
        $crud->unset_export();
        $crud->unset_print();

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

function insert_detalles_folio($post_array,$primary_key)
{
     $foli= "ICS-".$primary_key;
    $fol = array(
        "proyecto_idproyecto" => $primary_key,
         "folio"=>$foli
    );

    $this->db->insert('folioproyecto',$fol);

    $detalles = array(
        "proyecto_idproyecto" => $primary_key

    );

    $this->db->insert('detalles_proyecto',$detalles);

    return true;
}





    function _example_output($output = null)

    {
        $output->titulo_tabla = "Registro de Proyectos";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_view', $datos_plantilla);
    }
}
