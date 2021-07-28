<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/ygt/common.php');

//set_session('ss_order_id', $uniqid);
$oid= get_uniqid();
set_session('ss_order_inicis_id', $oid);
$od_id= $oid;
require_once(G5_SHOP_PATH.'/settle_inicis.inc.php');
?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">
	<link rel="stylesheet" type="text/css" href="/css/pay.css">
    <script type="text/javascript" src="/gnu/js/jquery-1.8.3.min.js"></script>
	<?php
    //echo '<script language="javascript" type="text/javascript" src="'.$stdpay_js_url.'" charset="UTF-8"></script>';
    ?>
    <script type="text/javascript">
		function popupEvnt(state) {

		if (state == 'on') {
			$('#popupBox').css("display", "block");
		} else {
			$('#popupBox').css("display", "none");
		}

	};
	</script>
</head>

<body>
	<?php
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/headerComp.php');
	
	
        $첫번째등급업가격 = 25000;
        $두번째등급업가격 = 50000;
        $goods= "회원 등급업";
//        $order_action_url= "./payment.update.php";
        $bytertel= $member['mb_hp']? $member['mb_hp'] : $member['mb_tel'];
	
	
	?>

	<section>
        <script language="javascript" type="text/javascript" src="<?=$stdpay_js_url?>" charset="UTF-8"></script>
        <form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off">
            <?php /* 주문폼 자바스크립트 에러 방지를 위해 추가함 */ ?>
            <input type="hidden" name="good_mny"    value="0">
            <input type="hidden" name="version"     value="1.0" >
            <input type="hidden" name="mid"         value="<?php echo $mid; ?>">
            <input type="hidden" name="oid"         value="<?php echo $oid; ?>">
            <input type="hidden" name="goodname"    value="<?php echo $goods; ?>">
            <input type="hidden" name="price"       value="0">
            <input type="hidden" name="buyername"   value="<?php echo $member['mb_name']?>">
            <input type="hidden" name="buyeremail"  value="<?php echo $member['mb_email']?>">
            <input type="hidden" name="parentemail" value="">
            <input type="hidden" name="recvname"    value="">
            <input type="hidden" name="recvtel"     value="">
            <input type="hidden" name="recvaddr"    value="">
            <input type="hidden" name="recvpostnum" value="">

            <!-- 기타설정 -->
            <input type="hidden" name="currency"    value="WON">

            <!-- 결제방법 -->
            <input type="hidden" name="gopaymethod" value="">

            <!--
            SKIN : 플러그인 스킨 칼라 변경 기능 - 6가지 칼라(ORIGINAL, GREEN, ORANGE, BLUE, KAKKI, GRAY)
            HPP : 컨텐츠 또는 실물 결제 여부에 따라 HPP(1)과 HPP(2)중 선택 적용(HPP(1):컨텐츠, HPP(2):실물).
            Card(0): 신용카드 지불시에 이니시스 대표 가맹점인 경우에 필수적으로 세팅 필요 ( 자체 가맹점인 경우에는 카드사의 계약에 따라 설정) - 자세한 내용은 메뉴얼  참조.
            OCB : OK CASH BAG 가맹점으로 신용카드 결제시에 OK CASH BAG 적립을 적용하시기 원하시면 "OCB" 세팅 필요 그 외에 경우에는 삭제해야 정상적인 결제 이루어짐.
            no_receipt : 은행계좌이체시 현금영수증 발행여부 체크박스 비활성화 (현금영수증 발급 계약이 되어 있어야 사용가능)
            -->
            <input type="hidden" name="acceptmethod" value="<?php echo $acceptmethod; ?>">

            <!--
            플러그인 좌측 상단 상점 로고 이미지 사용
            이미지의 크기 : 90 X 34 pixels
            플러그인 좌측 상단에 상점 로고 이미지를 사용하실 수 있으며,
            주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 상단 부분에 상점 이미지를 삽입할수 있습니다.
            -->
            <!--input type="hidden" name="ini_logoimage_url"  value="http://[사용할 이미지주소]"-->

            <!--
            좌측 결제메뉴 위치에 이미지 추가
            이미지의 크기 : 단일 결제 수단 - 91 X 148 pixels, 신용카드/ISP/계좌이체/가상계좌 - 91 X 96 pixels
            좌측 결제메뉴 위치에 미미지를 추가하시 위해서는 담당 영업대표에게 사용여부 계약을 하신 후
            주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 좌측 결제메뉴 부분에 이미지를 삽입할수 있습니다.
            -->
            <!--input type="hidden" name="ini_menuarea_url" value="http://[사용할 이미지주소]"-->

            <!--
            플러그인에 의해서 값이 채워지거나, 플러그인이 참조하는 필드들
            삭제/수정 불가
            -->
            <input type="hidden" name="timestamp"   value="">
            <input type="hidden" name="signature"   value="">
            <input type="hidden" name="returnUrl"   value="<?php echo $returnUrl; ?>">
            <input type="hidden" name="mKey"        value="">
            <input type="hidden" name="charset"     value="UTF-8">
            <input type="hidden" name="payViewType" value="overlay">
            <input type="hidden" name="closeUrl"    value="<?php echo $closeUrl; ?>">
            <input type="hidden" name="popupUrl"    value="<?php echo $popupUrl; ?>">
            <input type="hidden" name="nointerest"  value="<?php echo $cardNoInterestQuota; ?>">
            <input type="hidden" name="quotabase"   value="<?php echo $cardQuotaBase; ?>">
            <input type="hidden" name="change_level" value="0">
            <div style="display:none">
                <input type="radio" name="od_settle_case" value="" checked>
            </div>
            <div class="sectionSell">
               
                <div class="payList">
                   	<div class="disNone">
                  	  <input type="<?=$bytertel?'hidden':'text'?>" name="buyertel"    value="<?php echo $bytertel;?>" placeholder="연락처">
                    </div>
    
                    <div class="payBox">
                        <div>

                            <span>STANDARD</span>
                            <div class="payInfo">
                                <!--결제 설명 추가란!-->
                                1. 가격
                               	<p class="word1">월 25,000 만원</p>
                               	
								2. 내용
                               	<p>- 채용공고</p>
                               	<p>- 이력서 지원 받기</p>
                                
                            </div>

                        </div>
