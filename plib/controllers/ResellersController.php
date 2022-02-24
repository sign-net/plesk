<?php
class ResellersController extends pm_Controller_Action
{
    public function init()
    {
           parent::init();
           // Init title for all actions
           $this->view->pageTitle = 'Sign.net Resellers';
           // Init tabs for all actions
           $this->view->tabs = [
               [
                   'title' => 'Reseller Contact Info',
                   'action' => 'contactinfoform',
               ],
               [ 
                   'title' => 'Reseller Products',
                   'action' => 'productsform',
               ],
               [ 
                    'title' => 'Reseller Biling Terms',
                    'action' => 'bilingtermsform',
               ],
           ];
           $this->view->tools = [
            [
                
                // 'icon' => pm_Context::getBaseUrl() . "images/button2.png",
                'title' => 'Home',
                'link' => pm_Context::getBaseUrl(),
            ],
            [
                'icon' => pm_Context::getBaseUrl() . "images/button1.png",
                'title' => 'User Accounts',
                'description' => 'User Account functions',
                'controller' => 'UserAccount',
                'action' => '/useraccount/index',
            ],
            [
                // 'icon' => pm_Context::getBaseUrl() . "images/button1.png",
                'title' => 'Reseller',
                'description' => 'Reseller functions',
                'controller' => 'Resellers',
                'action' => '/resellers/index'
            ],
            [
                // 'icon' => pm_Context::getBaseUrl() . "images/button1.png",
                'title' => 'Domain Check',
                'description' => 'Check',
                'controller' => 'DomainCheck',
                'action' => '/domaincheck/index',
            ],
            [
                // 'icon' => pm_Context::getBaseUrl() . "images/button1.png",
                'title' => 'Example',
                'description' => 'Example extension with UI samples',
                'controller' => 'custom',
                'action' => 'form',
            ],
        ];
       }

       public function indexAction() {

           $this->forward('contactinfoform');

       }

       public function contactinfoformAction()
       {
           // Display simple text in view
           $this->view->test = 'Retrieve reseller contact information';
   
           // Init form here
           $form = new pm_Form_Simple();
           $form->addElement('text', 'exampleText', array(
               'label' => 'Enter UserApiKey',
               'value' => pm_Settings::get('exampleText'),
               'required' => true,
               'validators' => array(
                   array('NotEmpty', true),
               ),
           ));
   
           $form->addControlButtons(array(
               'cancelLink' => pm_Context::getModulesListUrl(),
           ));
   
           if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
               // Form proccessing here
               pm_Settings::set('exampleText', $form->getValue('exampleText'));
   
               $userApiKey = $form->getValue('exampleText');
   
               //send request and call the getResellerContactInfo in provisioning-api below
               //parameters
               $data = array(
                   'userApiKey'      => $userApiKey,
                   'internalApiKey'    => '}ASka}_N;OB7~=H1/,v6K<3]E~WSO^:+V{(naB>DD>;e<}v-8kM|D(`B9$',
                 );
               $options = array(
                   'http' => array(
                     'method'  => 'GET',
                     'content' => json_encode( $data ),
                     'header'=>  "Content-Type: application/json\r\n" .
                                 "Accept: application/json\r\n"
                     )
                 );
   
               $url = 'http://54.151.137.158:8080/provisioning-api/getResellerContactInfo'; //url of API endpoint in route.ts
               $context  = stream_context_create( $options );
               $result = file_get_contents( $url, false, $context );
               $response = json_decode( $result, true );
   
               if(! $response ) {
                   die('Could not call the API');
               }
   
   
               if ($userApiKey !== 'testing'){
                   $this->_status->addMessage('error','Invalid userApiKey');
               }
   
               $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
               
           }
   
