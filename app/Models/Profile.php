<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'profiles';
    protected $primaryKey = 'id';

    protected  $fillable = [
        'uuid',
        'name'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relation
    public function users(){
        return $this->hasMany(User::class,'profile_id','id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
          set: fn($value) => strtolower($value),
        );
    }
}
