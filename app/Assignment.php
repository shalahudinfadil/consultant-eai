<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['eid','modul_id','submodul_id'];

    public function users()
    {
      return $this->belongsTo('App\User','eid','eid');
    }

    public function moduls()
    {
      return $this->belongsTo('App\Modul','modul_id');
    }

    public function submoduls()
    {
      return $this->belongsTo('App\SubModul','submodul_id');
    }

    public function scopeOfConsultant($query,$eid)
    {
      return $query->where('eid',$eid);
    }
}
