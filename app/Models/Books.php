<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class Books extends Model {
    protected $fillable = ['name', 'author', 'created_by', 'updated_by'];
    protected $table = 'books';
 
    public function Author()
    {
         return $this->hasMany('App\Models\Authors',  'id', 'author_id');
    }

}