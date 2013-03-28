<?php namespace Robbo\Validation;

use Robbo\Validation\Validator\ValidatorInterface;

trait Validate {
	
	protected $inputFactory;
	
	protected $validator;
	
	protected $inputRules = [];
	
	protected $validationErrors = [];
	
	protected $validatedInput;
	
	protected function defineInput()
	{
	}
	
	public function input($key)
	{
		return $this->inputRules[$key] = $this->inputFactory->make($key);
	}
	
	protected function setupValidation(){}
	
	public function validate(array $input, $defineInput = null)
	{
		$this->setupValidation();
		
		$onlyRules = false;
		if ( ! is_null($defineInput) OR ! $defineInput instanceof \Closure)
		{
			$onlyRules = is_null($defineInput) ? false : (array) $defineInput;
			
			$defineInput = function()
			{
				$this->defineInput();
			};
		}
		
		$this->inputRules = [];
		$defineInput($this);

		if ($onlyRules)
		{
			$this->inputRules = array_intersect_key($this->inputRules, array_flip($onlyRules));
		}

		$input = array_intersect_key($input, $this->inputRules);
		
		return $this->checkValidates($input, $this->inputRules);
	}
	
	protected function checkValidates($input, $rules)
	{
		$this->validationErrors = [];
		$this->validatedInput = [];
		
		if ($this->validator->check($input, $rules))
		{
			$this->validatedInput = $input;
			return true;
		}
		
		$this->validationErrors = $this->validator->getErrors();
		return false;
	}
	
	public function getValidatedInput()
	{
		return $this->validatedInput;
	}
	
	public function hasErrors()
	{
		return ! empty($this->validationErrors);
	}
	
	public function getErrors()
	{
		return $this->validationErrors;
	}
	
	public function setInputFactory(InputFactory $factory)
	{
		$this->inputFactory = $factory;
	}
	
	public function setValidator(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}
}