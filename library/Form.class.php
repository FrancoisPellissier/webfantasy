<?php
namespace library;

class Form {
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function start($method, $action = "") {
        return '<form method="'.$method.'"'.($action == "" ? '' : 'action="'.$action.'"').'>';
    }

    public function end() {
        return '</form>';
    }

    public function HTMLsubmit($value, $id = "") {
        return '<input type="submit" value="'.$value.'"'.($id == "" ? '' : 'id="'.$id.'"').'>';
    }

    public function setValue($name, $escape = true) {
        if(isset($this->data[$name])) {
            if($escape) {
                return htmlentities($this->data[$name]);
            }
            else {
                return $this->data[$name];
            }
        }
        else {
            return '';
        }
    }

    public function HTMLinput($type, $name, $size = 0) {
        return '<input id="'.$name.'" type="'.$type.'" name="data['.$name.']" value="'.$this->setValue($name).'"'.($size == 0 ? '' : ' size = "'.$size.'"').' />';
    }

    public function HTMLtextarea($name, $cols, $rows) {
        return '<textarea id="'.$name.'" name="data['.$name.']" cols="'.intval($cols).'" rows="'.intval($rows).'" >'.$this->setValue($name).'</textarea>';

    }

    public function HTMLselect($name, $datas) {
        $return = "\n\t".'<select name="data['.$name.']">';

        foreach($datas AS $key => $value) {
            $return .= "\n\t\t".'<option value="'.$key.'"'.($key == $this->data[$name] ? ' selected="selected"' : '').'>'.$value.'</option>';
        }
        $return .= "\n\t".'</select>';
        
        return $return;
    }
}