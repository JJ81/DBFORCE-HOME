<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','MEMBER_PROFIT');
define('PAGE_NAME', '실시간수익인증');
define('PAGE_PATH', 'member_profit');

// 로그인이 되어 있는지 확인이 필요함.
if(empty($_SESSION['user_uuid'])){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '로그인이 필요합니다.');
    exit;
}

require_once ('./inc/common-data.php');

$id=getDataByGet('id');

if(empty($id)){
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.');
    exit;
}

use JCORP\Business\MemberProfitService\MemberProfitService as MemberProfit;
$inc=new MemberProfit();

$info2=$inc->getListById($id);

if(count($info2) == 0){
    AlertMsgAndRedirectTo(ROOT, '존재하지 않는 게시물입니다.');
    exit;
}

// 소유자가 일치하는지 확인할 것.
if ($info2[0]['writer_id'] !== $_SESSION['user_uuid']){
    AlertMsgAndRedirectTo(ROOT, '본 게시물에 대한 접근권한이 없습니다.');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 실시간수익인증</title>
</head>

<body>

<?php if(isMobile()){ ?>
    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="jp-content-m">

        <div class="form-member-post-write-page-m">
            <div class="form-member-post-write-page">
                <h2 class="page-header-pc">실시간수익인증 수정</h2>
                <div class="jp-alert-info">※ 내용을 입력하신 다음 “확인” 버튼을 눌러주세요.</div>
                <form action="<?php echo ROOT;?>response/res_modify_profit.php" method="post" enctype="multipart/form-data" class="form">
                    <table class="form-table-member-post">
                        <tr>
                            <th>제목</th>
                            <td>
                                <input type="text" name="title" placeholder="제목을 입력하세요." class="form-control form-title" required value="<?php echo $info2[0]['title'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td>
                                <textarea class="form-texarea" name="ir1" rows="10" cols="100" placeholder="내용을 입력하세요." required><?php echo $info2[0]['contents'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>기존 이미지</th>
                            <td>
                                <?php if(!empty($info2[0]['thumbnail'])){ ?>
                                    <img src="<?php echo ROOT;?>assets/uploads/member_profit/<?php echo $info2[0]['thumbnail'];?>" alt="" />
                                <?php }else{ ?>
                                    등록된 이미지가 없습니다.
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>이미지첨부</th>
                            <td>
                                <input type="file" name="thumbnail" accept="image/gif, image/jpg, image/jpeg, image/png" />
                                <div class="img-upload-guide-desc">
                                    ※ 기존 이미지를 변경할 경우에만 첨부해 주세요.<br />
                                    ※ 파일 크기는 3M이하, JPG, PNG, GIF 형식의 파일만 가능합니다.
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="form-member-profit-foot" style="">
                        <a href="<?php echo ROOT . PAGE_PATH;?>.php" class="btn-cancel-member-profit">취소</a>
                        &nbsp;
                        <button type="submit" class="btn-write-member-profit">수정</button>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                </form>
            </div>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>
    <?php require_once ('./inc/m-fixed-bottom.php');?>
<?php } else { ?>
    <?php require_once ('./inc/vt-header-main.php');?>
    <?php require_once ('./inc/notice-common-pc.php');?>

    <div class="contents-pc">

        <div class="form-member-post-write-page">
            <h2 class="page-header-pc">실시간수익인증 수정</h2>
            <div class="jp-alert-info">※ 내용을 입력하신 다음 “확인” 버튼을 눌러주세요.</div>
            <form action="<?php echo ROOT;?>response/res_modify_profit.php" method="post" enctype="multipart/form-data" class="form">
                <table class="form-table-member-post">
                    <tr>
                        <th>제목</th>
                        <td>
                            <input type="text" name="title" placeholder="제목을 입력하세요." class="form-control form-title" required value="<?php echo $info2[0]['title'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td>
                            <textarea class="form-texarea" name="ir1" rows="10" cols="100" placeholder="내용을 입력하세요." required><?php echo $info2[0]['contents'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>기존 이미지</th>
                        <td>
                            <?php if(!empty($info2[0]['thumbnail'])){ ?>
                                <img src="<?php echo ROOT;?>assets/uploads/member_profit/<?php echo $info2[0]['thumbnail'];?>" alt="" />
                            <?php }else{ ?>
                                등록된 이미지가 없습니다.
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>이미지첨부</th>
                        <td>
                            <input type="file" name="thumbnail" accept="image/gif, image/jpg, image/jpeg, image/png" />
                            <div class="img-upload-guide-desc">
                                ※ 기존 이미지를 변경할 경우에만 첨부해 주세요.<br />
                                ※ 파일 크기는 3M이하, JPG, PNG, GIF 형식의 파일만 가능합니다.
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="form-member-profit-foot" style="">
                    <a href="<?php echo ROOT . PAGE_PATH;?>.php" class="btn-cancel-member-profit">취소</a>
                    &nbsp;
                    <button type="submit" class="btn-write-member-profit">수정</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $id;?>" />
            </form>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>
<?php } ?>


<?php require_once ('./inc/foot.php');?>

</body>
</html>