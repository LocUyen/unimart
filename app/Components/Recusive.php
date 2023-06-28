<?php
namespace App\Components;

class Recusive {
    private $data;
    private $htmlSelect='';
    
    public function __construct($data){
        $this->data = $data;
    }
    function render_menu($id='0', $text=''){
        foreach($this->data as $value){
            if($value['parent_id'] == $id) {
                $this->htmlSelect .= "<option value = '" .$value['id']."'>". $text .$value['name']."</option>";
                $this->render_menu($value['id'], $text.'|--');
            }
        } 
        return $this->htmlSelect;   
    }

    function has_child($id){
        foreach($this->data as $value){
            if($value['parent_id'] == $id) return true;
        }    
        return false;
    }

    function data_tree($parent_id='0', $level='0'){
        $result = array();
        foreach($this->data as $value){
            if($value['parent_id'] == $parent_id) {
                $value['level'] = $level;
                $result[] = $value;
                if($this->has_child($value['id'])) {
                    $result_child = $this->data_tree($value['id'], $level + 1);
                    $result = array_merge($result,$result_child);
                }
            }
        }
        return $result;
    }
}
?>