<?php

/* @author Gunnard Engebreth
 * @package app\models 
 */

namespace app\models;
use app\core\Model;
use app\core\Application;
use app\core\Controller;
use app\core\Request;

Class RegisterModel extends Model
{
	public string $firstName;
	public string $lastName;
	public string $email;
	public string $password;
	public string $passwordConfirm;


	public function register() 
	{
		return "Creating New USer";
	}

}
