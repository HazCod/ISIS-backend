<?php

abstract class Core_controller
{
    protected $template;
    protected $data = array();

    public function __construct()
    {
        $this->template = new Template();
        $this->template->flashmessage = $this->getFlashMessage();

        $this->form = Form::getInstance();
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return false;
    }

    public function setFlashmessage($message, $status = 'success')
    {
        $flashmessage = new stdClass();
        $flashmessage->status = $status;
        $flashmessage->message = $message;

        $_SESSION['flashmessage'] = $flashmessage;

        return $this;
    }

    public function setCurrentFlashmessage($message, $status = 'success')
    {
        $this->template->flashmessage = new stdClass();
        $this->template->flashmessage->status = $status;
        $this->template->flashmessage->message = $message;

        return $this;
    }

    public function getFlashMessage()
    {
        if (isset($_SESSION['flashmessage'])) {
            $flashmessage = $_SESSION['flashmessage'];
            unset($_SESSION['flashmessage']);
        } else {
            $flashmessage = false;
        }

        return $flashmessage;
    }

    public function redirect($newlocation = '')
    {
        header('Location: ' .  URL::base_uri($newlocation));
        exit();
    }

    public function controleerbevoegdheid($rol)
    {
        $rol= (is_array($rol)) ? $rol : array($rol);
        $uit = false;
        if (isset ($_SESSION['rol']))
        {
            if (in_array($_SESSION['rol'],$rol))
            {
                $uit= true;
            }
        }

        if (!$uit) {
            $this->setFlashmessage("u heeft niet de juiste rechten om deze pagina te zien","error");
            $this->redirect("Login");
        }

        return $uit;
    }
}
