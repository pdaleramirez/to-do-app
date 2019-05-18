<?php

namespace App\Model;


class ToDo extends Base
{
    protected $table = 'todo';

    protected $fillable = [
        'description',
        'groupId',
        'completed'
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * Validation rules needed for the base class
     *
     * @var array
     */
    protected $rules = array(
        'description' => 'required',
        'completed' => 'required|boolean'
    );
}
