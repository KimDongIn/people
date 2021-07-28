<section>
	<div class="sectionSell">
		<div class="title">
			<h2>이력서 수정</h2>
		</div>

		<div class="boardSell">
			<form name="indMembershep" action="/resume_update.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>" />
				<?/*회원아이디*/?>
				<input type="hidden" name="name" readonly value="<?echo $member['mb_name']?>" />
				<?/*회원이름*/?>
				<input type="hidden" name="email" readonly value="<?echo $member['mb_email']?>" />
				<?/*회원이메일*/?>
				<input type="hidden" name="phone1" readonly value="<?echo $member['mb_hp']?>" />
				<?/*회원이메일*/?>



				<span> 인적사항 </span>
				<div class="boardForm">
					<div class="imgeBox col-all-12">
						<div id='View_area' style="background:none">
							<img id="prev_View_area" class="obj" src="/upload/profile/<?=$mb['img']?>" onerror="this.src='/img/icon.png'" />
						</div>
						<div>
							<input type="file" name="profile" id="profile" onchange="previewImage(this,'View_area')">
						</div>
					</div>
				</div>

				<div class="boardForm">

					<span>이력서 제목</span>
					<div class="col-all-12">
						<input type="text" name="subject" placeholder="제목" value="<?=$mb['subject']?>">
					</div>

					<span>경력</span>
					<div class="col-all-12">
						<select name="career_year" id="career_year">
							<? for($i=1;$i<=50;$i++){?>
							<option value="<?=$i?>" <? if($i==$mb['career_year']){ echo " selected " ; } ?>><?=$i?>년</option>
							<?}?>
						</select>
					</div>
					
					<div class="col-all-6">
						<select name="career_month" id="career_month">
							<option value="0">경력(월)</option>
							<? for($i =1;$i<=12;$i++){?>
							<option value="<?=$i?>" <? if($i==$mb['career_month']){ echo " selected " ; } ?> ><?=$i?></option>
							<?}?>
						</select>
					</div>

					<span>희망급여</span>
					<div class="col-all-10">
						<input type="text" name="price" id="price" placeholder="희망급여" value="<?=$mb['price']?>">
					</div>

					<div class="unitName col-all-2">
						<span> 만원 </span>
					</div>

					<span>출근 가능 날짜</span>
					<div class="col-all-12">
						<input type="text" name="work_start_day" id="work_s" placeholder="출근 가능 날짜" value="<?=$mb['work_start_day']?>">
					</div>

				</div>

				<span> 희망근무조건 </span>
				<!-- 이동 해야함!!-->
				<div class="boardForm">

					<div class="col-all-6">
						<select name="wr_4" class="y1" id="selectID" required>

							<option value="">광역시/도</option>
							<?
										while ($row = sql_fetch_array($area)){?>

							<option value="<?=$row['area_number']?>" <? if($row['area_number']==$mb['place1']){ echo " selected " ; } ?>><?=$row['area']?></option>
							<?}?>
						</select>
					</div>
					<div class="col-all-6">
						<select name="wr_6" class="y2" id="selectID2" required>
							<option value="">시/구/군</option>
							<?while($place2 = sql_fetch_array($placeQuery2)){ ?>
							<option value="<?=$place2['no']?>" <? if($place2['no']==$mb['place2']){ echo " selected " ;}?>><?=$place2['area_details']?></option>
							<?
									}

									?>
						</select>
					</div>
					<div class="col-all-12">
						<input type="text" name="place3" id="place3" placeholder="상세주소" value="<?=$mb['place3']?>">
					</div>

				</div>

				<span> 숙식제공여부 </span>
				<div class="boardForm">
					<div class="col-all-6">
						<input class="imgCheckbox" value="1" <? if($mb['room']==1){echo " checked " ;}?> name="room" type="radio" id="15">
						<label for="15">제공</label>
					</div>

					<div class="col-all-6">
						<input class="imgCheckbox" value="0" <? if($mb['room']==0){echo " checked " ;}?> name="room" type="radio" id="16">
						<label for="16">비제공</label>
					</div>
				</div>

				<span>전문분야</span>
				<div class="boardForm">
					<?  $i = 1;
							while($specialty = sql_fetch_array($specialtyQuery)){ 
								$arraySpecialty = explode(",",$mb['specialty']);
							?>
					<div class="col-all-6">
						<input name="specialty[]" class="imgCheckbox" type="checkbox" id="specialty<?=$specialty['no']?>" <? if(in_array($specialty['no'],$arraySpecialty)){echo " checked " ;}?>
						value="<?=$specialty['no']?>">
						<label for="specialty<?=$specialty['no']?>"><?=$specialty['specialty']?></label>
					</div>
					<?}?>

				</div>


				<span> 취업상황 </span>
				<div class="boardForm">
					<div class="col-all-6">
						<input class="imgCheckbox" value="1" <? if($mb['status']==1){echo " checked " ;}?>name="status" type="radio" id="13">
						<label for="13">취업</label>
					</div>

					<div class="col-all-6">
						<input class="imgCheckbox" value="0" <? if($mb['status']==0){echo " checked " ;}?>name="status" type="radio" id="14">
						<label for="14">미취업</label>
					</div>
				</div>

				<span>고용형태</span>
				<div class="boardForm">

					<?  while($employKinds = sql_fetch_array($employKindsQuery)){
							
							$arrayEmployKinds = explode(",",$mb['employ_kinds']);
							?>
					<div class="col-all-6">
						<input name="employ_kinds[]" class="imgCheckbox" type="checkbox" id="box<?=$employKinds['no']?>" <? if(in_array($employKinds['no'],$arrayEmployKinds)){echo " checked " ;}?>
						value="<?=$employKinds['no']?>">
						<label for="box<?=$employKinds['no']?>"><?=$employKinds['employ_kinds']?></label>
					</div>
					<?}?>


				</div>

				<span>추가기입</span>
				<div class="boardForm">

					<div class="col-all-12">
						<textarea name="" rows="5" placeholder="보유자격증"></textarea>
					</div>

					<!-- 근무시간 정하기 좀더 깨끗하게-->
					<span>자기소개서</span>
					<div class="col-all-12">
						<textarea name="myself_text" rows="5" placeholder="자기소개서"><?=$mb['myself_text']?></textarea>
					</div>

					<span>특기</span>
					<div class="col-all-12">
						<textarea name="hobby_text" rows="5" placeholder="특기"><?=$mb['hobby_text']?></textarea>
					</div>

					<span>기타사항</span>
					<div class="col-all-12">
						<textarea name="other_text" rows="5" placeholder="기타사항"><?=$mb['other_text']?></textarea>
					</div>
				</div>

				<input class="submitBtn" type="submit" value="수정">

			</form>
		</div>
	</div>
</section>
