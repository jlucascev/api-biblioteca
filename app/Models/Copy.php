<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected $hidden = ['book_id'];

    public function book(){

    	return $this->belongsTo(Book::class,'book_id','ISBN');

    }
}