           $this->view->form = $form;
       }
   
       public function productsformAction()
       {
           // Display simple text in view
           $this->view->test = 'Retrieve list of products available for reseller';
   
           // Init form here
           $form = new pm_Form_Simple();
           $form->addElement('text', 'exampleText', array(
               'label' => 'Enter UserApiKey',
               'value' => pm_Settings::get('exampleText'),
               'required' => true,
               'validators' => array(
                   array('NotEmpty', true),
               ),
           ));
   
           $form->addControlButtons(array(
               'cancelLink' => pm_Context::getModulesListUrl(),
           ));
   
           if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
               // Form proccessing here
               pm_Settings::set('exampleText', $form->getValue('exampleText'));
               $userApiKey = $form->getValue('exampleText');
   
               //send request and call the getResellerProducts in provisioning-api below
               //parameters
               $data = array(
                   'userApiKey'      => $userApiKey,
                   'internalApiKey'    => '}ASka}_N;OB7~=H1/,v6K<3]E~WSO^:+V{(naB>DD>;e<}v-8kM|D(`B9$',
                 );
               $options = array(
                   'http' => array(
                     'method'  => 'GET',
                     'content' => json_encode( $data ),
                     'header'=>  "Content-Type: application/json\r\n" .
                                 "Accept: application/json\r\n"
                     )
                 );
   
               $url = 'http://54.151.137.158:8080/provisioning-api/getResellerProducts'; //url of API endpoint in route.ts
               $context  = stream_context_create( $options );
               $result = file_get_contents( $url, false, $context );
               $response = json_decode( $result, true );
   
               if(! $response ) {
                   die('Could not call the API');
               }
   
               if ($userApiKey !== 'testing'){
                   $this->_status->addMessage('error','Invalid userApiKey');
               }
   
               $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
               
           }
   
           $this->view->form = $form;
       }
   
       public function bilingtermsformAction()
       {
           // Display simple text in view
           $this->view->test = 'Retrieve billing terms for a specific user';
   
           // Init form here
           $form = new pm_Form_Simple();
           $form->addElement('text', 'exampleText', array(
               'label' => 'Enter UserApiKey',
               'value' => pm_Settings::get('exampleText'),
               'required' => true,
               'validators' => array(
                   array('NotEmpty', true),
               ),
           ));
           $form->addElement('text', 'exampleText2', array(
               'label' => 'Enter user ID',
               'value' => pm_Settings::get('exampleText2'),
               'required' => true,
               'validators' => array(
                   array('NotEmpty', true),
               ),
           ));
   
           $form->addControlButtons(array(
               'cancelLink' => pm_Context::getModulesListUrl(),
           ));
   
           if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
               // Form proccessing here
               pm_Settings::set('exampleText', $form->getValue('exampleText'));
               pm_Settings::set('exampleText2', $form->getValue('exampleText2'));
   
               $userApiKey = $form->getValue('exampleText');
               $userId = $form->getValue('exampleText2');
   
               //send request and call the getBillingTermsByUserId in provisioning-api below
               //parameters
               $data = array(
                   'userApiKey'      => $userApiKey,
                   'userId'           => $userId,
                   'internalApiKey'    => '}ASka}_N;OB7~=H1/,v6K<3]E~WSO^:+V{(naB>DD>;e<}v-8kM|D(`B9$',
                 );
               $options = array(
                   'http' => array(
                     'method'  => 'GET',
                     'content' => json_encode( $data ),
                     'header'=>  "Content-Type: application/json\r\n" .
                                 "Accept: application/json\r\n"
                     )
                 );
   
               $url = 'http://54.151.137.158:8080/provisioning-api/getBillingTerms'; //url of API endpoint in route.ts
               $context  = stream_context_create( $options );
               $result = file_get_contents( $url, false, $context );
               $response = json_decode( $result, true );
   
               if(! $response ) {
                   die('Could not call the API');
               }
   
               if ($userApiKey !== 'testing'){
                   $this->_status->addMessage('error','Invalid userApiKey');
               }
   
               $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
               
           }
   
           $this->view->form = $form;
       }
   
}