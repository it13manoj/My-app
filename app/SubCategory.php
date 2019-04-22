<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
      protected $table = 'subcategories';
     /*protected $fillable = array(
        'country_id',
        'country_name',
        'country_currency_code',
        'country_status',
        'country_code'
    );*/
     public $timestamps = false;
}
