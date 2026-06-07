<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = ['borrower_id', 'book_id'];

    public function borrower(){
        return $this->belongsTo(Borrower::class);
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
