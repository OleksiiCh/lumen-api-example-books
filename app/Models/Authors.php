<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class Authors extends Model {
    protected $fillable = ['title', 'created_by', 'updated_by'];
    protected $table = 'authors';
   
    public function Books()
    {
        return $this->hasOne('App\Models\Books', 'id', 'author');
    }
}

