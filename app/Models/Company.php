<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = ['name', 'code', 'address', 'phone_number', 'founded_on'];

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the offices for the company.
     */
    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    /**
     * The tests that belong to the company.
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'company_test', 'company_id', 'test_id');
    }
}
