<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}
?>
    </div>
</div>


<?php echo poll('basic'); // 설문조사 ?>
<?php echo visit('basic'); // 방문자수 ?>

<!--

<div id="ft">
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo get_pretty_url('content', 'company'); ?>">회사소개</a>
            <a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
            <a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a>
        </div>
        Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.<br>
    </div>
    <div class="ft_cnt">
    	<h2>사이트 정보</h2>
        <p class="ft_info">
        	회사명 : 회사명 / 대표 : 대표자명<br>
			주소  : OO도 OO시 OO구 OO동 123-45<br>
			사업자 등록번호  : 123-45-67890<br>
			전화 :  02-123-4567  팩스  : 02-123-4568<br>
			통신판매업신고번호 :  제 OO구 - 123호<br>
			개인정보관리책임자 :  정보책임자명<br>
		</p>
    </div>
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
    <?php
    if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
    <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
    <?php
    }

    if ($config['cf_analytics']) {
        echo $config['cf_analytics'];
    }
    ?>
</div>

-->

<?// include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/lib/visit.lib.php'); // 방문자스킨을 사용할 경우 선언되어야 함?>
	
	<footer>
		<div class="footerSell">
		

			<div class="PandCInfo">

				<p> 전화 : 031-893-4824<br>
					팩스 : 031-924-4824<br>
					이메일 : pcar114@naver.com<br>
					대표자 : 윤대권 <br>
					Copyright 2020. HPEERAGE All rights reserved<br>
				</p>

			</div>

			<div class="PandCInfo">
				<p> 통신판매업 신고번호 :<br>
					2021-수원권선-0422호<br>
					직업정보제공사업 신고번호 :<br>
					J1511020210001<br>
					<img class="bankLogo" src="/img/ibk_logo1.png" alt="은행로고"><br>
					계자번호 : 331-037276-01-014<br>
					예금주 : 윤대권
				</p>
			</div>
			
			<div class="hidden">
				<?php echo visit(); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
			</div>
			
			<div class="footerLogo" onclick="location.href='/index.php'">
				<p> 회사명 : 사람과자동차<br>
					사업자등록번호 : 751-26-01067<br>
					주소 : 경기도 수원시 권선구 호매실로104번길 23-37<br>
					(호매실동, H&#38;차량기술)<br>
				</p>

				<img class="ovm" src="/img/ft_logo.png" alt="하단로고">
			</div>
		</div>
	</footer>

<script>
jQuery(function($) {

    $( document ).ready( function() {

        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
        
        //상단고정
        if( $(".top").length ){
            var jbOffset = $(".top").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '.top' ).addClass( 'fixed' );
                }
                else {
                    $( '.top' ).removeClass( 'fixed' );
                }
            });
        }

        //상단으로
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });

    });
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>