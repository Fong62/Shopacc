<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÔNG TIN | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<style>
/* Recharge Page Styles */
.recharge-container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: rgba(27, 25, 60, 0.85);
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.2);
}

.recharge-header {
    text-align: center;
    margin-bottom: 30px;
    color: #fff;
}

.recharge-header h2 {
    font-size: 28px;
    margin-bottom: 10px;
    text-shadow: 0 0 10px #69e0ff;
}

.recharge-header p {
    font-size: 16px;
    opacity: 0.8;
}

.recharge-notice {
    background: rgba(23, 162, 184, 0.2);
    border-left: 4px solid #17a2b8;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    color: #fff;
    display: flex;
    align-items: center;
}

.recharge-notice i {
    margin-right: 10px;
    font-size: 20px;
}

.recharge-form-container {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.recharge-form {
    flex: 1;
    background: rgba(255,255,255,0.05);
    padding: 25px;
    border-radius: 8px;
    border: 1px solid rgba(182, 137, 103, 0.3);
}

.recharge-guide {
    flex: 1;
    background: rgba(255,255,255,0.05);
    padding: 25px;
    border-radius: 8px;
    border: 1px solid rgba(182, 137, 103, 0.3);
}

.recharge-guide h3 {
    color: #69e0ff;
    margin-bottom: 15px;
    font-size: 20px;
}

.guide-list {
    list-style: none;
    padding: 0;
    margin-bottom: 20px;
}

.guide-list li {
    margin-bottom: 10px;
    color: #fff;
    display: flex;
    align-items: flex-start;
}

.guide-list i {
    margin-right: 10px;
    color: #69e0ff;
}

.support-notice {
    background: rgba(220, 53, 69, 0.2);
    border-left: 4px solid #dc3545;
    padding: 15px;
    border-radius: 5px;
    color: #fff;
    display: flex;
    align-items: center;
}

.support-notice i {
    margin-right: 10px;
    font-size: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 20px;
    color: #fff;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    background: rgba(255,255,255,0.9);
    border: 1px solid #b68967;
    border-radius: 5px;
    color: #634827;
    font-size: 16px;
    transition: all 0.3s;
    height: 48px;
}

.form-control:focus {
    border-color: #69e0ff;
    box-shadow: 0 0 0 3px rgba(105, 224, 255, 0.3);
    outline: none;
}

.btn-recharge {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #8a6232, #b68967);
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.btn-recharge:hover {
    background: linear-gradient(135deg, #b68967, #8a6232);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.btn-recharge:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.recharge-history {
    margin-top: 30px;
}

.recharge-history h3 {
    color: #69e0ff;
    margin-bottom: 20px;
    font-size: 22px;
    text-align: center;
}

#datatable {
    width: 100% !important;
    color: #fff;
}

#datatable thead th {
    background-color: #b68967;
    color: white;
    font-weight: 600;
    border: none !important;
    padding: 12px 15px;
    text-align: center;
}

#datatable tbody td {
    border-color: rgba(182, 137, 103, 0.3) !important;
    padding: 10px 15px;
    vertical-align: middle;
    text-align: center;
}

#datatable tbody tr:nth-child(even) {
    background-color: rgba(182, 137, 103, 0.1);
}

#datatable tbody tr:hover {
    background-color: rgba(182, 137, 103, 0.2);
}

.badge-carrier {
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: 600;
    background: #634827;
    color: white;
}

.recharge-alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    display: none;
}

.recharge-alert.success {
    background: rgba(40, 167, 69, 0.2);
    border-left: 4px solid #28a745;
    color: #fff;
    display: block;
}

.recharge-alert.error {
    background: rgba(220, 53, 69, 0.2);
    border-left: 4px solid #dc3545;
    color: #fff;
    display: block;
}
</style>

