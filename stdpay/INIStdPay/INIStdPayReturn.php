<?php
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body {
			background-color: #efefef;
		}

		body,
		tr,
		td {
			font-size: 11pt;
			font-family: 굴림, verdana;
			color: #433F37;
			line-height: 19px;
		}

		table,
		img {
			border: none
		}

	</style>
<!--	<link rel="stylesheet" href="../css/group.css" type="text/css">-->
	<script type="text/javascript">
		function cancelTid() {
			var form = document.frm;

			var win = window.open('', 'OnLine', 'scrollbars=no,status=no,toolbar=no,resizable=0,location=no,menu=no,width=600,height=400');
			win.focus();
			form.action = "http://walletpaydemo.inicis.com/stdpay/cancel/INIcancel_index.jsp";
			form.method = "post";
			form.target = "OnLine";
			form.submit();

		}

	</script>
</head>
<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0>
	<!--
        <div style="padding:10px;width:100%;font-size:14px;color: #ffffff;background-color: #000000;text-align: center">
            이니시스 표준결제 인증결과 수신 / 승인요청, 승인결과 표시 샘플
        </div>
-->
	<?php
	// peopleCar 추가 
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
//	include_once('../../gnu/common.php');
	require_once('../libs/INIStdPayUtil.php');
    require_once('../libs/HttpClient.php');

        $util = new INIStdPayUtil();

        try {

            //#############################
            // 인증결과 파라미터 일괄 수신
            //#############################
            //$var = $_REQUEST["data"];

            //#####################
            // 인증이 성공일 경우만
            //#####################
            if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {

                //############################################
                // 1.전문 필드 값 설정(***가맹점 개발수정***)
                //############################################;

                $mid 			= $_REQUEST["mid"];     					// 가맹점 ID 수신 받은 데이터로 설정
                $signKey 		= "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; 		// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
                $timestamp 		= $util->getTimestamp();   					// util에 의해서 자동생성
                $charset 		= "UTF-8";        							// 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)
                $format 		= "JSON";        							// 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)

                $authToken 		= $_REQUEST["authToken"];   				// 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)
                $authUrl 		= $_REQUEST["authUrl"];    					// 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)
                $netCancel 		= $_REQUEST["netCancelUrl"];   				// 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)

                $mKey 			= hash("sha256", $signKey);					// 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
				 
				// peopleCar 추가===================================
				$mb_level    = $_REQUEST['merchantData'];    // 인증 성공시 가맹점으로 리턴변수(개발자 개인변수)
				$mb_id       = $member['mb_id'];
//				echo "<script>alert('<".$mb_level.">');</script>";
//				echo "<script>alert('<".$mb_id.">');</script>";
					//시간 체크
//				$paydate = '2021-04-01 20:00:01';		//결제날짜
//				$todate = date("Y-m-d H:i:s");			//오늘날짜
				$paydate = date("Y-m-d H:i:s");			//오늘날짜
//				echo "<script>alert('<".$paydate.">');</script>";
				// 현재날짜 - 결제날짜
//				$DateDif 	= strtotime($todate) - strtotime($paydate) ;
//				$Dday		= ceil($DateDif / (60*60 *24)) ; // 날짜차이
				// peopleCar END===================================
				
                //#####################
                // 2.signature 생성
                //#####################
                $signParam["authToken"] 	= $authToken;  	// 필수
                $signParam["timestamp"] 	= $timestamp;  	// 필수
                // signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
                $signature = $util->makeSignature($signParam);


                //#####################
                // 3.API 요청 전문 생성
                //#####################
                $authMap["mid"] 			= $mid;   		// 필수
                $authMap["authToken"] 		= $authToken; 	// 필수
                $authMap["signature"] 		= $signature; 	// 필수
                $authMap["timestamp"] 		= $timestamp; 	// 필수
                $authMap["charset"] 		= $charset;  	// default=UTF-8
                $authMap["format"] 			= $format;  	// default=XML
				

				
                try {

                    $httpUtil = new HttpClient();

                    //#####################
                    // 4.API 통신 시작
                    //#####################

                    $authResultString = "";
                    
                    if ($httpUtil->processHTTP($authUrl, $authMap)) {
                        $authResultString = $httpUtil->body;
                        //echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA
                    } else {
                        echo "Http Connect Error\n";
                        echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

                    //############################################################
                    //5.API 통신결과 처리(***가맹점 개발수정***)
                    //############################################################
                    //echo "## 승인 API 결과 ##";

                    $resultMap = json_decode($authResultString, true);
					
                    //echo "<pre>";
                    //echo "<table width='565' border='0' cellspacing='0' cellpadding='0'>";
                    
                    /*************************  결제보안 추가 2016-05-18 START ****************************/ 
                    $secureMap["mid"]		= $mid;							//mid
                    $secureMap["tstamp"]	= $timestamp;					//timestemp
                    $secureMap["MOID"]		= $resultMap["MOID"];			//MOID
                    $secureMap["TotPrice"]	= $resultMap["TotPrice"];		//TotPrice
                    
                    // signature 데이터 생성 
                    $secureSignature = $util->makeSignatureAuth($secureMap);
                    /*************************  결제보안 추가 2016-05-18 END ****************************/
					
					// 거래 성공
					if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){	//결제보안 추가 2016-05-18
					   /*****************************************************************************
				       * 여기에 가맹점 내부 DB에 결제 결과를 반영하는 관련 프로그램 코드를 구현한다.  
					   
						 [중요!] 승인내용에 이상이 없음을 확인한 뒤 가맹점 DB에 해당건이 정상처리 되었음을 반영함
								처리중 에러 발생시 망취소를 한다.
				       ******************************************************************************/
					// peopleCar 추가 =======================================================================
//						echo "<script>alert('쿼리샐행');</script>";
//						echo "<script>alert('아이디 : ".$mb_id."');</script>";
//						echo "<script>alert('레벨 : ".$mb_level."');</script>";
//						echo "<script>alert('날짜 : ".$paydate."');</script>";
//						sql_query(
//							"update g5_member
//							set mb_level = '{$mb_level}' 
//							where mb_id = '{$mb_id}'"
//						);// mb_level = 4 or 6
						
						sql_query(
							"UPDATE g5_member 
							SET mb_level = '{$mb_level}', 
							mb_1 = '{$paydate}' 
							WHERE mb_id = '{$mb_id}';"
						);
						
						
					// peopleCar 추가 끝 =======================================================================

//                        echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
//                        echo "<td class='td02'><p>성공</p></td></tr>";
					//거래 실패
					} else { 
                        echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
						echo "<tr><th class='line' colspan='2'><p></p></th></tr>
	                        <tr><th class='td01'><p>결과 코드</p></th>
	                        <td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>";
						
						//결제보안키가 다른 경우.
						if (strcmp($secureSignature, $resultMap["authSignature"]) != 0) {
							echo "<tr><th class='line' colspan='2'><p></p></th></tr>
								<tr><th class='td01'><p>결과 내용</p></th>
								<td class='td02'><p>" . "* 데이터 위변조 체크 실패" . "</p></td></tr>";

							//망취소
							if(strcmp("0000", $resultMap["resultCode"]) == 0) {
								throw new Exception("데이터 위변조 체크 실패");
							}
						} else {
							echo "<tr><th class='line' colspan='2'><p></p></th></tr>
								<tr><th class='td01'><p>결과 내용</p></th>
								<td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>";
						}
                        
                    }
					//peopleCar 내용 제거 ======
					// 넘어오는 값 확인 분류
					//======

                    // 수신결과를 파싱후 resultCode가 "0000"이면 승인성공 이외 실패
                    // 가맹점에서 스스로 파싱후 내부 DB 처리 후 화면에 결과 표시
                    // payViewType을 popup으로 해서 결제를 하셨을 경우
                    // 내부처리후 스크립트를 이용해 opener의 화면 전환처리를 하세요
                    //throw new Exception("강제 Exception");
                } catch (Exception $e) {
                    // $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    //####################################
                    // 실패시 처리(***가맹점 개발수정***)
                    //####################################
                    //---- db 저장 실패시 등 예외처리----//
                    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    echo $s;

                    //#####################
                    // 망취소 API
                    //#####################

                    $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
                    
                    if ($httpUtil->processHTTP($netCancel, $authMap)) {
                        $netcancelResultString = $httpUtil->body;
                    } else {
                        echo "Http Connect Error\n";
                        echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

					echo "<br/>## 망취소 API 결과 ##<br/>";
					
					/*##XML output##*/
					//$netcancelResultString = str_replace("<", "&lt;", $$netcancelResultString);
					//$netcancelResultString = str_replace(">", "&gt;", $$netcancelResultString);
					
                    // 취소 결과 확인
                    echo "<p>". $netcancelResultString . "</p>";
                }
            } else {

                //#############
                // 인증 실패시
                //#############
                echo "<br/>";
                echo "####인증실패####";

                echo "<pre>" . var_dump($_REQUEST) . "</pre>";
            }
        } catch (Exception $e) {
            $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
            echo $s;
        }
		
		
?>
</body>

</html>
