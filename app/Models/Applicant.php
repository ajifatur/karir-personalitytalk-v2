<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applicants';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = ['identity_number', 'latest_education', 'job_experiences'];

    /**
     * Get the user that owns the applicant.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the company that owns the applicant.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the position that owns the applicant.
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * Get the vacancy that owns the applicant.
     */
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    /**
     * Get the religion that owns the applicant.
     */
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    /**
     * Get the relationship that owns the applicant.
     */
    public function relationship()
    {
        return $this->belongsTo(Relationship::class, 'relationship_id');
    }
}
