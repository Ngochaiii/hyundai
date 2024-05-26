<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('user__hrs', function (Blueprint $table) {
        $table->id();
        $table->string('ma')->nullable();
        $table->string('ma_so')->nullable();
        $table->string('ma_chi_tiet')->nullable();
        $table->string('tinh_trang')->nullable();
        $table->string('ho_va_ten')->nullable();
        $table->string('gioi_tinh')->nullable();
        $table->date('nam_sinh')->nullable();
        $table->integer('ngay')->nullable();
        $table->integer('thang')->nullable();
        $table->integer('nam')->nullable();
        $table->string('so_cmt')->nullable();
        $table->date('ngay_cap')->nullable();
        $table->string('noi_cap')->nullable();
        $table->string('so_ho_chieu')->nullable();
        $table->date('ngay_cap_1')->nullable();
        $table->string('noi_cap_1')->nullable();
        $table->string('dan_toc')->nullable();
        $table->string('ton_giao')->nullable();
        $table->string('quoc_tich')->nullable();
        $table->string('trinh_do')->nullable();
        $table->string('chuyen_mon')->nullable();
        $table->string('noi_sinh')->nullable();
        $table->string('nguyen_quan')->nullable();
        $table->string('dia_chi_thuong_tru')->nullable();
        $table->date('ngay_ket_nap_dang')->nullable();
        $table->string('noi_ket_nap_dang')->nullable();
        $table->string('dt_lien_he')->nullable();
        $table->string('email')->nullable();
        $table->string('mst_tncn')->nullable();
        $table->string('so_tai_khoan_ca_nhan')->nullable();
        $table->date('ngay_duoc_tuyen_dung')->nullable();
        $table->string('td_theo_kh_hay_ps')->nullable();
        $table->integer('so_nguoi_yeu_cau_td')->nullable();
        $table->integer('so_nguoi_da_td')->nullable();
        $table->string('thoi_gian_lam_viec_tai_hhp')->nullable();
        $table->string('loai_lao_dong')->nullable();
        $table->string('bo_phan')->nullable();
        $table->string('chuc_vu')->nullable();
        $table->string('chuc_vu_kiem_nhiem')->nullable();
        $table->string('chuc_danh_chuyen_mon')->nullable();
        $table->string('noi_lv')->nullable();
        $table->decimal('he_so_luong', 8, 2)->nullable();
        $table->decimal('muc_luong_thoa_thuan', 15, 2)->nullable();
        $table->decimal('phu_cap_xang_xe', 15, 2)->nullable();
        $table->decimal('pc_dien_thoai', 15, 2)->nullable();
        $table->decimal('pc_trach_nhiem', 15, 2)->nullable();
        $table->decimal('pc_khac', 15, 2)->nullable();
        $table->decimal('tong_phu_cap', 15, 2)->nullable();
        $table->decimal('tong_thu_nhap', 15, 2)->nullable();
        $table->date('thoi_diem_huong')->nullable();
        $table->string('so_hdld')->nullable();
        $table->string('loai_hdld')->nullable();
        $table->date('ngay_ky')->nullable();
        $table->date('ngay_het_han')->nullable();
        $table->string('da_dong_bh_hay_chua')->nullable();
        $table->integer('thang_dong_bh')->nullable();
        $table->string('thoi_gian_dong_bh_tai_hhp')->nullable();
        $table->string('so_so_bhxh')->nullable();
        $table->string('so_the_bhyt')->nullable();
        $table->string('ngach_luong_bhxh')->nullable();
        $table->integer('bac')->nullable();
        $table->decimal('hs_luong', 8, 2)->nullable();
        $table->decimal('hs_pc', 8, 2)->nullable();
        $table->decimal('muc_luong_bhxh', 15, 2)->nullable();
        $table->date('thoi_diem_huong_1')->nullable();
        $table->date('thoi_gian_nang_bac_luong_gan_nhat')->nullable();
        $table->string('thuoc_nhom_dieu_chinh_luong')->nullable();
        $table->text('qua_trinh_cong_tac_truoc_khi_vao_hhp')->nullable();
        $table->text('qua_trinh_cong_tac_tai_hhp')->nullable();
        $table->text('mo_ta_cong_viec_chinh_hien_tai')->nullable();
        $table->string('ten_khoa_dao_tao')->nullable();
        $table->string('thoi_gian_dao_tao')->nullable();
        $table->date('tu_ngay_thang')->nullable();
        $table->date('den_ngay_thang')->nullable();
        $table->decimal('chi_phi_dao_tao', 15, 2)->nullable();
        $table->string('ket_qua_dao_tao')->nullable();
        $table->string('cam_ket_dao_tao')->nullable();
        $table->string('khen_thuong')->nullable();
        $table->string('ky_luat')->nullable();
        $table->text('ly_do_khen_thuong_ky_luat')->nullable();
        $table->string('hinh_thuc_khen_thuong_ky_luat')->nullable();
        $table->string('duoc_cap_bhld_hay_khong')->nullable();
        $table->string('loai_bhld')->nullable();
        $table->integer('so_luong')->nullable();
        $table->decimal('don_gia', 15, 2)->nullable();
        $table->decimal('thanh_tien', 15, 2)->nullable();
        $table->date('ngay_cap_2')->nullable();
        $table->date('ngay_het_han_dinh_muc')->nullable();
        $table->string('da_duoc_tap_huan_atvsld_hay_chua')->nullable();
        $table->date('ngay_viet_don')->nullable();
        $table->date('ngay_nghi_viec')->nullable();
        $table->text('ly_do')->nullable();
        $table->string('ttcd_so')->nullable();
        $table->date('ngay_tra_so_bhxh')->nullable();
        $table->string('anh')->nullable();
        $table->string('ho_ten_bo_me')->nullable();
        $table->integer('nam_sinh_bo_me')->nullable();
        $table->string('nghe_nghiep')->nullable();
        $table->string('noi_o')->nullable();
        $table->string('ho_ten_anh_chi_em_ruot')->nullable();
        $table->integer('nam_sinh_1')->nullable();
        $table->string('nghe_nghiep_1')->nullable();
        $table->string('noi_o_1')->nullable();
        $table->string('vo_chong_con')->nullable();
        $table->integer('nam_sinh_2')->nullable();
        $table->string('nghe_nghiep_2')->nullable();
        $table->string('noi_o_2')->nullable();
        $table->string('noi_o_hien_tai')->nullable();
        $table->string('so_qd_cham_dut_hd')->nullable();
        $table->json('gia_dinh')->nullable(); // Thêm trường gia_dinh dạng JSON
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user__hrs');
    }
};
