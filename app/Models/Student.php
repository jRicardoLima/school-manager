<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'birth_date',
        'sex',
        'cpf',
        'rg',
        'responsible_name',
        'responsible_cpf',
        'kinsman',
        'has_disease',
        'which_disease',
        'school_id',
    ];

    protected static function booted(): void
    {
        static::creating(function (Student $student){
            $student->uuid = Str::uuid();
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

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class,'addressable');
    }
}
