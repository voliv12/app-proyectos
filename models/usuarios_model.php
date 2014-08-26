<?php
//require_once APPPATH.'models/Generic_Dataset_Model.php';

class Usuarios_model extends CI_Model
{
    function __construct()
    {
        parent :: __construct();
        $this->load->database();
    }

    function buscar_investigador($usuario, $password)
    {
        $this->db->select('*');
        $this->db->from('investigador');
        $this->db->where('numpersonal', $usuario);
        $this->db->where('password', $password);
        $query = $this->db->get();

        if ($query->num_rows() == 0)
        {
            return FALSE;
        }else
        {
            return $query->row();
        }
    }

    function buscar_en_BD($usuario, $password)
    {
        $this->db->select('*');
        $this->db->from('perfil');
        $this->db->join('academico','academico.noPersonal = perfil.academico_noPersonal');
        $this->db->where('academico_noPersonal', $usuario);
        $this->db->where('password', $password);
        $query = $this->db->get();

        if ($query->num_rows() == 0)
        {
            return FALSE;
        }else
        {
            return $query->row();
        }
     }

}

