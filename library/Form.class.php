<?php
namespace library;

class Form {
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function start($method, $action = "", $file = false) {
        return '<form method="'.$method.'"'.($action == "" ? '' : ' action="'.$action.'"').($file ? ' enctype="multipart/form-data"' : '').'>';
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

    public function HTMLinputFile($name) {
        return '<input id="'.$name.'" type="file" name="'.$name.'" accept=".jpg, .jpeg, .JPG, .JPEG" />';
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

    public function HTMLselectObject($name, $datas, $key, $value, $default = array()) {
        $return = "\n\t".'<select name="data['.$name.']">';

        if(!empty($default)) {
            $return .= "\n\t\t".'<option value="'.$default[$key].'"'.($default[$key] == $this->data[$name] ? ' selected="selected"' : '').'>'.$default[$value].'</option>';
        }

        foreach($datas AS $data) {
            if($data->infos[$key] != $this->data[$key]) {
                $return .= "\n\t\t".'<option value="'.$data->infos[$key].'"'.($data->infos[$key] == $this->data[$name] ? ' selected="selected"' : '').'>'.$data->infos[$value].'</option>';
            }
        }
        $return .= "\n\t".'</select>';
        
        return $return;
    }

    public function HTMLradio($name, $datas, $separator) {
        $return = array();

        foreach($datas AS $value => $lib) {
            $return[] = '<input type="radio" id="'.$name.'_'.$value.'" name="data['.$name.']" value="'.$value.'"'.($this->setValue($name) == $value ? ' checked' : '').' /> <label for="'.$name.'_'.$value.'">'.$lib.'</label>';

        }
        return implode($separator, $return);
    }

    public function HTMLcheckbox($name, $lib) {
        return '<input type="checkbox" id="" name="'.$name.'"'.($this->setValue($name) ? ' checked' : '').' /><label for="">'.$lib.'</label>';
    }
}