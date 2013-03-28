<?php namespace RobClancy\Validation;

use RobClancy\ValidationRules\Buildable;

class Factory {
	
	protected $builder;
	
	public function __construct(Buildable $builder)
	{
		$this->builder = $builder;
	}
	
	public function make()
	{
		return new Input($this->builder);
	}
}