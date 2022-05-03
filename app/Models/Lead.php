<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'id', 'user_id', 'name','rejectReason', 'leadId', 'leadType', 'categoryId', 'chatId', 'companyId', 'companyKey', 'companyName', 'email', 'phone', 'username','reason', 'ipAddress', 'leadStatus', 'user_id', 'created_at','updated_at'
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
