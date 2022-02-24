<?php

class ClientController extends pm_Controller_Action
{
    public function init()
    {
           parent::init();
           // Init title for all actions
           $this->view->pageTitle = 'Sign.net Extension Home Page';
           // Init tabs for all actions
           $this->view->tabs = [
            //    [
            //        'title' => 'Provision Account',
            //        'action' => 'provisioningform',
            //    ],
            //    [ 
            //        'title' => 'Reseller Actions',
            //        'action' => 'resellersforms',
            //    ],
            //    [ 
            //     'title' => 'Reseller Actions',
            //     'action' => 'resellersform',
            //    ],
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
    
           
       }
      
}