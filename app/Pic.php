<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{

  protected $fillable = [
    'email','name','password','client_id','token','verified','approved_at'
  ];

  public function client()
  {
    return $this->belongsTo('App\Client','client_id');
  }

  public function tickets()
  {
    return $this->hasMany('App\Ticket','pic_id');
  }
}
