<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'salary',
        'per_hour',
        'teacher',
        'birth_date',
        'sex',
        'cpf',
        'rg',
        'ctps_number',
        'ctps_serie',
        'occupation_id',
        'user_id',
        'school_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relation
    public function school()
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class,'school_subjects_teachers','employee_id','subject_id');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class,'occupation_id','id');
    }

}
