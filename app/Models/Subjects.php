<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjects extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'subjects';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'observation'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relations
    public function school()
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Employee::class,'school_subjects_teachers','subject_id','employee_id');
    }

    //Accessors and Mutators

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtolower($value)
        );
    }
}
