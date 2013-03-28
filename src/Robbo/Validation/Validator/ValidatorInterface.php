<?php namespace Robbo\Validation\Validator;

interface ValidatorInterface {
	
	public function check(array $input, array $rules);
	
	public function getErrors();
}