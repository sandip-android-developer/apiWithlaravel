<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $table='registration';
    //protected $primaryKey='id';
    protected $hidden=['created_at','updated_at'];
}
