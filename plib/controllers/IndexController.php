<?php

class IndexController extends pm_Controller_Action
{
    public function init()
    {
           parent::init();
           // Init title for all actions
           $this->view->pageTitle = 'ProvisioningApi/provisionAccount Extension';
           // Init tabs for all actions
           $this->view->tabs = [
               [
                   'title' => 'Provision Account',
                   'action' => 'provisioningform',
               ],
               [
                   'title' => 'Reseller Actions',
                   'action' => 'resellersform',
               ]
           ];
       }
   
       public function indexAction()
       {
           $this->forward('provisioningform');
           
       }
   
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
   
           $this->view->form = $form;
       }



       public function resellersformAction()
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
}
