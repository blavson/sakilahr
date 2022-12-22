<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'role_id',
        'email',
        'gender',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifier() {
        return $this->employee_id;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vacation(){
       return $this->hasMany(Vacation::class);
    }

    public function salary() {
      return  $this->hasOne(Salary::class);
    }

    public function deptemp() {
        return $this->hasMany(DeptEmp::class, 'employee_id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function manager() {
        return $this->hasOne(Manager::class, 'employee_id');
    }

    public function createManager() {
        if (!$this->manager) {
            $this->manager()->create(['employee_id' => $this->employee_id, 'department_id' => 123]);
        }
    }

    public function assignRole(Role $role) {
        return $this->roles()->save($role);
    }

    public function actAs(string $rolestring) {
        $role =  Role::where('name', $rolestring);

    }
}
