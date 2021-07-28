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

	<section>
        <script language="javascript" type="text/javascript" src="<?=$stdpay_js_url?>" charset="UTF-8"></script>
        
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
                        <button type="button" onclick="location.href = './stdpay/INIStdPay/INIStdPayRequest.php';">결제</button>
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
                        <button type="button" onclick="location.href = './stdpay/INIStdPay/INIStdPayRequest2.php';">결제</button>
                    </div>
                    
                    <div class="btn01">
						<button type="button" onclick="popupEvnt('on')">
							환불 규정
						</button>
					</div>

                </div>
            </div>
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

	<?
		include_once ($_SERVER["DOCUMENT_ROOT"].'/FPG/footerComp.php');
	?>

</body>
</html>