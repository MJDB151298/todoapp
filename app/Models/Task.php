<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /*
     * Get the category associated with the task
     * */
    public function category(){
        return $this->hasOne(Category::class);
    }

    /*
     * Get the user associated with the task
     * */
    public function user(){
        return $this->hasOne(User::class);
    }

}
