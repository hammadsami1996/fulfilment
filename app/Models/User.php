<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    use HasManyRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'title',
        'firstname',
        'lastname',
        'gender',
        'dob',
        'nationality_id',
        'postal_code',
        'address',
        'country_id',
        'city_id',
        'cv',
        'img',
//        'user_type_id',
        'phase'

    ];
    protected $appends = ['text'];
    protected $columns = [
        "id",
        "name",
    ];
    protected $search = [
        "name",
    ];
//    public function usertype()
//    {
//        return $this->belongsTo(User_type::class, 'user_type_id', 'id');
//    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllPermissions()
    {
        return DB::connection('mysql')->table('permissions')->get();

    }

    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function eligibility()
    {
        return $this->belongsTo(EligibilityToWork::class, 'id', 'user_id');
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'id', 'user_id');
    }

    public function emergency()
    {
        return $this->belongsTo(Emergency::class, 'id', 'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'id', 'user_id');
    }

    public function medical()
    {
        return $this->belongsTo(Medical::class, 'id', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function applyjob()
    {
        return $this->hasMany(Apply_job::class, 'user', 'id');
    }

    public function tent()
    {
        return $this->belongsTo(Tenant::class, 'name', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'job', 'id');
    }


}
