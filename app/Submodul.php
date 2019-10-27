<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submodul extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id','modul_id','name'];

    public function moduls()
    {
      return $this->belongsTo('App\Modul','modul_id');
    }

    public function assignments()
    {
      return $this->hasMany('App\Assignment','submodul_id');
    }

    public function tickets()
    {
      return $this->hasMany('App\Ticket','submodul_id');
    }
    
}
