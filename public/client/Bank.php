<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'AUTO BANK | '.$CMSNT->site('tenweb');
    require_once(__DIR__ . "/Header.php");
    require_once(__DIR__ . "/Nav.php");
    
    // Lấy ID người dùng hiện tại
    $user_id = $getUser['id'];
?>

<style>
    .bank-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 30px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .bank-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .bank-header h1 {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .bank-header p {
        color: #7f8c8d;
        font-size: 18px;
    }

    .payment-methods {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .payment-method {
        flex: 1;
        min-width: 450px;
        max-width: 550px;
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .payment-method:hover {
        transform: translateY(-5px);
    }

    .method-content {
        flex: 1;
    }

    .method-header {
        margin-bottom: 1.5rem;
    }
    
    .method-header h3 {
        font-size: 24px;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .method-header small {
        font-size: 16px;
        color: #7f8c8d;
    }

    .account-info {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
    }
    
    .account-text {
        flex: 1;
        font-size: 18px;
        color: #34495e;
        font-weight: 500;
        margin: 0;
        padding-right: 30px;
    }
    
    .copy-icon {
        position: absolute;
        right: 15px;
        cursor: pointer;
        color: #3498db;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .copy-icon:hover {
        color: #2980b9;
        transform: scale(1.1);
    }

    .qr-code {
        flex-shrink: 0;
        width: 220px;
        text-align: center;
    }
    
    .qr-code img {
        width: 100%;
        max-width: 220px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .bank-guide {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        margin-top: 2rem;
    }
    
    .bank-guide h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #2c3e50;
        font-size: 24px;
    }
    
    .bank-guide p {
        font-size: 16px;
        color: #7f8c8d;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .bank-guide a {
        color: #3498db;
        font-weight: bold;
        text-decoration: none;
    }
    
    .bank-guide a:hover {
        text-decoration: underline;
    }
</style>

<div class="bank-container">
    <div class="bank-header">
        <h1>THÔNG TIN NGÂN HÀNG - MOMO</h1>
    </div>

    <div class="payment-methods">
        <!-- TECHCOMBANK -->
        <div class="payment-method">
            <div class="method-content">
                <div class="method-header">
                    <h3>Techcombank</h3>
                    <small>NGUYEN HOANG PHONG</small>
                </div>
                
                <div class="account-info">
                    <p class="account-text">19050294898016</p>
                    <span class="copy-icon" data-copy="19050294898016">
                        <i class="fas fa-copy"></i>
                    </span>
                </div>
            </div>
            
            <div class="qr-code">
                <img src="/assets/img/bank.jpg" alt="QR Techcombank">
            </div>
        </div>

        <!-- MOMO -->
        <div class="payment-method">
            <div class="method-content">
                <div class="method-header">
                    <h3>MoMo</h3>
                    <small>Nguyen Tran Gia Huy</small>
                </div>
                
                <div class="account-info">
                    <p class="account-text">0858823948</p>
                    <span class="copy-icon" data-copy="0858823948">
                        <i class="fas fa-copy"></i>
                    </span>
                </div>
            </div>
            
            <div class="qr-code">
                <img src="/assets/img/momo.jpg" alt="QR MoMo">
            </div>
        </div>

        <!-- Nội dung chuyển khoản -->
        <div class="payment-method">
            <div class="method-content">
                <div class="method-header">
                    <h3>Nội dung chuyển khoản</h3>
                </div>
                
                <div class="account-info">
                    <p class="account-text">ck id<?php echo $user_id; ?></p>
                    <span class="copy-icon" data-copy="ck id<?php echo $user_id; ?>">
                        <i class="fas fa-copy"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hướng dẫn -->
    <div class="bank-guide">
        <h2>THÔNG TIN QUAN TRỌNG</h2>
        
        <p>Nếu chuyển sai, vui lòng liên hệ ADMIN hoặc số điện thoại 0858823948 (8h-24h) để được hỗ trợ.</p>
        <p>Có thể nhờ chuyển hộ xong nhắn <a href="<?=$CMSNT->site('facebook_url')?>" target="_blank"><b>page shop</b></a> sẽ cộng tiền cho bạn.</p>
        <p>Nếu chuyển sai, vui lòng liên hệ ADMIN hoặc <a href="https://zalo.me/<?=$CMSNT->site('hotline_zalo')?>" target="_blank"><b>Zalo</b></a> (8h-24h) để được hỗ trợ.</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyIcons = document.querySelectorAll('.copy-icon');
        
        copyIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-copy');
                navigator.clipboard.writeText(textToCopy);
                
                const iconElement = this.querySelector('i');
                iconElement.className = 'fas fa-check';
                
                setTimeout(() => {
                    iconElement.className = 'fas fa-copy';
                }, 1500);
            });
        });
    });
</script>

<?php require_once(__DIR__ . "/Footer.php"); ?>