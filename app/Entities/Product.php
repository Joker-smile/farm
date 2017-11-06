<?php

namespace App\Entities;

use App\Presenters\ProductPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;

class Product extends Model
{

    use PresentableTrait;

    protected $presenter = ProductPresenter::class;

    protected $table = 'products';

    protected $fillable = ['name', 'price', 'category_id', 'content', 'thumb', 'status'];

    protected $casts = [
        'thumb' =>  'array'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getThumbAttribute($thumb){
        $full = [];

        foreach (json_decode($thumb, true) as $t){
            if (!Str::startsWith($t, 'http')){
                $t = Storage::url($t);
            }

            array_push($full, $t);
        }

        return $full;
    }

}
