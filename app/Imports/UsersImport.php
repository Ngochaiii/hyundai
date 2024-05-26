<?php

namespace App\Imports;

use App\Models\User_Hr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;


class UsersImport implements ToModel, WithHeadingRow
{
    protected $currentEmployee;
    protected $familyData;

    public function __construct()
    {
        $this->currentEmployee = null;
        $this->familyData = [];
    }

    public function model(array $row)
    {
        $maSo = $this->getValue($row, 'ma_so');
        $maChiTiet = $this->getValue($row, 'ma_chi_tiet');

        // Nếu là nhân viên mới (không có mã chi tiết), lưu lại thông tin nhân viên hiện tại và gia đình của họ
        if (!empty($maSo) && empty($maChiTiet)) {
            // Lưu nhân viên trước đó nếu tồn tại
            if ($this->currentEmployee !== null) {
                $this->saveCurrentEmployee();
            }

            // Khởi tạo nhân viên mới
            $this->currentEmployee = $this->extractEmployeeData($row);
            $this->familyData = [];
        }

        // Nếu có mã chi tiết, đây là thành viên gia đình của nhân viên hiện tại
        if (!empty($maChiTiet)) {
            $this->familyData[] = $this->extractFamilyData($row);
        }

        // Thêm debug log
        Log::info('Family Data', $this->familyData);

        return null; // Trả về null để không lưu trữ trực tiếp trong quá trình import
    }

    public function __destruct()
    {
        // Lưu lại nhân viên cuối cùng khi quá trình import kết thúc
        $this->saveCurrentEmployee();
    }

    private function saveCurrentEmployee()
    {
        if ($this->currentEmployee !== null) {
            $this->currentEmployee['gia_dinh'] = json_encode($this->familyData);

            // Thêm log để kiểm tra dữ liệu trước khi lưu
            Log::info('Saving Employee', $this->currentEmployee);

            // Thêm kiểm tra xem `gia_dinh` có bị null trước khi lưu không
            Log::info('Family Data JSON', [$this->currentEmployee['gia_dinh']]);

            User_Hr::create($this->currentEmployee);
        }
    }

