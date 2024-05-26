<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ma_chi_tiet',
        'ho_ten',
        'nam_sinh',
        'nghe_nghiep',
        'noi_o',
        'quan_he',
        // Các trường thông tin bổ sung khác
    ];

    public function user()
    {
        return $this->belongsTo(User_Hr::class, 'user_id');
    }
}
