<?php
namespace modules\Newsletter;

class NewsletterController extends \library\BaseController {
    public function handle() {
        $newsletter = new Newsletter();

        if($this->request->method() == 'POST') {

            $data = $this->request->postData('data');

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->response->redirect('newsletter/error'); 
            }

            $data['domaine'] = $this->domaine;
            $newsletter->hydrate($data);

            if($this->request->postData('action') == 'subscribe') {
                $newsletter->subscribe();
                $this->response->redirect('newsletter/subscribe');
            }
            else {
                $newsletter->unsubscribe();
                $this->response->redirect('newsletter/unsubscribe');
            }
            
            $this->response->redirect('newsletter');
        }

        $this->view->addTitle('Newsletter');
        $this->addAriane('newsletter', 'Newsletter');
        $this->makeView();
    }

    public function subscribe() {
        $this->view->addTitle('Newsletter');
        $this->addAriane('newsletter', 'Newsletter');
        $this->makeView();
    }

    public function unsubscribe() {
        $this->view->addTitle('Newsletter');
        $this->addAriane('newsletter', 'Newsletter');
        $this->makeView();
    
}}