<?php

namespace App\Exports;

use App\Models\User_Hr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $selectedUsers;

    public function __construct($selectedUsers = [])
    {
        $this->selectedUsers = $selectedUsers;
    }

    public function collection()
    {
        return User_Hr::select('ma_so','ho_va_ten','gioi_tinh' ,'email', 'bo_phan','chuc_danh_chuyen_mon', 'dt_lien_he')
                      ->whereIn('id', $this->selectedUsers)
                      ->get();
    }

    public function headings(): array
    {
        return [
            'Mã nhân viên',
            'Tên nhân viên ',
            'Giới tính' ,
            'Email',
            'Bộ phận ',
            'Chức danh',
            'Điện thoại'
        ];
    }
}
