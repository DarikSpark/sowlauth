<?php 

namespace App\Model;

use App\Model\Sort;
use Illuminate\Database\Eloquent\Model;
// use SleepingOwl\Admin\Traits\OrderableModel;

class Bouquet extends Model
{
    // use OrderableModel;

    // protected $fillable = ['title', 'test'];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    // protected $touches = ['bouquet_sort'];

    public function sorts(){
        return $this->belongsToMany(Sort::class, 'bouquet_sort', 'bouquet_id');
    }

    public function purchases()
    {
        return $this->belongsToMany('App\Model\Purchases', 'bouquet_purchase', 'bouquet_id');
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