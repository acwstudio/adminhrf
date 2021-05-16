<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractAPIModel extends Model
{
    /**
     * @return string
     */
    abstract public function type();

    /**
     * @return Collection
     */
    public function allowedAttributes(): Collection
    {
        return collect($this->attributes)->filter(function($item, $key){
            return !collect($this->hidden)->contains($key) && $key !== 'id' && $key !== 'slug';
        })->merge([
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    }
}
