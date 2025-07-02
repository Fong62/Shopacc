<?php
require_once(__DIR__."/config/config.php");
require_once(__DIR__."/config/function.php");
$title = 'HOME | '.$CMSNT->site('tenweb');
require_once(__DIR__ . "/public/client/Header.php");
require_once(__DIR__ . "/public/client/Nav.php");

$categories = $CMSNT->get_list("SELECT * FROM category WHERE display = 'SHOW' ORDER BY id ASC");
?>
<!-- <?php if (isset($_SESSION['username']) && $my_level == 'admin'): ?>
    <span class="mt-2 right">
        <a href="/public/admin/AddCategoryGroup.php">
            <button class="btn-pretty" style="position: absolute;right: 0px;">Thêm danh mục
            </button>
        </a>
    </span>
<?php endif; ?> -->

<section class="content">
    <div class="container-fluid">
        <!-- Phần Shop Acc Game -->
        <?php 
        $mainCategory = $CMSNT->get_row("SELECT * FROM category WHERE title = 'SHOP ACC GAME'");
        $groups = $CMSNT->get_list("SELECT * FROM groups WHERE category = '{$mainCategory['id']}' and display = 'SHOW'");
        ?>
        <center><img src="<?=$mainCategory['img']?>" class="city__icon"></center>
        <h1 class="guide__title"><?=$mainCategory['title']?></h1>
        
        <!-- Phần các game chính -->
        <div class="container-lg mb-3">
            <div class="container mt-5">
                <div class="row item-container justify-content-center">
                    <?php foreach($groups as $group): 
                        // Lấy category tương ứng với group
                        $targetCategory = $CMSNT->get_row("SELECT * FROM category WHERE title = '".str_replace('Acc ', '', $group['title'])."'");
                    ?>
                    <div class="col-md-3 col-4 p-1">
                        <a href="#<?=strtolower(str_replace(' ', '_', $targetCategory['title']))?>">
                            <div class="card card-custom">
                                <img class="card-img-top mx-auto d-block" src="<?=$group['img']?>" alt="<?=$group['title']?>">
                                <div class="p-2">
                                    <p class="card-text"><?=$group['title']?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Phần nút chức năng -->
            <div class="row mb-3">
                <div class="col text-center">
                    <span class="mt-2">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button class="btn-pretty">Hỗ Trợ</button>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" target="_blank" href="https://zalo.me/<?=$CMSNT->site('hotline_zalo')?>">
                                <img src="assets/img/images/icon/zalo.png" alt="zalo" style="max-width: 40px; height: auto; margin-bottom: -8px; margin-top: -8px;">
                                <?=$CMSNT->site('hotline_zalo')?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" target="_blank" href="<?=$CMSNT->site('facebook_url')?>">
                                <span style="background-color: #1877f2; border-radius: 4px; padding: 4px 8px 4px 8px;">
                                    <i style="color: white" class="fab fa-facebook-f fa-lg"></i>
                                </span> Facebook
                            </a>
                        </div>
                    </span>

                    <span class="mt-2">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button class="btn-pretty">Nạp Tiền</button>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= empty($_SESSION['username']) ? '/public/client/Login.php' : '/public/client/Recharge.php'; ?>">
                                <i class="fas fa-money-check-alt mr-1"></i> Nạp Thẻ
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= empty($_SESSION['username']) ? '/public/client/Login.php' : '/public/client/Bank.php'; ?>">
                                <i class="fas fa-university mr-1"></i> Chuyển Khoản
                            </a>
                        </div>
                    </span>
                    
                    <?php
                        $recharge_category = $CMSNT->get_row("SELECT * FROM category WHERE title = 'DỊCH VỤ NẠP GAME'");
                        $recharge_anchor = $recharge_category ? strtolower(str_replace(' ', '_', $recharge_category['title'])) : 'recharge_service';
                    ?>
                    <span class="mt-2">
                        <a href="#<?=$recharge_anchor?>"><button class="btn-pretty">Nạp Game</button></a>
                    </span>
                </div>
            </div>
            
            <!-- Phần ytb embbed và top use -->
            <section class="row banner-top p-1">
                <div id="miu-carousel" class="col-12 col-lg-8 carousel slide p-0" data-ride="carousel">
                    <div class="carousel-item active" style="margin-bottom: -5px;">
                        <iframe width="100%" height="470" src="<?=$CMSNT->site('youtube_embed')?>?autoplay=0&mute=0" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
                    </div>
                </div>
              <div class="col-12 col-lg-4 p-0" id="top_user">
                    <div class="leaderboard-card">
                        <div class="leaderboard-header">
                            <i class="fas fa-crown trophy-icon"></i>
                            <h3>TOP NẠP TIỀN</h3>
                            <i class="fas fa-coins coin-icon"></i>
                        </div>
                        
                        <div class="leaderboard-list">
                            <?php 
                            $topUsers = $CMSNT->get_list("SELECT username, total_money FROM users WHERE banned = 0 ORDER BY total_money DESC LIMIT 6");
                            $rank = 1;
                            $maxAmount = $topUsers[0]['total_money'] ?? 1;
                            
                            foreach($topUsers as $user): 
                                $percentage = ($user['total_money'] / $maxAmount) * 100;
                            ?>
                            <div class="leaderboard-item rank-<?= $rank ?>">
                                <div class="rank-badge">
                                    <span><?= $rank++ ?></span>
                                </div>
                                <div class="user-info">
                                    <div class="username"><?= $user['username'] ?></div>
                                    <div class="progress-container">
                                        <div class="progress-bar" style="width: <?= $percentage ?>%"></div>
                                    </div>
                                </div>
                                <div class="amount"><?= format_cash($user['total_money']) ?>đ</div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
 

        <!-- Phần các danh mục game động -->
        <?php foreach($categories as $category): 
            if($category['title'] == 'SHOP ACC GAME') continue;
            
            $groups = $CMSNT->get_list("SELECT * FROM groups WHERE category = '{$category['id']}' and display = 'SHOW'");
            $isRecharge = ($category['title'] == 'DỊCH VỤ NẠP GAME');
        ?>
            <center><img src="<?=$category['img']?>" class="city__icon"></center>
            <h2 class="guide__title" id="<?=strtolower(str_replace(' ', '_', $category['title']))?>"><?=$category['title']?></h2>
            
            <?php if($category['title'] == 'HONKAI STAR RAIL'): ?>
            <!-- <center id="library_starRail"><a href=""><button class="btn-pretty mb-3" style="margin-top: -15px;">Thư Viện</button></a></center> -->
            <?php endif; ?>
            
            <div class="container-lg">
                <div class="row justify-content-center align-items-center">
                    <?php foreach($groups as $group): 
                        if($isRecharge) {
                            $processing = $CMSNT->get_list("SELECT id FROM order_napgame WHERE groups = '{$group['id']}' AND status = 'xuly'");
                            $completed = $CMSNT->get_list("SELECT id FROM order_napgame WHERE groups = '{$group['id']}' AND status = 'hoanthanh'");
                        } else {
                            $accounts = $CMSNT->get_list("SELECT * FROM accounts WHERE groups = '{$group['id']}' AND status = 'Chưa bán'");
                            $sold = $CMSNT->get_list("SELECT * FROM accounts WHERE groups = '{$group['id']}' AND status = 'Đã bán'");
                        }
                    ?>
                    <article class="col-lg-3 col-sm-6 col-6">
                        <div class="genshin-product">
                            <div class="wrapper product-wrapper">
                                <a href="<?=$isRecharge ? '/public/client/GroupsRecharge.php?id='.$group['id'] : '/public/client/Groups.php?id='.$group['id']?>">
                                    <img class="img-banner" src="<?=$group['img']?>" alt="<?=$group['title']?>">
                                </a>
                                <h2 class="note__title text-uppercase"><?=$group['title']?></h2>
                                <div class="row g-0 info-line">
                                    <section class="row g-0 text-center">
                                        <label class="text-muted"><?=$isRecharge ? 'Đang nạp' : 'Số tài khoản'?></label>
                                        <span class="more-detail fs-4"><?=$isRecharge ? count($processing) : (!empty($accounts) ? count($accounts) : 0)?></span>
                                    </section>
                                </div>
                                <div class="row g-0 info-line">
                                    <section class="row g-0 text-center">
                                        <label class="text-muted"><?=$isRecharge ? 'Đã nạp' : 'Đã bán'?></label>
                                        <span class="more-detail fs-4"><?=$isRecharge ? count($completed) : (!empty($sold) ? count($sold) : 0)?></span>
                                    </section>
                                </div>
                                <div class="genshin-product-footer">
                                    <div class="hr-product mt-1 mb-1"></div>
                                    <a href="<?=$isRecharge ? '/public/client/GroupsRecharge.php?id='.$group['id'] : '/public/client/Groups.php?id='.$group['id']?>">
                                        <button class="btn-pretty mb-2">
                                            <?=$isRecharge ? 'Nạp Ngay' : (strpos($group['title'], 'Random') !== false ? 'Thử Vận May' : 'Khám Phá')?>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
// Thêm hiệu ứng scroll mượt khi click vào các link anchor
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });
            
            // Thêm hiệu ứng highlight cho phần được scroll tới
            targetElement.style.transition = 'all 0.3s';
            targetElement.style.boxShadow = '0 0 20px rgba(105, 224, 255, 0.5)';
            
            setTimeout(() => {
                targetElement.style.boxShadow = 'none';
            }, 1000);
        }
    });
});
</script>

<?php
require_once(__DIR__ . "/public/client/Footer.php");
?>