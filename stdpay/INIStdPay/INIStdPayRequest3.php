<?php
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
require_once( $_SERVER["DOCUMENT_ROOT"].'/stdpay/libs/INIStdPayUtil.php');
$SignatureUtil = new INIStdPayUtil();
/*
  //*** 위변조 방지체크를 signature 생성 ***

  oid, price, timestamp 3개의 키와 값을

  key=value 형식으로 하여 '&'로 연결한 하여 SHA-256 Hash로 생성 된값

  ex) oid=INIpayTest_1432813606995&price=819000&timestamp=2012-02-01 09:19:04.004


 * key기준 알파벳 정렬

 * timestamp는 반드시 signature생성에 사용한 timestamp 값을 timestamp input에 그대로 사용하여야함
 */

//############################################
// 1.전문 필드 값 설정(***가맹점 개발수정***)
//############################################
// 여기에 설정된 값은 Form 필드에 동일한 값으로 설정
// 일반결제 테스트
$mid = "INIpayTest";  // 가맹점 ID(가맹점 수정후 고정)					
//인증
$signKey = "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; // 가맹점에 제공된 웹 표준 사인키(가맹점 수정후 고정)
$timestamp = $SignatureUtil->getTimestamp();   // util에 의해서 자동생성

$orderNumber = $mid . "_" . $SignatureUtil->getTimestamp(); // 가맹점 주문번호(가맹점에서 직접 설정)
$price = "100";        // 상품가격(특수기호 제외, 가맹점에서 직접 설정)

$cardNoInterestQuota = "11-2:3:,34-5:12,14-6:12:24,12-12:36,06-9:12,01-3:4";  // 카드 무이자 여부 설정(가맹점에서 직접 설정)
$cardQuotaBase = "2:3:4:5:6:11:12:24:36";  // 가맹점에서 사용할 할부 개월수 설정
//###################################
// 2. 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
//###################################
$mKey = $SignatureUtil->makeHash($signKey, "sha256");

$params = array(
    "oid" => $orderNumber,
    "price" => $price,
    "timestamp" => $timestamp
);
$sign = $SignatureUtil->makeSignature($params, "sha256");

/* 기타 */
$siteDomain = "https://".$_SERVER['HTTP_HOST']."/stdpay/INIStdPay"; //가맹점 도메인 입력

// 페이지 URL에서 고정된 부분을 적는다. 
// Ex) returnURL이 http://localhost:8082/demo/INIpayStdSample/INIStdPayReturn.jsp 라면
//                 http://localhost:8082/demo/INIpayStdSample 까지만 기입한다.


$closeUrl		=		$siteDomain."/close.php";
$returnUrl		=		$siteDomain."/INIStdPayReturn.php";
$popupUrl		=		$siteDomain."/popup.php";

$mb_name		=		$member['mb_name'];
$mb_email		=		$member['mb_email'];
$bytertel		=		$member['mb_hp']? $member['mb_hp'] : $member['mb_tel'];

?>
<!DOCTYPE html>
<html>

<head>
	<script>
		function myFunction() {
			alert("I am an alert box!"); // this is the message in ""
		}

	</script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body {
			background-color: #efefef;
		}

		body,
		tr,
		td {
			font-size: 9pt;
			font-family: 굴림, verdana;
			color: #433F37;
			line-height: 19px;
		}

		table,
		img {
			border: none
		}
		.formBtn {
			width: 100%;
		}
		input {
			width: 100%;
		}

	</style>

	<!-- 이니시스 표준결제 js -->
	<script language="javascript" type="text/javascript" src="https://stgstdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>
	<!-- <script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script> -->

	<script type="text/javascript">
		function pay() {
			INIStdPay.pay('SendPayForm_id');
		}

	</script>

</head>
<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0>
	<div style="padding:10px;background-color:#f3f3f3;width:100%;font-size:13px;color: #ffffff;background-color: #000000;text-align: center">
		이니시스 표준결제 결제요청
	</div>
	<table width="650" border="0" cellspacing="0" cellpadding="0" style="padding:10px;" align="center">
		<tr>
			<td bgcolor="6095BC" align="center" style="padding:10px">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="padding:20px">

					<tr>
						<td>
							<table style="width: 100%;">
								<tr>
									<td style="text-align:left;">
										<form id="SendPayForm_id" name="" method="POST">

											<!-- 필수 -->
											<br /><b>***** 필 수 *****</b>
											<div style="border:2px #dddddd double;padding:10px;background-color:#f3f3f3;">

												<input type="hidden" name="version" 			value="1.0">
												<input type="hidden" name="mid" 				value="<?php echo $mid ?>">
												<input type="hidden" name="goodname" 			value="테스트">
												<input type="hidden" name="currency" 			value="WON">
												<input type="hidden" name="timestamp" value="<?php echo $timestamp ?>">
												<input type="hidden" name="signature" 			value="<?php echo $sign ?>">

												<input type="hidden" name="returnUrl" 			value="<?php echo $returnUrl ?>">
												<input type="hidden" name="mKey" 				value="<?php echo $mKey ?>">
												<input type="hidden" name="gopaymethod" 		value="">
												<input type="hidden" name="offerPeriod" 		value="2015010120150331">
												<input type="hidden" name="acceptmethod" 		value="HPP(1):no_receipt:va_receipt:below1000">
												<input type="hidden" name="languageView" 		value="">
												<input type="hidden" name="charset" 			value="">
												<input type="hidden" name="payViewType" 		value="">
												<input type="hidden" name="closeUrl" 			value="<?php echo $closeUrl ?>">
												<input type="hidden" name="popupUrl" 			value="<?php echo $popupUrl ?>">
												<input type="hidden" name="nointerest" 			value="<?php echo $cardNoInterestQuota ?>">
												<input type="hidden" name="quotabase" 			value="<?php echo $cardQuotaBase ?>">
												<input type="hidden" name="INIregno" 			value="">
												<input type="hidden" name="merchantData" 		value="6">


												<br/><b>주문번호</b> :
												<br/><input name="oid" 			value="<?php echo $orderNumber ?>" 	readonly>
												<br/><b>가격</b> :
												<br/><input name="price"	 	value="<?php echo $price ?>" 		readonly>
												<br/><b>이름</b> :
												<br/><input name="buyername"	value="<?php echo $mb_name ?>">
												<br/><b>전화번호</b> :
												<br/><input name="buyertel"		value="<?php echo $bytertel ?>">
												<br/><b>이메일</b> :
												<br/><input name="buyeremail" 	value="<?php echo $mb_email ?>">
											</div>

										</form>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<td>
							<button class="formBtn" onclick="pay()" style="padding:10px">결제요청</button>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body></html>