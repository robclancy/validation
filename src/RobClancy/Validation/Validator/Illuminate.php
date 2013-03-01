<?php namespace RobClancy\Validation\Validator;

use Illuminate\Validation\Factory;

class Illuminate implements Validator {
	
	protected $errors = [];
	
	protected $factory;
	
	public function __construct(Factory $factory)
	{
		$this->factory = $factory;
	}
	
	public function check(array $input, array $rules)
	{
		$messages = [];
		foreach ($rules AS $rule)
		{
			// TODO: $rule->getFailMessage()
		}
		
		$validator = $this->factory->make($input, $rules, $messages);
		if ($validator->fails())
		{
			$this->errors = $validator->getErrors();
			return false;
		}
		
		return true;
	}
	
	public function getErrors()
	{
		return $this->errors;
	}
}