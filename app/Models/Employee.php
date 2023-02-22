<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::creating(function (Employee $employee){
            $employee->uuid = Str::uuid();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relation
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subjects::class,'school_subjects_teachers','employee_id','subject_id');
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class,'occupation_id','id');
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class,'addressable');
    }

}
