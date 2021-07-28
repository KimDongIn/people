
<section>
	<div class="sectionSell">
		<div class="boardSell">

			<!-- 회사 정보는 얼마나???-->
			<span> 회사정보 </span>
			<div class="infoBox">
				
				<!--기업 링크 걸어야 합니다!!!---------------------------------------------->
				<div class="col-all-4 recoLogo">
				<a href="/companyInfo.php?mb_id=<?=$hi['mb_id']?>" alt="기업보기" >
					<!--이미지-->
					<? if(strlen($hi['img']) > 0) {?>
					<img src="/upload/comp_img/<?=$hi['img']?>" onerror="/img/icon.png" />
					<?}else{?>
					<!-- 공백 이미지-->
					<img id="View_area" src="" alt="">
					<?}?>
				</a>
				</div>


				<div class="infoArea col-all-8">

					<div class="infoData col-all-6">
						<div>회사명</div><?$member['company_num']?>
						<div class="infoBoard"><?=$hi['company_name']?></div>
					</div>
					
					<div class="infoData col-all-6">
						<div>연락처</div>
						<div class="infoBoard"><?=$hi['mb_hp']?></div>
					</div>
					
					<div class="infoData col-all-6">
						<div>주소</div>
						<div class="infoBoard"><?=$hi['place1']?><?=$hi['place2']?><?=$hi['place3']?></div>
					</div>
					
					<div class="infoData col-all-6">
						<div>이메일</div>
						<div class="infoBoard"><?=$hi['email']?></div>
					</div>

				</div>
			</div>


			<span> 자격조건 </span>
			<div class="infoBox">
				<div class="infoData col-all-6">
					<div>경력</div>
					<div class="infoBoard"><?=$hi['career']?></div>
				</div>
				<div class="infoData col-all-6">
					<div>희망나이</div>
					<div class="infoBoard"><?=$hi['age']?></div>
				</div>
			</div>

			<span> 모집요강 </span>
			<div class="infoBox">
					<div class="infoData col-all-6">
						<div>모집인원</div>
						<div class="infoBoard"><?=$hi['people']?></div>
					</div>

					<div class="infoData col-all-6">
						<div>급여</div>
						<div class="infoBoard">
						<?
							if($hi['price_chk']==1){
								echo "면접 시 협의";
							}else if($hi['price_chk']==0){
								echo $hi['price'];
							}
						?>
						</div>
					</div>

					<div class="infoData col-all-6">
						<div>상여급</div>
						<div class="infoBoard"><?=$hi['bonus']?></div>
					</div>

					<div class="infoData col-all-6">
						<div>출근 희망 일</div>
						<div class="infoBoard"><?=$hi['workStart']?></div>
					</div>

					<div class="infoData col-all-6">
						<div>직종</div>
						<div class="infoBoard"><?=$hi['specialty']?></div>
					</div>
					

					<div class="infoData col-all-6">
						<div>고용형태</div>
						<div class="infoBoard">
						<?$specialtyQuery1 = sql_query("select no,employ_kinds from employ_kinds where no in ($hi[employ_kinds]) order by order_num");?>
						<?while($employKinds= sql_fetch_array($specialtyQuery1)){?>
								<?echo $employKinds['employ_kinds'];?>
						<?}?>
						
						</div>
					</div>
			</div>


			<span> 상세모집 요강 </span>
			<div class="infoBox">
				<div>
					<p><?=$hi['detailed']?></p>
				</div>
			</div>

			<span> 근무시간 </span>
			<div class="infoBox">
				<div>
					<p><?=$hi['business_time']?></p>
				</div>
			</div>

			<span> 회사복지 </span>
			<div class="infoBox">
				<div>
					<p><?=$hi['welfare']?></p>
				</div>
			</div>
			
			<!--div class="infoBox">
				<input type="button" src="" value="이력서 제출"> 
			</div-->
			<form name="indMembershep" action="/hire_application.php" method="post" >
				<input type="hidden" name="mb_id" value="<?=$hi['mb_id']?>"/>
				<input type="hidden" name="hire_num" value="<?=$hi['no']?>"/>
				<input type="hidden" name="resume_num" readonly value="<? echo $member['resume_num']?>"/>
				<input type="hidden" name="resume_id" readonly value="<? echo $member['mb_id']?>"/>
				<td class="sec4">
					<!--이력서 보내기 -->
					<input class="submitBtn" type="submit" value="이력서 제출<?//=$hi['mb_id']?><?//=$hi['no']?>" style="width:100%;height:50px">
					<!--input type="button" id="btn1" onclick=""-->
					<label for="btn1">

					</label>
				</td>
			</form>

		</div>
	</div>
</section>
