<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id','name'];

    public function submoduls()
    {
      return $this->hasMany('App\Submodul','modul_id');
    }

    public function assignments()
    {
      return $this->hasMany('App\Assignment','modul_id');
    }

    public function tickets()
    {
      return $this->hasMany('App\Ticket','modul_id');
    }

    public function scopeOfModule($query,$id)
    {
      return $query->where('id',$id)->with('submoduls');
    }
}
