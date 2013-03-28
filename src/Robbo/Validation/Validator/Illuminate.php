<?php namespace Robbo\Validation\Validator;

use Illuminate\Validation\Factory;

class Illuminate implements ValidatorInterface {
	
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
			$this->errors = $validator->errors();
			return false;
		}
		
		return true;
	}
	
	public function getErrors()
	{
		return $this->errors;
	}
}