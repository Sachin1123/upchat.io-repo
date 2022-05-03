<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    
  
   
    protected $fillable = [
    	 'company_name', 'user_id', 'apex_company','apex_username', 'apex_password', 'status'
    ];

    protected $casts = [
      
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
   
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
  
}
