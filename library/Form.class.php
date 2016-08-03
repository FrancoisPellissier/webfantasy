<?php
namespace library;

class Form {
	private $data;

	public function __construct(array $data) {
		$this->data = $data;
	}

	public function start($method, $action = "") {
		return '<form method="'.$method.'"'.($action == "" ?  : 'action="'.$action.'"').'>';
	}

	public function end() {
		return '</form>';
	}

	public function submit($value, $id = "") {
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
 }