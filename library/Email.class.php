<?php
namespace library;

class Email {
    private $email;
    private $subject;
    private $template;

    public function __construct($template, $sujet, $email) {
        $this->setTemplate($template);
        $this->setSubject($sujet);
        $this->setEmail($email);
    }

    private function setTemplate($template) {
        $this->template = trim(file_get_contents('assets/email/'.$template.'.tpl'));
    }

    private function setSubject($sujet) {
        $this->subject = $sujet;
    }

    private function setEmail($email) {
        $this->email = $email;
    }

    public function setVar($var, $value) {
        $this->template = str_replace('<'.$var.'>', $value, $this->template);
    }

    public function send() {
        require_once PUN_ROOT.'include/email.php';
        pun_mail($this->email, $this->subject, $this->template);
    }
}