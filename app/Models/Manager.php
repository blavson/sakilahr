<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $table = "dept_manager";


    public function employee() {
        return $this->belongsTo(Employee::class);
    }

}
