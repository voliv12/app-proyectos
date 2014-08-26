<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Investigador extends CI_Controller {
 
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
        $this->grocery_crud->set_table('investigador');
        $this->grocery_crud->set_subject('Investigador');
        $this->grocery_crud->required_fields('numpersonal','nombre','password','correo');
        
        $output = $this->grocery_crud->display_as('nombre','Nombre')
                                     ->display_as('possword','Contraseña')
                                     ->display_as('nomproyec','Nombre del Proyecto') 
                                     ->display_as('correo','Correo')
                                     ->display_as('integrante_comite','Integrante del comite')
                                     ->display_as('perfil_comite','Perfil dentro del comite'); 
                                     
        $output = $this->grocery_crud->render();
        $this->_example_output($output);   
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Registro de Investigador";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('principal_view', $datos_plantilla);  
    }
}
 