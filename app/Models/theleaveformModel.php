<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class theleaveformModel extends Model

{   use Notifiable;


    protected $table = 'theleaveform';
    protected $fillable = ['StaffID','date','name','sapno','cadre','department','shift','leavetype','reason','leaveyear','entitledleave','daystaken','totdaysvac','outstanding','publicholidays','lcommences','lends','rdate','contact_add','phone','email','decl','decl_sig','decl_date','decl_name','decl_email','super_sig','super_date','super_name','super_email','hod_sig','hod_date','hod_name','hod_email','hr_sig','hr_date','hr_name','hr_email','status'];
}
