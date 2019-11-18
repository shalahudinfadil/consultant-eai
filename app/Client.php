<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name'];

    public function tickets()
    {
      return $this->hasMany('App\Ticket','client_id');
    }

    public function pics()
    {
      return $this->hasMany('App\Pic','client_id');
    }
}