<div class="recharge-container">
    <div class="recharge-header">
        <h2><i class="fas fa-money-bill-wave"></i> NẠP THẺ CÀO</h2>
        <p>Nạp tiền nhanh chóng, an toàn và tiện lợi</p>
    </div>

    <div class="recharge-form-container">
        <div class="recharge-form">
            <div id="thongbao" class="recharge-alert"></div>
            
            <div class="form-group">
                <label for="loaithe"><i class="fas fa-sim-card"></i> NHÀ MẠNG</label>
                <select class="form-control" id="loaithe" required>
                    <option value="">-- Chọn nhà mạng --</option>
                    <option value="VIETTEL">VIETTEL</option>
                    <option value="MOBIFONE">MOBIFONE</option>
                    <option value="VINAPHONE">VINAPHONE</option>
                </select>
            </div>

            <div class="form-group">
                <label for="menhgia"><i class="fas fa-coins"></i> MỆNH GIÁ</label>
                <select class="form-control" id="menhgia" required>
                    <option value="">-- Chọn mệnh giá --</option>
                    <option value="20000">20,000 đ</option>
                    <option value="30000">30,000 đ</option>
                    <option value="50000">50,000 đ</option>
                    <option value="100000">100,000 đ</option>
                    <option value="200000">200,000 đ</option>
                    <option value="300000">300,000 đ</option>
                    <option value="500000">500,000 đ</option>
                    <option value="1000000">1,000,000 đ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="seri"><i class="fas fa-barcode"></i> SERI THẺ</label>
                <input type="text" class="form-control" id="seri" placeholder="Nhập seri thẻ">
            </div>

            <div class="form-group">
                <label for="pin"><i class="fas fa-key"></i> MÃ THẺ</label>
                <input type="text" class="form-control" id="pin" placeholder="Nhập mã thẻ">
            </div>

            <button id="NapThe" class="btn-recharge">
                <i class="fas fa-paper-plane"></i> YÊU CẦU NẠP
            </button>
        </div>

        <div class="recharge-guide">
            <h3><i class="fas fa-question-circle"></i> HƯỚNG DẪN NẠP THẺ</h3>
            <ul class="guide-list">
                <li><i class="fas fa-check-circle"></i> Ưu tiên thẻ Viettel, Vinaphone, Mobifone</li>
                <li><i class="fas fa-check-circle"></i> Mệnh giá thẻ cào được tính 80% (Nạp 100K nhận 80K)</li>
                <li><i class="fas fa-check-circle"></i> Thẻ mệnh giá 500K trở lên vui lòng liên hệ hỗ trợ</li>
                <li><i class="fas fa-check-circle"></i> Chọn đúng mệnh giá thẻ, nếu sai sẽ mất thẻ</li>
                <li><i class="fas fa-check-circle"></i> Nhập đúng số seri và mã thẻ, không có khoảng trắng</li>
            </ul>

            <div class="support-notice">
                <i class="fas fa-headset"></i> Liên hệ hỗ trợ ngay nếu nạp thẻ sau 5 phút chưa nhận được tiền
            </div>
        </div>
    </div>

    <div class="recharge-history">
        <h3><i class="fas fa-history"></i> LỊCH SỬ NẠP THẺ</h3>
        <div class="table-responsive">
            <table id="datatable" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thời gian</th>
                        <th>Nhà mạng</th>
                        <th>Mệnh giá</th>
                        <th>Seri/Mã</th>
                        <th>Thực nhận</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach($CMSNT->get_list(" SELECT * FROM `cards` WHERE `username` = '".$getUser['username']."' ORDER BY id ASC ") as $row){
                    ?>
                    <tr>
                        <td><?=$i++;?></td>
                        <td><?=$row['createdate'];?></td>
                        <td><span class="badge badge-carrier"><?=$row['loaithe'];?></span></td>
                        <td><?=format_cash($row['menhgia']);?></td>
                        <td><?=substr($row['seri'], 0, 3).'...'.substr($row['seri'], -3);?>/<?=substr($row['pin'], 0, 3).'...'.substr($row['pin'], -3);?></td>
                        <td><?=format_cash($row['thucnhan']);?></td>
                        <td><?=status($row['status']);?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#NapThe").on("click", function() {
    $('#NapThe').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type : 'NapThe',
            loaithe: $("#loaithe").val(),
            menhgia: $("#menhgia").val(),
            seri: $("#seri").val(),
            pin: $("#pin").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#NapThe').html(
                    'NẠP NGAY')
                .prop('disabled', false);
        }
    });
});
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<script>
$(function() {
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<script>
$(function() {
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>