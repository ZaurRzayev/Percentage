<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JsonSerializable;

class percentage extends Model implements JsonSerializable
{
    use HasFactory;

    protected $fillable=['name'];


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'bracket_string' => $this->bracket_string,
            'percentage' => $this->percentage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
