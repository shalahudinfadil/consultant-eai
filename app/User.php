<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'eid';
    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'eid', 'name', 'password','role_id','last_login',
    ];

    protected $dates = ['last_login'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function roles()
    {
      return $this->belongsTo('App\Role','role_id');
    }

    public function assignments()
    {
      return $this->hasOne('App\Assignment','eid','eid');
    }

    public function scopeConsultant($query)
    {
      return $query->where('role_id',2)->with('assignments');
    }

    public function lastLogin()
    {
      if ($this->last_login != null) {
        $carbonizedLastLogin = Carbon::instance($this->last_login)->setTimezone('Asia/Jakarta');
        switch ($carbonizedLastLogin->diffInDays(Carbon::now())) {
          //today
          case 0:
            $lastLogin = $carbonizedLastLogin->format('h:i A');
            break;

          case 1:
            $lastLogin = 'Yesterday';

          default:
            $lastLogin = $carbonizedLastLogin->format('d/m/Y');
            break;
        }

        return $lastLogin;
      }

      return 'Hasn\'t Login Yet';
    }
}
