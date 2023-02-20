<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected  $fillable = [
        'uuid',
        'name',
        'qtd_school',
        'qtd_employee',
        'license',
        'license_due_date',
        'register_mec',
        'ie'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relations

    public function schools()
    {
        return $this->hasMany(School::class,'company_id','id');
    }


}
