<?php namespace RobClancy\Validation\Validator;

interface ValidatorInterface {
	
	public function check($input, $rules);
	
	public function getErrors();
}