<?php

class Enfermeria_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'enfermeria';
    }
    
    public function get($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->consejeria = (bool)$row->consejeria;
            $row->curaciones = (bool)$row->curaciones;
            return $row;
        }else{
            return NULL;
        }
    }
    
    public function save($id) {
        
        $data = array('id' => $id);
        
        $query = $this->db->insert($this->mytable, $data);
        
        if ($query && $this->db->affected_rows()==1){
            
            return TRUE;
        }else{
            
            return FALSE;
        }
    }
    
    public function update($id, $data) {
        
        if ($this->db->field_exists($data['campo'], $this->mytable)) {
            
            $this->db->set($data['campo'], $data['nuevo_valor']);
            
            $this->db->where('id', $id);
            
            $query = $this->db->update($this->mytable);
            
            if ($query)
            {
                $response = "Guardado";
            }
            else
            {
                $response = $this->db->error();
            }
            
            return array('update' => $query, 'value' => $response);
        }
        
        return null; 
    }
}

