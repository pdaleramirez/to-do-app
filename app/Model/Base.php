<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 * @package App\Model
 */
class Base extends Model
{
    /**
     * Add validation rules here
     * @var array
     */
    protected $rules = [];

    protected $errors;

    /**
     * Validate data based on the rules on the child class
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        // make a new validator object
        $v = \Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            $this->errors = $v->errors();

            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}