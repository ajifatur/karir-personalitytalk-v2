<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tests';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = ['name', 'code'];

    /**
     * The companies that belong to the test.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_test', 'test_id', 'company_id');
    }

    /**
     * The positions that belong to the test.
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'position_test', 'test_id', 'position_id');
    }
}
