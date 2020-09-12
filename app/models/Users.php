<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;
    /**
     *
     * @var string
     */
    public $name;
    /**
     *
     * @var string
     */
    public $email;


}
