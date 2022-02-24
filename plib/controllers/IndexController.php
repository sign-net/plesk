<?php

class IndexController extends pm_Controller_Action
{
    
   
       public function indexAction()
       {
        $session = new pm_Session();
        $client = $session->getClient();

        if ($client->isAdmin()) {
            $this->redirect('/client/index');
        } else if ($client->isReseller()) {
            $this->redirect('/client/index');
        } else if ($client->isClient()) {
            $this->redirect('/client/index');
        } else {
            echo "No access.";
        }
           
       }
   
     
}
