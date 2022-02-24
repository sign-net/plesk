<?php

class UserAccountController extends pm_Controller_Action
{

    public function init()
    {
           parent::init();
           // Init title for all actions
           $this->view->pageTitle = 'User Account Functions';
           // Init tabs for all actions
           $this->view->tabs = [
               [
                   'title' => 'Provision Account',
                   'action' => 'provisioningform',
               ],
               [ 
                   'title' => 'Provision Addons',
                   'action' => 'addonsform',
               ],
               [ 
                    'title' => 'Domain Check',
                    'action' => 'domaincheckform',
               ],
            // [ 
            //     'title' => 'Reseller Actions',
            //     'action' => 'resellersform',
            // ],
            // [ 
            //     'title' => 'Reseller Actions',
            //     'action' => 'resellersform',
            // ],
            // [ 
            //     'title' => 'Reseller Actions',
            //     'action' => 'resellersform',
            // ],
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
                'title' => 'Example',
                'description' => 'Example extension with UI samples',
                'controller' => 'custom',
                'action' => 'form',
            ],
        ];
        }

        public function indexAction()
        {
            $this->forward('provisioningform');
            
        }
        //----------------------------------------------------Provisioning Account---------------------------------------//
        public function provisioningformAction()
        {
            // Display text
            $this->view->test = 'Provisioning Account for new user';
    
            // Init form here
            $form = new pm_Form_Simple();
 
            //user Api Key input
            $form->addElement('text', 'exampleUserApi', array(
                'label' => 'Enter user ApiKey',
                'value' => pm_Settings::get('exampleUserApi'),
                'required' => true,
                'validators' => array(
                    array('NotEmpty', true),
                ),
            ));
 
            //user email input
            $form->addElement('text', 'exampleEmail', array(
             'label' => 'Enter user Email',
             'value' => pm_Settings::get('exampleEmail'),
             'required' => true,
             'validators' => array(
                 array('StringLength', true, array(5, 255)),
             ),
         ));
 
         //user first name input
         $form->addElement('text', 'exampleFirstName', array(
             'label' => 'Enter user First Name',
             'value' => pm_Settings::get('exampleFirstName'),
             'required' => true,
             'validators' => array(
                 array('StringLength', true, array(1, 255)),
             ),
         ));
 
         //user last name input
         $form->addElement('text', 'exampleLastName', array(
             'label' => 'Enter user Last Name',
             'value' => pm_Settings::get('exampleLastName'),
             'required' => true,
             'validators' => array(
                 array('StringLength', true, array(1, 255)),
             ),
         ));
 
         //user password input
            $form->addElement('password', 'examplePassword', array(
             'label' => 'Enter Password',
             'value' => pm_Settings::get('examplePassword'),
             'required' => true,
             'description' => 'Password must be minimum 8 characters long, consist of lower and uppercase, alphanumeric and special characters',
             'validators' => array(
                 array('regex', false, array('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/')),
                 array('NotEmpty', true),
             ),
         ));
 
         //user product input
         $form->addElement('radio', 'exampleProduct', array(
             'label' => 'Enter Product',
             'multiOptions' => array(
                 'FreeAccount' => 'Free Account',
                 'BusinessAccount' => 'Business Account'),
             'value' => pm_Settings::get('exampleProduct'),
             'required' => true,
         ));
 
         //text to seperate 
         $form->addElement('text', 'name', [
             'label' => 'Fill out Business Data Below(Business Account):',
             'readonly' => true,
         ]);
 
         //user domain input
            $form->addElement('text', 'exampleDomain', array(
                'label' => 'Enter Domain',
                'value' => pm_Settings::get('exampleDomain'),
                'required' => false,
                'description' => 'Subdomains must be 1 to 63 characters long, consisting only of lowercase letters, numbers or hyphens',
                'validators' => array(
                    array('NotEmpty', true),
                    array('StringLength', true, array(1, 63)),
                    array('regex', false, array('/^[a-z]+(-[a-z]+)*/')),
 
                    
                ),
            ));
 
         //user company name input
            $form->addElement('text', 'exampleCompanyName', array(
             'label' => 'Enter Company Name',
             'value' => pm_Settings::get('exampleCompanyName'),
             'required' => false,
             'validators' => array(
                 array('StringLength', true, array(1, 63)),
             ),
         ));
 
         //user duration input
         $form->addElement('select', 'exampleDuration', array(
             'label' => 'Enter Duration',
             'multiOptions' => array(
                 'Monthly' => 'Monthly', 
                 'Quarterly' => 'Quarterly',
                 'Biannual' => 'Biannual',
                 'Annual' => 'Annual',
                 'OneTime' => 'OneTime'),
             'value' => pm_Settings::get('exampleDuration'),
             'required' => false,
         ));
 
         //user billing terms input
         $form->addElement('select', 'exampleBilling', array(
             'label' => 'Enter Billing Terms',
             'multiOptions' => array(
                 'PostPaid' => 'PostPaid', 
                 'Points' => 'Points',
                 'Credits' => 'Credits'),
             'value' => pm_Settings::get('exampleBilling'),
             'required' => true,
         ));
 
    
            $form->addControlButtons(array(
                'cancelLink' => pm_Context::getModulesListUrl(),
            ));
    
            if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
 
                // Form proccessing, setting and storing values of user input
                pm_Settings::set('exampleUserApi', $form->getValue('exampleUserApi'));
                pm_Settings::set('exampleDomain', $form->getValue('exampleDomain'));
                pm_Settings::set('exampleEmail', $form->getValue('exampleEmail'));
                pm_Settings::set('exampleFirstName', $form->getValue('exampleFirstName'));
                pm_Settings::set('exampleLastName', $form->getValue('exampleLastName'));
                pm_Settings::set('examplePassword', $form->getValue('examplePassword'));
                pm_Settings::set('exampleProduct', $form->getValue('exampleProduct'));
                pm_Settings::set('exampleDomain', $form->getValue('exampleDomain'));
                pm_Settings::set('exampleCompanyName', $form->getValue('exampleCompanyName'));
                pm_Settings::set('exampleDuration', $form->getValue('exampleDuration'));
                pm_Settings::set('exampleBilling', $form->getValue('exampleBilling'));
 
                //getting values stored above and put into variables
                $userApiKey = $form->getValue('exampleUserApi');
                $domain = $form->getValue('exampleDomain');
                $email = $form->getValue('exampleEmail');
                $firstname = $form->getValue('exampleFirstName');
                $lastname = $form->getValue('exampleLastName');
                $password = $form->getValue('examplePassword');
                $product = $form->getValue('exampleProduct');
                $domain = $form->getValue('exampleDomain');
                $companyname = $form->getValue('exampleCompanyName');
                $duration = $form->getValue('exampleDuration');
                $billingterms = $form->getValue('exampleBilling');
 
             //Tried to send request and call the provisionAccount in provisioning-api below
 
             //request parameters for free account
             if ($product == "FreeAccount"){
                 $data = array(
                     'internalApiKey'  => '}ASka}_N;OB7~=H1/,v6K<3]E~WSO^:+V{(naB>DD>;e<}v-8kM|D(`B9$',
                     'userApiKey'      => $userApiKey,
                     'userEmail'       => $email,
                     'userFirstName'   => $firstname,
                     'userLastName'    => $lastname,
                     'password'        => $password,
                     'product'         => $product,
                     'businessData'    => null,
                     'billingTerms'    => $billingterms,
                   );
     
                 $options = array(
                     'http' => array(
                       'method'  => 'POST',
                       'content' => json_encode( $data ),
                       'header'=>  "Content-Type: application/json\r\n" .
                                   "Accept: application/json\r\n"
                       )
                   );
             }
             
             //request parameter for business account
             if ($product == "BusinessAccount"){
                 $data = array(
                     'internalApiKey'  => '}ASka}_N;OB7~=H1/,v6K<3]E~WSO^:+V{(naB>DD>;e<}v-8kM|D(`B9$',
                     'userApiKey'      => $userApiKey,
                     'userEmail'       => $email,
                     'userFirstName'   => $firstname,
                     'userLastName'    => $lastname,
                     'password'        => $password,
                     'product'         => $product,
                     'businessData'    => array(
                         'domain' => $domain,
                         'companyName' => $companyname,
                         'duration' => $duration,
                     ),
                     'billingTerms'    => $billingterms,
                   );
     
                 $options = array(
                     'http' => array(
                       'method'  => 'POST',
                       'content' => json_encode( $data ),
                       'header'=>  "Content-Type: application/json\r\n" .
                                   "Accept: application/json\r\n"
                       )
                   );
             }
 
             $url = 'http://54.151.137.158:8080/provisioning-api/provisionAccount'; //url of API endpoint in route.ts
             $context  = stream_context_create( $options );
             $result = file_get_contents( $url, false, $context );
             $response = json_decode( $result );
 
 
 
             if(! $response ) {
                 die('Error, Could not call the API');
             }
             
 
             else{
                 $this->_status->addMessage('info', 'Account Provisoned Successfully');
             }
    
                $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
                
            }
    
            $this->view->form = $form;
        }

        //----------------------------------------------------Provisioning AddOns---------------------------------------//
        public function addonsformAction()
    {
        // Display simple text in view
        $this->view->test = 'This form is for Provisioning Add-Ons';

        // Init form here
        $form = new pm_Form_Simple();
        // $form->addElement('text', 'exampleText1', array(
        //     'label' => 'internalApiKey',
        //     'value' => pm_Settings::get('exampleText1'),
        //     'required' => true,
        //     'validators' => array(
        //         array('NotEmpty', true),
        //     ),
        // ));
        $form->addElement('text', 'exampleText2', array(
            'label' => 'userApiKey',
            'value' => pm_Settings::get('exampleText2'),
            'required' => true,
            'validators' => array(
                array('NotEmpty', true),
            ),
        ));
        $form->addElement('text', 'exampleText3', array(
            'label' => 'customerId',
            'value' => pm_Settings::get('exampleText3'),
            'required' => true,
            'validators' => array(
                array('NotEmpty', true),
                //validate customerId input format
                array('regex', false, array('/^[a-zA-Z\d]+$/')), //allow alphabets and digits only

            ),
        ));
        $form->addElement('text', 'exampleText4', array(
            'label' => 'amount',
            'value' => pm_Settings::get('exampleText4'),
            'required' => true,
            'validators' => array(
                array('NotEmpty', true),
                //validate amount input format
                array('regex', false, array('/^[0-9]+$/')), //allow digits/numbers only
                
            ),
        ));
        $form->addElement('text', 'exampleText5', array(
            'label' => 'domain',
            'value' => pm_Settings::get('exampleText5'),
            'required' => true,
            'validators' => array(
                array('NotEmpty', true),
                //validate domain input format
                array('regex', false, array('/^[A-Za-z0-9.-_]+$/')), //allow alphabtes,digits and '.','-','_'
            ),
        ));
        $form->addElement('radio', 'radio1', array (
            'label' => 'Product',
            'multiOptions' => ['AddOnOrgUsers' => 'AddOnOrgUsers', 'AddOnTemplates' => 'AddOnTemplates','AddOnPoints' => 'AddOnPoints'],
            'value' => pm_Settings::get('radio1'),
            'required' => true,
        ));
        $form->addElement('radio', 'radio2', array (
            'label' => 'Duration',
            'multiOptions' => ['Monthly' => 'Monthly', 'Quarterly' => 'Quarterly','Biannual' => 'Biannual','Annual' => 'Annual','OneTime' => 'OneTime'],
            'value' => pm_Settings::get('radio2'),
            'required' => true,
        ));
        $form->addElement('radio', 'radio3', array (
            'label' => 'Billing Terms',
            'multiOptions' => ['PostPaid' => 'PostPaid', 'Points' => 'Points','Credits' => 'Credits'],
            'value' => pm_Settings::get('radio3'),
            'required' => true,
        ));
       
        $form->addControlButtons(array(
            'cancelLink' => pm_Context::getModulesListUrl(),
        ));

        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            // Process form            
            // $internalApiKey = $form->getValue('exampleText1');
            $userApiKey = $form->getValue('exampleText2');
            $customerId = $form->getValue('exampleText3');
            $amount = $form->getValue('exampleText4');
            $int_amount=(int) $amount;
            $domain = $form->getValue('exampleText5');
            $product = $form->getValue('radio1');
            $duration = $form->getValue('radio2');
            $BillingTerms = $form->getValue('radio3');


            //Send Request Code
            
            //parameters
            $data = array(
                'internalApiKey' => '}ASka}_N;OB7~=H1/,v6K<3]E~WSO^:+V{(naB>DD>;e<}v-8kM|D(`B9$',
                'userApiKey' => $userApiKey,
                'customerId' => $customerId,
                'amount' => $int_amount,
                'domain' => $domain,
                'product' => $product,
                'duration' => $duration,
                'BillingTerms' => $BillingTerms,
              );
            $options = array(
                'http' => array(
                  'method'  => 'POST',
                  'content' => json_encode( $data ),
                  'header'=>  "Content-Type: application/json\r\n" .
                              "Accept: application/json\r\n"
                  )
              );

            $url = 'http://18.141.240.200:8080/provisioning-api/ProvisionAddOns'; //url of endpoint
            $context  = stream_context_create( $options );
            $result = file_get_contents( $url, false, $context );
            $response = json_decode( $result, true );

            if(! $response ) {
                die('Could not call API');
            }
            else{
                $this->_status->addMessage('info', 'Account Add-On Successful');
            }

            $this->_helper->json(['redirect' => pm_Context::getBaseUrl()]);
        }

        $this->view->form = $form;
    }

    //-----------------------------------------------------------------Domain Check form-----------------------------------------------------------------//
    public function domaincheckformAction()
    {
        // Display simple text in view
        $this->view->test = 'Domain Check, check if domain exists';

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
            'label' => 'Enter domain',
            'value' => pm_Settings::get('exampleText2'),
            'required' => true,
            'validators' => array(
                array('NotEmpty', true),
                array('regex', false, array('/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/')), //validate domain format
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
            $domain = $form->getValue('exampleText2');

            //send request below
            //parameters
            $data = array(
                'userApiKey'      => $userApiKey,
                'domain'           => $domain,
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

            $url = 'http://54.151.137.158:8080/provisioning-api/domainCheck'; //url of endpoint
            $context  = stream_context_create( $options );
            $result = file_get_contents( $url, false, $context );
            $response = json_decode( $result, true );

            if(! $response ) {
                die('Could not call the API');
            }

            //checks
            if ($userApiKey !== 'testing'){
                $this->_status->addMessage('error','Invalid userApiKey');
            }
            if(checkdnsrr(($domain),"A") == true){
                $this->_status->addMessage('error','Domain is unavailable');
            }
            else{
                $this->_status->addMessage('info', 'Domain is available');
            }

            $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
            
        }

        $this->view->form = $form;
    }
}