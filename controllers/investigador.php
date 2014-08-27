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
        $crud = new grocery_CRUD();
        $crud->set_table('investigador');
        $crud->set_subject('Investigador');
        $crud->required_fields('numpersonal','nombre','password','correo');
        
        $output = $crud->display_as('nombre','Nombre')
                                     ->display_as('possword','Contraseña')
                                     ->display_as('nomproyec','Nombre del Proyecto') 
                                     ->display_as('correo','Correo')
                                     ->display_as('integrante_comite','Integrante del comite')
                                     ->display_as('perfil_comite','Perfil dentro del comite'); 
                                     
        $output = $crud->render();
        $this->_example_output($output);  
      }
             else { redirect('login');
             } 
    }
 
   
 
    function _example_output($output = null)
 
    {
        $output->titulo_tabla = "Registro de Investigador";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);  
        $this->load->view('plantilla_view', $datos_plantilla);  
    }
}
 