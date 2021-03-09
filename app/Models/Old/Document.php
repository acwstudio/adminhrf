<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_documents_upload';

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function file()
    {
        return $this->hasOne(Image::class, 'id', 'file_id');
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'id', 'gallery_id');
    }
}
