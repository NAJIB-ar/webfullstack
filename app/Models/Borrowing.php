<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    public function user()
    {
        return $this->belongTo('App\Models\User', 'user_id', 'ide');
    }
    public function user()
    {
        return $this->belongTo('App\Models\User', 'user_id', 'ide');
    }
    // protected $fillable = ['borrower_id', 'book_id'];

    // public function borrower()
    // {
    //     return $this->belongsTo(Borrower::class);
    // }
    // public function book()
    // {
    //     return $this->belongsTo(Book::class);
    // }
}
