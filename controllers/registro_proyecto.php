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
        $crud->columns( 'folio','nomproyec','fecha_registro');
        $crud->field_type('numpersonal', 'hidden',$this->numpersonal);
        $output = $crud->display_as('nomproyec','Nombre del Proyecto')
                       ->display_as('fecha_registro','Fecha de Registro');
        $crud->unset_texteditor('nomproyec','full_text');
        $crud->add_action('Agregar Detalles', 'assets/imagenes/detalles.png', 'detalles/agrega_detalle');
        $crud->callback_after_insert(array($this, 'insert_folio'));
        $crud->callback_after_update(array($this, 'insert_folio'));
        $crud->callback_after_insert(array($this, 'insert_detalles'));
        $crud->callback_after_update(array($this, 'insert_detalles'));
       // $crud->set_relation('folio','folioproyecto','folio');

       // $crud->callback_column('folio',array($this,'folio_ics'));
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

function insert_detalles($post_array,$primary_key)
{
    $detalles = array(
        "proyecto_idproyecto" => $primary_key

    );

    $this->db->insert('detalles_proyecto',$detalles);

    return true;
}
function insert_folio($post_array,$primary_key)
{
    $fol= "ICS-".$primary_key;
    $detalles = array(
        "folio"=>$fol,
        "proyecto_idproyecto" => $primary_key

    );

    $this->db->insert('folioproyecto',$detalles);

    return true;
}

/*function insert_folio($post_array,$primary_key)
{
    $folio = array(
        "folio" => mysql_insert_id()
    );

    $this->db->update('proyecto',$folio,array('idproyecto' => $primary_key));

    return true;
}*/


    function _example_output($output = null)

    {
        $output->titulo_tabla = "Registro de Proyectos";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_view', $datos_plantilla);
    }
}
