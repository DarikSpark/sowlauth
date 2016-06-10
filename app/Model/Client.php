<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
// use SleepingOwl\Admin\Traits\OrderableModel;

class Client extends Model
{
    // use OrderableModel;

    // protected $fillable = ['title', 'test'];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function purhases()
    {
        return $this->hasMany('App\Model\Purchase');
    }

    // public function contacts()
    // {
    //     return $this->hasMany(Contact::class);
    // }

    // public function getOrderField()
    // {
    //     return 'order';
    // }

}