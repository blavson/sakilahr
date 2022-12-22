<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptEmp extends Model
{
    use HasFactory;

    protected $table = 'dept_emp';
    protected $guarded = [];
    protected $primaryKey ='department_id';


    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }

}
