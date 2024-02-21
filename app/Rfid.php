<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{

    protected $table = 'Rfid'; // Set the table name

    protected $fillable = [
        'Rfid_tag',
    ];
}
