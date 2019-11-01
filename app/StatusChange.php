<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusChange extends Model
{
    protected $fillable = [
      'user_eid','ticket_id','changed_to','submodul_id'
    ];

    public function users()
    {
      return $this->belongsTo('App\User','user_eid','eid');
    }

    public function tickets()
    {
      return $this->belongsTo('App\Ticket','ticket_id','id');
    }

    public function submoduls()
    {
      return $this->belongsTo('App\Submodul','modul_id');
    }

    public function feed()
    {
      switch ($this->changed_to) {
        case 2 :
          return "<b>".$this->users->name."</b> changed Ticket <b>#".$this->tickets->ticketNumber()."</b> status to <b>WORKING</b><br>".$this->created_at->format('H:i, d M Y');
          break;

        case 3 :
          return "<b>".$this->users->name."</b> changed Ticket <b>#".$this->tickets->ticketNumber()."</b> status to <b>CLOSED</b><br>".$this->created_at->format('H:i, d M Y');
          break;
      }
    }
}
