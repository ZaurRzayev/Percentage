<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserFullName', 'NewDate', 'PostTitle', 'PostId', 'BusinessName', 'UserId', 'BusinessId', 'jobId', 'message'];

}
