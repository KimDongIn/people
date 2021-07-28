<section>
	<div class="sectionSell">
		<div class="boardSell">


			<span> 인적사항 </span>
			<div class="infoBox">

				<div class="col-all-4">
					<!--이미지-->
					<? if(strlen($mb['img']) > 0) {?>
					<img src="/upload/profile/<?=$mb['img']?>"/>
					<?}else{?>
					<!-- 공백 이미지-->
					<img id="View_area" src="img/photo-view.png" alt="">
					<?}?>
				</div>

				<div class="infoArea col-all-8">
					
						<div class="infoData col-all-6">
							<div>이름</div>
							<div class="infoBoard"><?=$mb['name']?></div>
						</div>
						
						<div class="infoData col-all-6">
							<div>연락처</div>
							<div class="infoBoard"><?=$mb['phone1']?></div>
						</div>

						<div class="infoData col-all-6">
							<div>주소</div>
							<div class="infoBoard">
							<?
								$areaQuery1 = sql_query("select area,area_number from area where area_number in ($mb[place1]) order by area");
								while($area1 = sql_fetch_array($areaQuery1)){
										echo $area1['area']." ";
								}?>
								<?
								$areaQuery2 = sql_query("select area_details,no from area_detail where no in ($mb[place2]) order by area_details");
								while($area2 = sql_fetch_array($areaQuery2)){

										echo $area2['area_details']."   ";
							}?>
<!--									<br><?=$mb['place3']?>-->
							</div>
						</div>

						<div class="infoData col-all-6">
							<div>이메일</div>
							<div class="infoBoard"><?=$mb['email']?></div>
						</div>
						
						<div class="infoData col-all-6">
							<div>성별</div>
							<div class="infoBoard"><?=$sex?></div>
						</div>
						
						<div class="infoData col-all-6">
							<div>생년월일</div>
							<div class="infoBoard"><?=$mb['mb_birth']?></div>
						</div>
						
						<div class="infoData col-all-6">
							<div>최종학력</div>
							<div class="infoBoard"><?=$mb['education']?></div>
						</div>
					
				</div>

			</div>


			<span> 희망근무조건 </span>
			<div class="infoBox hopeWork">

					<div class="infoData col-all-6">
						<div>희망직종</div>
						<div class="infoBoard"><?=$specialty?></div>
						
					</div>

					<div class="infoData col-all-6">
						<div>희망지역</div>
						<div class="infoBoard">
						<?
						$areaQuery1 = sql_query("select area,area_number from area where area_number in ($mb[place1]) order by area");
						while($area1 = sql_fetch_array($areaQuery1)){
							echo $area1['area']." ";
						}?>
						<?
						$areaQuery2 = sql_query("select area_details,no from area_detail where no in ($mb[place2]) order by area_details");
						while($area2 = sql_fetch_array($areaQuery2)){
							echo $area2['area_details']."   ";
						}?>
						</div>
					</div>

					<div class="infoData col-all-6">
						<div>희망연봉</div>
						<div class="infoBoard"><?=$mb['price']?>만원</div>
					</div>
					
					<!-- 숙식 희망 추가됨~!!-->
					<div class="infoData col-all-6">
						<div>숙식희망</div>
						<div class="infoBoard"><?=$mb['room']?></div>
					</div>

					<div class="infoData col-all-6">
						<div>고용형태</div>
						<div class="infoBoard">
						
							<? $employKindsQuery1 = sql_query("select no,employ_kinds from employ_kinds where no in ($mb[employ_kinds]) order by order_num");
							while($employ_kinds1 = sql_fetch_array($employKindsQuery1)){
							
								echo $employ_kinds1['employ_kinds']."  ";
							
							}?>
						</div>
						
					</div>
					
					<div class="infoData col-all-6">
						<div>거주지</div>
						<div class="infoBoard">
						<?
							$areaQuery1 = sql_query("select area,area_number from area where area_number in ($mb[mb_addr1]) order by area");
							while($area1 = sql_fetch_array($areaQuery1)){
									echo $area1['area']." ";
							}?>
							<?
							$areaQuery2 = sql_query("select area_details,no from area_detail where no in ($mb[mb_addr2]) order by area_details");
							while($area2 = sql_fetch_array($areaQuery2)){
									echo $area2['area_details']."   ";
							}
							
						?><?=$member['mb_addr3']?>
						</div>
					</div>

					<div class="infoData col-all-6">
						<div>출근가능일</div>
						<div class="infoBoard"><?=$mb['work_start_day']?></div>
					</div>

				
			</div>


			<span> 추가사항 </span>
			<div class="infoBox">
				<div class="infoData col-all-4">
					<div>취업상황</div>
					<div class="infoBoard"><?=$mb['status']?></div>
				</div>
				<div class="infoData col-all-4">
					<div>경력</div>
					<div class="infoBoard"><?=$mb['career_year']?>년 <?=$mb['career_month']?>개월</div>
				</div>
				<div class="infoData col-all-4">
					<div>보유자격증</div>
					<div class="infoBoard">
					<?while($certificate = sql_fetch_array($certificateQuery)){?>
					<?=$certificate['certificate']?><?=$certificate['certificate_agency']?><br/>
					<?}?>
					</div>
				</div>
			</div>





			<span> 자기소개서 </span>
			<div class="infoBox">
				<p>
					<?=$mb['myself_text']?>
				</p>
			</div>

			<span> 특기 </span>
			<div class="infoBox">
				<p>
					<?=$mb['hobby_text']?>
				</p>
			</div>

			<span> 기타사항 </span>
			<div class="infoBox">
				<p>
					<?=$mb['other_text']?>
				</p>
			</div>
		</div>
	</div>
</section>
