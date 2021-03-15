<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCollection extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_documents_upload_collection';

    public function documents()
    {
        return $this->hasMany(Document::class, 'collection_id', 'id');
    }
}
