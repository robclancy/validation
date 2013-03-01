<?php namespace RobClancy\Validation\Validator;

interface Validator {
	
	public function check($input, $rules);
	
	public function getErrors();
}