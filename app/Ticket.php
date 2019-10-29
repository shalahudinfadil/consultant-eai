<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
      'modul_id','submodul_id','client_id','PIC','message','priority','status','img_links','opening_time','working_time','closing_time',
    ];

    protected $casts = [
      'img_links' => 'array',
    ];

    public function moduls()
    {
      return $this->belongsTo('App\Modul','modul_id');
    }

    public function submoduls()
    {
      return $this->belongsTo('App\Submodul','modul_id');
    }

    public function clients()
    {
      return $this->belongsTo('App\Client','client_id');
    }

    public function ticketNumber()
    {
      $number = $this->modul_id."-".$this->submodul_id."-".$this->client_id."-".$this->id;
      return $number;
    }

    public function scopeOfSubmodule($query,$id)
    {
      return $query->where('submodul_id',$id);
    }

    public function priority()
    {
      switch ($this->priority) {
        case 1 :
          return '<span class="badge badge-pill badge-success p-1">Low</span>';
          break;

        case 2 :
          return '<span class="badge badge-pill badge-warning p-1">Medium</span>';
          break;

        default:
          return '<span class="badge badge-pill badge-danger p-1">High</span>';
          break;
      }
    }

    public function status()
    {
      switch ($this->status) {
        case 1 :
          return 'Open';
          break;

        case 2 :
          return 'Working';
          break;

        default:
          return 'Closed';
          break;
      }
    }

    public function changeStatus()
    {
      switch ($this->status) {
        case 1 :
          return 'Working On';
          break;

        case 2 :
          return 'Close';
          break;

        default:
          return 'Closed';
          break;
      }
    }

    public function scopeOpenTicket($query)
    {
      return $query->where('status',1);
    }

    public function scopeWorkingTicket($query)
    {
      return $query->where('status',2);
    }

    public function scopeClosedTicket($query)
    {
      return $query->where('status',3);
    }

    public function scopeLowTicket($query)
    {
      return $query->where('priority',1);
    }

    public function scopeMediumTicket($query)
    {
      return $query->where('priority',2);
    }

    public function scopehighTicket($query)
    {
      return $query->where('priority',3);
    }

}
