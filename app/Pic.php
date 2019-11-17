<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{

  protected $fillable = [
    'email','name','client_token','approved_at'
  ];
}
