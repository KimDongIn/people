<section>
	<div class="sectionSell">


		<div class="myDate">

			<div class="myImg">
				<!--이미지-->
				<div id='View_area' class="View_area" onClick="location.href='/m/company.php'">
					<img src="/upload/comp_img/<? echo $member['img']?>" onClick="location.href='/company.php'"/>

				</div>

				<!--input type="button" id="photoUplodeBtn" onchange="">
				<label for="photoUplodeBtn">
					<img id="photoUplode" src="/img/photoCamera.png">
				</label>

				<input type="button" id="photoCancelBtn" onchange="">
				<label for="photoCancelBtn">
					<img id="photoCancel" src="/img/photoCancel.png">
				</label-->
				
			</div>



			<!--기본 정보-->
			<div class="basicInformation">

				<div class="basicInformationTop">
					<span>기본정보</span>
					<!-- 회원정보 수정 페이지 -->
					<input type="button" id="cvFormalBtn" onClick="location.href='/m/memberComp.php'">
					<label for="cvFormalBtn">
						<img id="cvFormalBtnImg" src="/img/cvFormalButtom.png">
					</label>
					 
					<!-- 채용공고 쓰기
					<input type="button" id="cvBnt" onClick="location.href='/recruitmentWrite.php'">
					<label for="cvBnt">
						<img id="cvBntImg" src="/img/cvButtom.png">
					</label>
					<!--채용공고 수정
					<input type="button" name="" id="btn02" onClick="location.href='./recruitment.php?no=<?=$member['hire_num']?>'">
					<label for="btn02">
						채용공고 수정
					</label>
					-->
					<!--기업정보관리 이미지 추가 필요!!!
					<input type="button" id="compBtn1" onClick="location.href='/company.php'"-->
					<!--
					<label for="compBtn1">
						<img id="compBtnImg" src="/img/compButtom.png">
					</label>
					-->
					<!--결제페이지 이동-->
					<!--onClick="location.href='https://peoplecar.kr/yc5/mobile/shop/item.php?it_id=1619209056'"-->
					<input type="button" id="payBtn" onClick="altBtn()">
					<label for="payBtn">
						<img id="payBtnImg" src="/img/payLinkBtn.png">
					</label>
					<script>
						function altBtn() {
							alert(" 무료 서비스 기간입니다. ");
						}
					</script> 
					
				</div>

				<div class="col">
					<div class="col-all-6">이름</div>
					<div class="col-all-6">
						<?echo $member['mb_name'];?></div>

					<div class="col-all-6">아이디</div>
					<div class="col-all-6">
						<?echo $member['mb_id'];?></div>
						
					<div class="col-all-6">회사명</div>
					<div class="col-all-6">
						<?echo $member['mb_company'];?></div>

				</div>

				<div class="col">
					<div class="col-all-6">이메일</div>
					<div class="col-all-6">
						<?echo $member['mb_email'];?>
					</div>

					<div class="col-all-6">전화번호</div>
					<div class="col-all-6">
						<?echo $member['mb_hp'];?>
					</div>

					<div class="col-all-6">회사주소</div>
					<div class="col-all-6">
					<?
						$areaQuery1 = sql_query("select area,area_number from area where area_number in ($member[mb_addr1]) order by area");
							while($area1 = sql_fetch_array($areaQuery1)){
								echo $area1['area']." ";
							}
					
						$areaQuery2 = sql_query("select area_details,no from area_detail where no in ($member[mb_addr2]) order by area_details");
							while($area2 = sql_fetch_array($areaQuery2)){
								echo $area2['area_details']."   ";
						}
					echo $member['mb_addr3'];
					?>
					</div>
				</div>

			</div>
		</div>


		<span>채용공고 관리</span>
		<div class="bestResources">
			<table>
				<tr class="tableHeader">
					
					<td class="row1">제목</td>
					<td class="row2">모집분야</td>
					<td class="row3">지역</td>
					<td class="row6">지원<br>현황</td>
					<td class="row7">수정</td>
					
				</tr>
				<!-- 반복문으로  리스트 출력-->
				<?	//if($member['mb_id'] == $hi['mb_id']){
					//$i = 1;
					//while($mb=sql_fetch_array($hi)){

					$i = 1;
					while($mb=sql_fetch_array($hire)){?>
				<tr class="tableList">
					
					<td class="row1"><?=$mb['subject']?></td>
					<td class="row2"><?=$mb['specialty']?>
						
					</td>
					<td class="row3">
					<?
						$areaQuery1 = sql_query("select area,area_number from area where area_number in ($mb[place1]) order by area");
							while($area1 = sql_fetch_array($areaQuery1)){
								echo $area1['area']." ";
					}?>
					<br>
					<?
						$areaQuery2 = sql_query("select area_details,no from area_detail where no in ($mb[place2]) order by area_details");
							while($area2 = sql_fetch_array($areaQuery2)){
								echo $area2['area_details']."   ";
						}?>
						<?//echo $mb['place3'];?>
					</td>
					<td class="row6">
						<a href="/m/myResomList.php?no=<?=$mb['no']?>">지원<br>현황</a>
						(<?=$mb['cnt']?>)
						<!--
						<a href="/myResomList.php?이름=값">지원현황</a>
						-->
					</td>
					<td class="row7">
						<!--채용정보 파라미터값 추가-->
						<a href="/m/recruitment.php?no=<?=$mb['no']?>">
							<label for="compBtn">
								<img id="compBtnImg" src="/img/cvFormalButtom.png">
							</label>
						</a>
					</td>
				
				</tr>
				<?}?>				
			</table>

		</div>

<!--
		<span> 추천 인재 </span>
		<div class="supportStatus">

			<div class="col-all-4">
				<a href="/resumeInfo.php" alt="퀵메뉴1">

					<div class="vipTitel">
						이름
					</div>
					<div class="vipImg">
						<img src="/img/icon.png" alt="">
					</div>
					<div class="vipText1">신청 분야</div>
					<div class="vipText2">신청하세요</div>

				</a>
			</div>

			<div class="col-all-4">
				<a href="/resumeInfo.php" alt="퀵메뉴1">

					<div class="vipTitel">
						이름
					</div>
					<div class="vipImg">
						<img src="/img/icon.png" alt="">
					</div>
					<div class="vipText1">신청 분야</div>
					<div class="vipText2">신청하세요</div>

				</a>
			</div>

			<div class="col-all-4">
				<a href="/resumeInfo.php" alt="퀵메뉴1">

					<div class="vipTitel">
						이름
					</div>
					<div class="vipImg">
						<img src="/img/icon.png" alt="">
					</div>
					<div class="vipText1">신청 분야</div>
					<div class="vipText2">신청하세요</div>

				</a>
			</div>
		</div>
-->

	</div>
</section>
