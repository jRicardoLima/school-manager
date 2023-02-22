<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::creating(function (Subjects $subjects){
            $subjects->uuid = Str::uuid();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relations
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function teachers(): BelongsToMany
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
