<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class adminModel extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;


    protected $table = 'tbadmins';
    protected $fillable = [
        'adm_id',
        'adm_cpf',
        'adm_name',
        'adm_email',
        'adm_pass',
        'adm_last_access',
        'adm_date',
        'adm_status'
    ];
}
