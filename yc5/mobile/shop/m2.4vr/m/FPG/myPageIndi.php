
<section>
	<div class="sectionSell">
		<div class="myDate">

			<div class="myImg">
				<!--이미지-->
				<!--이미지 라운드 주기-->
				<div id='View_area' class="View_area">
					<?// if(strlen($mb['img']) > 0) {?>
					<img src="/upload/profile/<?=$re_img['img']?>" onerror="this.src='/img/icon.png'"/>
					
					<?//}else{?>
					<!--등록되지 않았을때의 이미지-->
					<!--img src="/img/photo-view.png"/-->
					<?//}?>
				</div>
				<!--나의 사진 수정-->
				<!--input type="button" name="" id="btn1" onchange="">
				<label for="btn1">
					<img id="photoUplode" src="/img/photoCamera.png">
				</label>
				<!--사진 제거-->
				<!--input type="button" name="" id="btn2" onchange="">
				<label for="btn2">
					<img id="photoCancel" src="/img/photoCancel.png">
				</label-->
				
			</div>



			<!--기본 정보-->
			<div class="basicInformation">

				<div class="basicInformationTop" style="">
					<span>기본정보</span>
					<!--a 버튼으로 변경-->
					<!--하지말고 onClick="location.href='/memberIndi.php'" 이용하기-->
					
					<!--나의 회원정보 수정-->
					<input type="button" name="" id="btn01" onClick="location.href='/m/memberIndi.php?no=<?=$member['mb_no']?>'">
					<label for="btn01">
						<img id="cvFormalBtnImg" src="/img/cvFormalButtom.png">
					</label>
					
					<!--이력서 수정-->
					<input type="button" name="" id="btn02" onClick="location.href='/m/resume.php?no=<?=$member['resume_num']?>'">
					<label for="btn02">
						<img id="cvButtom" src="/img/CV.png">
					</label>
					
				</div>

				<div class="col">
					<div class="col-all-6">이름</div>
					<div class="col-all-6">
						<?echo $member['mb_name'];?>
					</div>

					<div class="col-all-6">아이디</div>
					<div class="col-all-6">
						<?echo $member['mb_id'];?>
					</div>

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

					
				</div>

			</div>
		</div>

<!--
		<span style="">추천 채용공고</span>
		<div class="bestResources">

		</div>
-->

		<span style="">나의 지원 관리</span>
		<div class="supportStatus">
			<table>
				<tr class="tableHeader">
					<td class="row1">회사명</td>
					<td class="row2">제목</td>
					<td class="row3">모집분야</td>
					<td class="row4">지역</td>
					<td class="row5">연봉</td>
					<!--td class="row6">날짜</td-->
				</tr>
				<!-- 반복문으로  리스트 출력-->
				<?
					//$i = 1;
					while($hi=sql_fetch_array($hire)){
				?>
				
				<tr class="tableList">
					<td class="row1"><a href="/m/recruitmentInfo.php?no=<?=$hi['hire_num']?>"><?=$hi['company_name']?></a></td>
					
					<td class="row2">
						
						<a href="/m/recruitmentInfo.php?no=<?=$hi['hire_num']?>"><?=$hi['subject']?></a>
						<!-- 파라미터값 넣기
						<a href="/recruitmentInfo.php?이름=값">지원현황</a>
						-->
						
					</td>
					
					<td class="row3">
					
					<?=$hi['specialty']?>
					<?
					//전문분야
					/*
					$specialtyQuery1 = sql_query("select no,specialty from specialty where no in ($hi[specialty]) order by order_num");
					//$specialtyArray1 = explode(",",$hi['specialty']);
					while($specialty1 = sql_fetch_array($specialtyQuery1)){
						
							echo $specialty1['specialty']." ";
						

					}*/
					?>
	
					</td>
					<td class="row4"><?=$hi['place1']?> <?=$hi['place2']?></td>
					<td class="row5"><? 
					if($hi['price_chk']==1){
						echo " 면접시 헙의 ";
						}else if($hi['price_chk']==0){
							echo $hi['price'];
						}?></td>
					<!--td class="row6"><?=$hi['wdate']?></td-->
				</tr>	
	
					<?}?>	
			</table>
		</div>

	</div>
</section>