    private function extractEmployeeData(array $row)
    {
        return [
            'ma' => $this->getValue($row, 'ma'),
            'ma_so' => $this->getValue($row, 'ma_so'),
            'tinh_trang' => $this->getValue($row, 'tinh_trang'),
            'ho_va_ten' => $this->getValue($row, 'ho_va_ten'),
            'gioi_tinh' => $this->getValue($row, 'gioi_tinh'),
            'nam_sinh' => $this->transformDate($this->getValue($row, 'nam_sinh')),
            'ngay' => $this->transformNumeric($this->getValue($row, 'ngay')),
            'thang' => $this->transformNumeric($this->getValue($row, 'thang')),
            'nam' => $this->transformNumeric($this->getValue($row, 'nam')),
            'so_cmt' => $this->getValue($row, 'so_cmt'),
            'ngay_cap' => $this->transformDate($this->getValue($row, 'ngay_cap')),
            'noi_cap' => $this->getValue($row, 'noi_cap'),
            'so_ho_chieu' => $this->getValue($row, 'so_ho_chieu'),
            'ngay_cap_1' => $this->transformDate($this->getValue($row, 'ngay_cap_1')),
            'noi_cap_1' => $this->getValue($row, 'noi_cap_1'),
            'dan_toc' => $this->getValue($row, 'dan_toc'),
            'ton_giao' => $this->getValue($row, 'ton_giao'),
            'quoc_tich' => $this->getValue($row, 'quoc_tich'),
            'trinh_do' => $this->getValue($row, 'trinh_do'),
            'chuyen_mon' => $this->getValue($row, 'chuyen_mon'),
            'noi_sinh' => $this->getValue($row, 'noi_sinh'),
            'nguyen_quan' => $this->getValue($row, 'nguyen_quan'),
            'dia_chi_thuong_tru' => $this->getValue($row, 'dia_chi_thuong_tru'),
            'ngay_ket_nap_dang' => $this->transformDate($this->getValue($row, 'ngay_ket_nap_dang')),
            'noi_ket_nap_dang' => $this->getValue($row, 'noi_ket_nap_dang'),
            'dt_lien_he' => $this->getValue($row, 'dt_lien_he'),
            'email' => $this->getValue($row, 'email'),
            'mst_tncn' => $this->getValue($row, 'mst_tncn'),
            'so_tai_khoan_ca_nhan' => $this->getValue($row, 'so_tai_khoan_ca_nhan'),
            'ngay_duoc_tuyen_dung' => $this->transformDate($this->getValue($row, 'ngay_duoc_tuyen_dung')),
            'td_theo_kh_hay_ps' => $this->getValue($row, 'td_theo_kh_hay_ps'),
            'so_nguoi_yeu_cau_td' => $this->transformNumeric($this->getValue($row, 'so_nguoi_yeu_cau_td')),
            'so_nguoi_da_td' => $this->transformNumeric($this->getValue($row, 'so_nguoi_da_td')),
            'thoi_gian_lam_viec_tai_hhp' => $this->getValue($row, 'thoi_gian_lam_viec_tai_hhp'),
            'loai_lao_dong' => $this->getValue($row, 'loai_lao_dong'),
            'bo_phan' => $this->getValue($row, 'bo_phan'),
            'chuc_vu' => $this->getValue($row, 'chuc_vu'),
            'chuc_vu_kiem_nhiem' => $this->getValue($row, 'chuc_vu_kiem_nhiem'),
            'chuc_danh_chuyen_mon' => $this->getValue($row, 'chuc_danh_chuyen_mon'),
            'noi_lv' => $this->getValue($row, 'noi_lv'),
            'he_so_luong' => $this->transformNumeric($this->getValue($row, 'he_so_luong')),
            'muc_luong_thoa_thuan' => $this->transformNumeric($this->getValue($row, 'muc_luong_thoa_thuan')),
            'phu_cap_xang_xe' => $this->transformNumeric($this->getValue($row, 'phu_cap_xang_xe')),
            'pc_dien_thoai' => $this->transformNumeric($this->getValue($row, 'pc_dien_thoai')),
            'pc_trach_nhiem' => $this->transformNumeric($this->getValue($row, 'pc_trach_nhiem')),
            'pc_khac' => $this->transformNumeric($this->getValue($row, 'pc_khac')),
            'tong_phu_cap' => $this->transformNumeric($this->getValue($row, 'tong_phu_cap')),
            'tong_thu_nhap' => $this->transformNumeric($this->getValue($row, 'tong_thu_nhap')),
            'thoi_diem_huong' => $this->transformDate($this->getValue($row, 'thoi_diem_huong')),
            'so_hdld' => $this->getValue($row, 'so_hdld'),
            'loai_hdld' => $this->getValue($row, 'loai_hdld'),
            'ngay_ky' => $this->transformDate($this->getValue($row, 'ngay_ky')),
            'ngay_het_han' => $this->transformDate($this->getValue($row, 'ngay_het_han')),
            'da_dong_bh_hay_chua' => $this->getValue($row, 'da_dong_bh_hay_chua'),
            'thang_dong_bh' => $this->getValue($row, 'thang_dong_bh'),
            'thoi_gian_dong_bh_tai_hhp' => $this->transformNumeric($this->getValue($row, 'thoi_gian_dong_bh_tai_hhp')),
            'so_so_bhxh' => $this->getValue($row, 'so_so_bhxh'),
            'so_the_bhyt' => $this->getValue($row, 'so_the_bhyt'),
            'ngach_luong_bhxh' => $this->getValue($row, 'ngach_luong_bhxh'),
            'bac' => $this->transformNumeric($this->getValue($row, 'bac')),
            'hs_luong' => $this->transformNumeric($row['hs_luong']),
            'hs_pc' => $this->transformNumeric($this->getValue($row, 'hs_pc')),
            'muc_luong_bhxh' => $this->transformNumeric($this->getValue($row, 'muc_luong_bhxh')),
            'thoi_diem_huong_1' => $this->transformDate($this->getValue($row, 'thoi_diem_huong_1')),
            'thoi_gian_nang_bac_luong_gan_nhat' => $this->transformDate($this->getValue($row, 'thoi_gian_nang_bac_luong_gan_nhat')),
            'thuoc_nhom_dieu_chinh_luong' => $this->getValue($row, 'thuoc_nhom_dieu_chinh_luong'),
            'qua_trinh_cong_tac_truoc_khi_vao_hhp' => $this->getValue($row, 'qua_trinh_cong_tac_truoc_khi_vao_hhp'),
            'qua_trinh_cong_tac_tai_hhp' => $this->getValue($row, 'qua_trinh_cong_tac_tai_hhp'),
            'mo_ta_cong_viec_chinh_hien_tai' => $this->getValue($row, 'mo_ta_cong_viec_chinh_hien_tai'),
            'ten_khoa_dao_tao' => $this->getValue($row, 'ten_khoa_dao_tao'),
            'thoi_gian_dao_tao' => $this->getValue($row, 'thoi_gian_dao_tao'),
            'tu_ngay_thang' => $this->transformDate($this->getValue($row, 'tu_ngay_thang')),
            'den_ngay_thang' => $this->transformDate($this->getValue($row, 'den_ngay_thang')),
            'chi_phi_dao_tao' => $this->transformNumeric($this->getValue($row, 'chi_phi_dao_tao')),
            'ket_qua_dao_tao' => $this->getValue($row, 'ket_qua_dao_tao'),
            'cam_ket_dao_tao' => $this->getValue($row, 'cam_ket_dao_tao'),
            'khen_thuong' => $this->getValue($row, 'khen_thuong'),
            'ky_luat' => $this->getValue($row, 'ky_luat'),
            'ly_do_khen_thuong_ky_luat' => $this->getValue($row, 'ly_do_khen_thuong_ky_luat'),
            'hinh_thuc_khen_thuong_ky_luat' => $this->getValue($row, 'hinh_thuc_khen_thuong_ky_luat'),
            'duoc_cap_bhld_hay_khong' => $this->getValue($row, 'duoc_cap_bhld_hay_khong'),
            'loai_bhld' => $this->getValue($row, 'loai_bhld'),
            'so_luong' => $this->transformNumeric($this->getValue($row, 'so_luong')),
            'don_gia' => $this->transformNumeric($this->getValue($row, 'don_gia')),
            'thanh_tien' => $this->transformNumeric($this->getValue($row, 'thanh_tien')),
            'ngay_cap_2' => $this->transformDate($this->getValue($row, 'ngay_cap_2')),
            'ngay_het_han_dinh_muc' => $this->transformDate($this->getValue($row, 'ngay_het_han_dinh_muc')),
            'da_duoc_tap_huan_atvsld_hay_chua' => $this->getValue($row, 'da_duoc_tap_huan_atvsld_hay_chua'),
            'ngay_viet_don' => $this->transformDate($this->getValue($row, 'ngay_viet_don')),
            'ngay_nghi_viec' => $this->transformDate($this->getValue($row, 'ngay_nghi_viec')),
            'ly_do' => $this->getValue($row, 'ly_do'),
            'ttcd_so' => $this->getValue($row, 'ttcd_so'),
            'ngay_tra_so_bhxh' => $this->transformDate($this->getValue($row, 'ngay_tra_so_bhxh')),
            'anh' => $this->getValue($row, 'anh'),
        ];
    }
    private function extractFamilyData(array $row)
    {
        return [
            'ma_chi_tiet' => $this->getValue($row, 'ma_chi_tiet'),
            'ho_ten' => $this->getValue($row, 'ho_ten'),
            'nam_sinh' => $this->transformDate($this->getValue($row, 'nam_sinh')),
            'nghe_nghiep' => $this->getValue($row, 'nghe_nghiep'),
            'noi_o' => $this->getValue($row, 'noi_o'),
            'quan_he' => $this->getValue($row, 'quan_he') // Thêm quan hệ thành viên gia đình (ví dụ: vợ, con)
        ];
    }

    private function transformDate($value)
    {
        try {
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            $date = \DateTime::createFromFormat('d/m/Y', $value);
            return $date ? $date->format('Y-m-d') : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function transformNumeric($value)
    {
        try {
            return is_numeric($value) ? floatval($value) : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function getValue($row, $key)
    {
        return isset($row[$key]) ? $row[$key] : null;
    }
}
