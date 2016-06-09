<?php 

namespace App\Model;

use App\Model\Bouquet;
use Illuminate\Database\Eloquent\Model;
// use SleepingOwl\Admin\Traits\OrderableModel;

class Sort extends Model
{
    // use OrderableModel;

    // protected $fillable = ['title', 'test'];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function bouquets(){
        return $this->belongsToMany(Bouquet::class, 'bouquet_sort', 'sort_id');
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