<?php

class IndexController extends pm_Controller_Action
{
    public function indexAction()
    {
        $this->view->name = pm_Session::getClient()->getProperty('pname');
    }
}
