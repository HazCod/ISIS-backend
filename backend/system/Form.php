<?php
class Form
{
    private static $instance = null;
    private $safe = array();
    private $fieldmessage = array();

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->safe['get'] = new stdClass();
        $this->safe['post'] = new stdClass();

        $this->doSafeGet();
        $this->doSafePost();
    }

    private function doSafePost()
    {
        foreach($_POST as $key=>$value) {
            $this->safe['post']->$key = Controller::sanitize($value);
        }
    }

    private function doSafeGet()
    {
        foreach($_GET as $key=>$value) {
            $this->safe['get']->$key = Controller::sanitize($value);
        }
    }

    public function getGet($key = false)
    {
        if (!$key) {
            $return = $this->safe['get'];
        } else if (is_array($key)) {
            $return = new stdClass();
            foreach ($key as $value) {
                $return->$value = $this->getGet($value);
            }
        } else if (isset($this->safe['get']->$key)) {
            $return = $this->safe['get']->$key;
        } else {
            $return = false;
        }

        return $return;
    }

    public function getPost($key = false)
    {
        if (!$key) {
            $return = $this->safe['post'];
        } else if (is_array($key)) {
            $return = new stdClass();
            foreach ($key as $value) {
                $return->$value = $this->getPost($value);
            }
        } else if (isset($this->safe['post']->$key)) {
            $return = $this->safe['post']->$key;
        } else {
            $return = false;
        }

        return $return;
    }

    public function getFieldMessage($key)
    {
        if (isset($this->fieldmessage[$key]['message'])) {
            $message = $this->fieldmessage[$key]['message'];
        } else {
            $message = false;
        }

        return $message;
    }

    public function getFieldStatus($key)
    {
        if (isset($this->fieldmessage[$key]['status'])) {
            $status = $this->fieldmessage[$key]['status'];
        } else {
            $status = false;
        }

        return $status;
    }

    public function isFormValid()
    {
        foreach ($this->fieldmessage as $field) {
            if ((array_key_exists('status', $field)) && ($field['status'] != 'success')) {
                return false;
            }
        }

        return true;
    }

    public function validateDate($datekey, $daykey, $monthkey, $yearkey, $method = 'post')
    {
        if ((isset($this->safe[$method]->$daykey)) && (isset($this->safe[$method]->$monthkey)) && (isset($this->safe[$method]->$yearkey)) && (checkdate($this->safe[$method]->$monthkey, $this->safe[$method]->$daykey, $this->safe[$method]->$yearkey))) {
            $this->fieldmessage[$datekey]['status'] = 'success';
            $return = true;
        } else {
            $this->fieldmessage[$datekey]['message'] = 'must be a valid date';
            $this->fieldmessage[$datekey]['status'] = 'error';
            $return = false;;
        }

        return $return;
    }

    public function validateLength($key, $minlength = 1, $maxlength= 100000, $method = 'post')
    {
        if ((isset($this->safe[$method]->$key)) && (strlen($this->safe[$method]->$key) >= $minlength) && (strlen($this->safe[$method]->$key)<=$maxlength)) {
            $this->fieldmessage[$key]['status'] = 'success';
            $return = true;
        } else {
            $this->fieldmessage[$key]['message'] = "moet tussen $minlength en $maxlength tekens lang zijn";
            $this->fieldmessage[$key]['status'] = 'error';
            $return = false;
        }

        return $return;
    }

    public function validateNumeric($key, $method = 'post')
    {
        if ((isset($this->safe[$method]->$key)) && (is_numeric($this->safe[$method]->$key))) {
            $this->fieldmessage[$key]['status'] = 'success';
            $return = true;
        } else {
            $this->fieldmessage[$key]['message'] = "Must be numeric.";
            $this->fieldmessage[$key]['status'] = 'error';
            $return = false;
        }

        return $return;
    }

    public function validateInteger($key, $method = 'post')
    {
        if ((isset($this->safe[$method]->$key)) && (is_int((int)$this->safe[$method]->$key))) {
            $this->fieldmessage[$key]['status'] = 'success';
            $return = true;
        } else {
            $this->fieldmessage[$key]['message'] = "Must be an integer.";
            $this->fieldmessage[$key]['status'] = 'error';
            $return = false;
        }

        return $return;
    }

    public function validateInterval($key, $max = 50, $min = 0, $method = 'post')
    {
        if ((isset($this->safe[$method]->$key)) && ($this->safe[$method]->$key >= $min) && ($this->safe[$method]->$key <= $max)) {
            $this->fieldmessage[$key]['status'] = 'success';
            $return = true;
        } else {
            $this->fieldmessage[$key]['message'] = "moet tussen $min en  $max zijn.";
            $this->fieldmessage[$key]['status'] = 'error';
            $return = false;
        }

        return $return;
    }

    public function validateMail($key, $method='post')
    {
        $uit=false;
        if ((isset ($this->safe[$method]->$key)) && (filter_var($this->safe[$method]->$key,FILTER_VALIDATE_EMAIL)))
        {
            $this->fieldmessage[$key]['status']='success';
            $uit= true;
        }
        else
        {
            $this->fieldmessage[$key]['status']='error';
            $this->fieldmessage[$key]['message']='geen geldig email-adres';
        }
        return $uit;
    }

    public function checkuniekelogin($user, $key, $method='post')
    {
        if ($user && $user->$key == $this->safe[$method]->$key)
        {
            $this->fieldmessage[$key]["status"] = "error";
            $this->fieldmessage[$key]["message"] = "deze $key bestaat al";
            $uit = false;
        }
        else
        {
            $this->fieldmessage[$key]['status'] = 'success';
            $uit= true;
        }
        return $uit;
    }

    public function komtvoorin ($key, $verzameling, $mehod="post")
    {
        if (in_array($this->safe[$mehod]->$key, $verzameling))
        {
            $uit = true;
            $this->fiedlmessage[$key]['status']= succes;
        }
        else
        {
            $uit= false;
            $this->fieldmessage[$key]['status']="error";
            $this->fieldmessage[$key]['message']="dit is geen geldige waarde";
        }
        return $uit;
    }


}