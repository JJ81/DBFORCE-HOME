<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','QNA');
define('PAGE_NAME', '1:1문의게시판');
define('PAGE_PATH', 'qna_view');
define('PAGE_ORIGIN', 'qna');

// 로그인이 되어 있는지 확인이 필요함.
if(empty($_SESSION['user_uuid'])){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '로그인이 필요합니다.');
    exit;
}

require_once('./inc/common-data.php');




?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php');?>
    <title><?php echo $info[0]['title'];?>, 1:1문의 글쓰기</title>
</head>

<body>

<?php require_once('./inc/preloader.php');?>

<?php if(isMobile()){ ?>

    <?php require_once('./inc/vt-header-m.php');?>

    <div id="jp-content-m">

        <div class="form-member-post-write-page-m">
            <div class="form-member-post-write-page">
                <h2 class="page-header-pc">1:1문의 글쓰기</h2>
                <div class="jp-alert-info">※ 내용을 입력하신 다음 “확인” 버튼을 눌러주세요.</div>
                <form action="<?php echo ROOT;?>response/res_write_qna.php" method="post" enctype="multipart/form-data" class="form">
                    <table class="form-table-member-post">
                        <tr>
                            <th>제목</th>
                            <td>
                                <input type="text" name="title" placeholder="제목을 입력하세요." class="form-control form-title" required />
                            </td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td>
                                <textarea class="form-texarea" name="ir1" rows="10" cols="100" placeholder="내용을 입력하세요." required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>이미지첨부</th>
                            <td>
                                <input type="file" name="thumbnail" accept="image/gif, image/jpg, image/jpeg, image/png" />
                                <div class="img-upload-guide-desc">
                                    ※ 파일 크기는 3M이하, JPG, PNG, GIF 형식의 파일만 가능합니다.
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="form-member-profit-foot" style="">
                        <a href="<?php echo ROOT . PAGE_PATH;?>.php" class="btn-cancel-member-profit">취소</a>
                        &nbsp;
                        <button type="submit" class="btn-write-member-profit">확인</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('./inc/vt-footer-m.php');?>
    <?php require_once('./inc/m-fixed-bottom.php');?>

<?php } else { ?>
    <?php require_once('./inc/vt-header-main.php');?>
    <?php require_once('./inc/notice-common-pc.php');?>

    <div class="contents-pc">

        <div class="form-member-post-write-page">
            <h2 class="page-header-pc">1:1문의 글쓰기</h2>
            <div class="jp-alert-info">※ 내용을 입력하신 다음 “확인” 버튼을 눌러주세요.</div>
            <form action="<?php echo ROOT;?>response/res_write_qna.php" method="post" enctype="multipart/form-data" class="form">
                <table class="form-table-member-post">
                    <tr>
                        <th>제목</th>
                        <td>
                            <input type="text" name="title" placeholder="제목을 입력하세요." class="form-control form-title" required />
                        </td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td>
                            <textarea class="form-texarea" name="ir1" rows="10" cols="100" placeholder="내용을 입력하세요." required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>이미지첨부</th>
                        <td>
                            <input type="file" name="thumbnail" accept="image/gif, image/jpg, image/jpeg, image/png" />
                            <div class="img-upload-guide-desc">
                                ※ 파일 크기는 3M이하, JPG, PNG, GIF 형식의 파일만 가능합니다.
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="form-member-profit-foot" style="">
                    <a href="<?php echo ROOT . PAGE_PATH;?>.php" class="btn-cancel-member-profit">취소</a>
                    &nbsp;
                    <button type="submit" class="btn-write-member-profit">확인</button>
                </div>
            </form>
        </div>
    </div>

    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>


<?php require_once('./inc/foot.php');?>

</body>
</html>