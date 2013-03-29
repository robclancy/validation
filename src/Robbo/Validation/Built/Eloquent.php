<?php namespace Robbo\Validation\Built;

use Illuminate\Database\Eloquent\Model;
use Robbo\Validation\Illuminate as Validate;

class Eloquent extends Model {
	
	use Validate;
	
	public function save(array $options = [])
	{
		if ( ! $this->validate($this->attributes))
		{
			return false;
		}
		
		$key = $this->getKey();

		$this->attributes = $this->getValidatedInput();
		$this->attributes[$this->getkeyName()] = $key;

		return parent::save($options);
	}
}