<?php namespace Robbo\Validation;

use Robbo\ValidationRules\Builder\BuilderInterface;

class InputFactory {
	
	protected $builder;
	
	public function __construct(BuilderInterface $builder)
	{
		$this->builder = $builder;
	}
	
	public function make()
	{
		return new Input($this->builder);
	}
}