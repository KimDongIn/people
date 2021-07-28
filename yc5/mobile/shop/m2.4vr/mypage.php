
<?	
	include_once($_SERVER["DOCUMENT_ROOT"].'/gnu/common.php');
	//echo $member['mb_id'];
?>
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<title>사람과 자동차</title>
	<link rel="shortcut icon" href="./img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/basic.css">
	<link rel="stylesheet" type="text/css" href="/css/gridSection.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/widthControl.css">

	<link rel="stylesheet" type="text/css" href="/css/myPage.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/script/slidBanner.json"></script>


</head>

<body>
	<div class="selldiv">

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/header.php');
		?>



		<section>
			<div class="sectionSell" style="height: 100vh; padding: 0px;">


				<div class="myDate" style="">

					<div class="myImg" style="width: 12%;">
						<!--이미지-->
						<div id='View_area' style="">
						</div>

						<input type="button" name="" id="" onchange="">
						<label for="">
							<img id="photoUplode" src="/img/photoCamera.png">
						</label>

						<input type="button" name="" id="" onchange="">
						<label for="">
							<img id="photoCancel" src="/img/photoCancel.png">
						</label>


						<!-- 이미지 업로드 버튼
						<div style="">
							<input type="file" name="profile_pt" id="profile_pt" onchange="previewImage(this,'View_area')">
						</div>-->
					</div>



					<!--기본 정보-->
					<div class="basicInformation" style="width: 87%;">

						<div class="basicInformationTop" style="">
							<span>기본정보</span>
							<input type="button" name="" id="" onClick="location.href='#'">
							<label for="">
								<img id="cvFormalButtom" src="/img/cvFormalButtom.png">
							</label>

							<input type="button" name="" id="" onClick="location.href='#'">
							<label for="">
								<img id="cvButtom" src="/img/cvButtom.png">
							</label>
						</div>

						<div class="col">
							<div class="col-all-6">이름</div>
							<div class="col-all-6"><?echo $member['mb_name'];?></div>

							<div class="col-all-6">아이디</div>
							<div class="col-all-6"><?echo $member['mb_id'];?></div>

						</div>

						<div class="col">
							<div class="col-all-6">이메일</div>
							<div class="col-all-6"><?echo $member['mb_email'];?></div>

							<div class="col-all-6">전화번호</div>
							<div class="col-all-6"><?echo $member['mb_hp'];?></div>

							<div class="col-all-6">주소</div>
							<div class="col-all-6"><?echo $member['mb_add1'];?><?echo $member['mb_add2'];?><?echo $member['mb_add3'];?></div>
						</div>

					</div>
				</div>



				

			</div>
		</section>

		<?
			include_once ($_SERVER["DOCUMENT_ROOT"].'/_footer.php');
		?>

</body></html>
