<?php 

namespace App\Model;

// use App\Model\Sort;
use Illuminate\Database\Eloquent\Model;
// use SleepingOwl\Admin\Traits\OrderableModel;

class Purchase extends Model
{
    // use OrderableModel;

    // protected $fillable = ['title', 'test'];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    // protected $touches = ['bouquet_sort'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function client(){
        return $this->belongsTo('App\Model\Client');
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