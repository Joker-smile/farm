<?php

namespace App\Presenters;
use Illuminate\Support\Facades\Storage;
use Laracasts\Presenter\Presenter;

/**
 * Class ProductPresenter
 *
 * @package namespace App\Presenters;
 */
class ProductPresenter extends Presenter
{
    public function thumbs(){
        $thumbs = [];

        foreach ($this->thumb as $thumb){
            array_push($thumbs, Storage::url($thumb));
        }

        return $thumbs;
    }
}
