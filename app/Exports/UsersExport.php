<?php
namespace App\Exports;

use App\Models\User_Hr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User_Hr::select('ho_va_ten', 'email', 'gioi_tinh', 'ngay_sinh')->get();
    }

    public function headings(): array
    {
        return [
            'Tên',
            'Email',
            'Giới Tính',
            'Ngày Sinh'
        ];
    }
}