<!--                        <button type="button" onclick="forderform_check(this.form, 4, <?=$첫번째등급업가격?>);">결제</button>-->
                        <button type="button" onclick=" location.href='./stdpay/INIStdPaySample/INIStdPayRequest.php'">결제</button>
                    </div>


                    <div class="payBox">
                        <div>

                            <span>PREMIUM</span>
                            <div class="payInfo">
                                <!--결제 설명 추가란!-->
                                1. 가격
                                <p class="word1">월 50,000 만원</p>
                                
								2. 내용
                           		<p>- 채용공고</p>
                           		<p>- 이력서 지원 받기</p>
                           		<p>- 이력서 검색</p>
                           		<p>- vip 헤드헌팅</p>
                            </div>
                        </div>
<!--                        <button type="button" onclick="loct(this.form, 6, <?=$두번째등급업가격?>);">결제</button>-->
                        <button type="button" onclick=" location.href='./stdpay/INIStdPaySample/INIStdPayRequest2.php'">결제</button>
                    </div>
                    
                    <div class="btn01">
						<button type="button" onclick="popupEvnt('on')">
							환불 규정
						</button>
					</div>

                </div>
                
            </div>
        </form>
    </section>
	<!-- popup window -->
    <div class="popupBox" id="popupBox">
		<div class="popupCont">
			<div class="titel">
				<h1>환불 규정</h1>
			</div>
			<div class="text">
				서비스 요금의 환불
				<p>①"회사"는 다음 각 호에 해당하는 경우 이용요금을 환불한다. 단, 각 당사자의 귀책사유에 따라 환불 조건이 달라질 수 있다.</p>
				<p>1.유료서비스 이용이 개시되지 않은 경우</p>
				<p>2.네트워크 또는 시스템 장애로 서비스 이용이 불가능한 경우</p>
				<p>3.유료서비스 신청 후 “회원”의 사정에 의해 서비스가 취소될 경우</p>
				<p>②"회사"가 본 약관 제19조에 따라 가입해지/서비스중지/자료삭제를 취한 경우, "회사"는 "회원"에게 이용요금을 환불하지 않으며, 별도로 "회원"에게 손해배상을 청구할 수 있다.</p>
				<p>③이용료를 환불받고자 하는 회원은 고객센터로 환불을 요청해야 한다.</p>
				<p>④"회사"는 환불 요건에 부합하는 것으로 판단될 경우, 각 서비스 환불 안내에 따라 유료이용 계약 당시 상품의 정가 기준으로 서비스 제공된 기간에 해당하는 요금을 차감한 잔액을 환불한다.</p>

			</div>
		</div>

		<div class="backBtn" onclick="popupEvnt('off')">
			<span></span>
			<span></span>
		</div>

	</div>

<script>
var form_action_url = "<?php echo $order_action_url; ?>";
function forderform_check(f, change_level=0, price= 0)
{
    
    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    var settle_method = "";
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            settle_method = settle_case[i].value;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }
    f.price.value= price;
    f.change_level.value= change_level;

/*
    if( f.action != form_action_url ){
        f.action = form_action_url;
        f.removeAttribute("target");
        f.removeAttribute("accept-charset");
    }
*/

    switch(settle_method)
    {
        case "계좌이체":
            f.gopaymethod.value = "onlydbank";
            break;
        case "가상계좌":
            f.gopaymethod.value = "onlyvbank";
            break;
        case "휴대폰":
            f.gopaymethod.value = "onlyhpp";
            break;
        case "신용카드":
            f.gopaymethod.value = "onlycard";
            break;
        case "무통장":
            f.gopaymethod.value = "무통장";
            break;
		default:
            f.gopaymethod.value = "";
            break;
    }

    // 주문정보 임시저장
    var order_data = $(f).serialize();
    var save_result = "";
    $.ajax({
        type: "POST",
        data: order_data,
        dataType: "json",
        url: "/ygt/save.data.php",
        success: function(data) {
            if(data && data.errorCode==="00000") {
                makesignature(f);
                return;
            }
            alert(data.errorMsg);
        }
    });

    return false;           

}
    

function makesignature(f){
    $.ajax({
        url: "<?=G5_SHOP_URL?>/inicis/makesignature.php",
        type: "POST",
        data: {
            price : f.price.value
        },
        dataType: "json",
        success: function(data) {
            if(data.error == "") {
                f.timestamp.value = data.timestamp;
                f.signature.value = data.sign;
                f.mKey.value = data.mKey;
                INIStdPay.pay(f.id);
            } else {
                alert(data.error);
            }
        }
    });
}
</script>


	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerComp.php');
	?>

</body>
</html>