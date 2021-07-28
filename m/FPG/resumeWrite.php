<section>
	<div class="sectionSell">
		<div class="title">
			<h2>이력서 작성</h2>
		</div>
		<div class="boardSell">
			<form name="indMembershep" id="resumeForm" name="resumeForm" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>" />

				<?/*<input type="hidden" name="phone2" readonly value="<?echo $member['phone2']?>"/>
				<?/*회원연락처*/?>
				<?/*<input type="hidden" name="phone3" readonly value="<?echo $member['phone3']?>"/>
				<?/*회원연락처*/?>


				<div class="boardForm">
					<div class="imgeBox ">
						<div id='View_area'></div>
						<div>
							<input type="file" name="profile_pt" id="profile_pt" onchange="previewImage(this,'View_area')">
						</div>
					</div>
				</div>

				<div class="boardForm">
					<span>이력서 제목</span>
					<div class="col-all-12">
						<input type="text" name="subject" id="subject" placeholder="제목">
					</div>

					<span>경력</span>
					<div class="col-all-6">
						<select name="career_year" id="career_year">
							<option value="0">경력(년)</option>
							<?for($i =1;$i<=50;$i++){?>
							<option value="<?=$i?>"><?=$i?></option>
							<?}?>
						</select>
					</div>


					<div class="col-all-6">
						<select name="career_month" id="career_month">
							<option value="0">경력(월)</option>
							<?for($i =1;$i<=12;$i++){?>
							<option value="<?=$i?>"><?=$i?></option>
							<?}?>
						</select>
					</div>

					<span>희망급여</span>
					<div class="col-all-10">
						<input type="text" name="price" id="" placeholder="희망급여(연봉)">
					</div>

					<div class="unitName col-all-2">
						<span> 만원 </span>
					</div>

					<div class="col-all-12">
						<input type="text" name="work_start_day" class="datepicker1" readonly placeholder="출근 가능 일자">
					</div>


					<div class="col-all-12">
						<input type="text" name="name" placeholder="이름" />
					</div>
					<div class="col-all-12">
						<input type="text" name="email" value="<?echo $member['mb_email']?>" placeholder="이메일" />
					</div>
					<div class="col-all-12">
						<input type="text" name="phone1" value="<?echo $member['mb_hp']?>" placeholder="전화번호(- 없이 숫자만 기입 )" />
					</div>


					<span> 성별 </span>
					<div class="col-all-6">
						<input class="imgCheckbox" name="sex" type="radio" value="0" id="21">
						<label class="radioBtn" for="21">남</label>
					</div>
	
					<div class="col-all-6">
						<input class="imgCheckbox" name="sex" type="radio" value="1" id="22">
						<label class="radioBtn" for="22">여</label>
					</div>

					<!--생년월일-->
					<span> 생년월일 </span>
					<div class="col-all-12">
						<input type="date" name="birth" />
					</div>

					<div class="col-all-12">
						<select name="education">
							<option value="0" required>최종학력</option>
							<option value="1">중학교졸업</option>
							<option value="2">중학교중퇴</option>
							<option value="3">고등학교졸업</option>
							<option value="4">고등학교중퇴</option>
							<option value="5">대학교졸업</option>
							<option value="6">대학원졸업</option>
						</select>
					</div>


					<!-- 이동 해야함!!
					<div class="boardForm">
						<div class="addres ">
						<input type="button" id="add_num" onclick="sample6_execDaumPostcode()" value="주소 찾기">
						<input type="text" name="address1" id="sample6_address" placeholder="주소">
						<input type="text" name="address2" id="sample6_detailAddress" placeholder="상세주소">
					</div>-->


					<span> 희망근무지역 </span>
					<div class="col-all-6">
						<select name="wr_4" class="y1" id="selectID">
							<option value="" required>광역시/도</option>
							<?
									while ($row = sql_fetch_array($area))
									{?>
							<option name="place1" value="<?=$row['area_number']?>"><?=$row['area']?></option>
							<?/*echo '<option name="place1" value="'.$row['area_number'].'">'.$row['area'].'</option>';
									'<input type="hidden" name="place1" readonly value="'.$row['area_number'].'"/>';*/?>
							<?}
									?>
						</select>
					</div>
					<div class="col-all-6">
						<select name="wr_6" class="y2" id="selectID2" required>
							<option value="" required>시/구/군</option>
						</select>
					</div>

					<div class="col-all-12" style="display:none">
						<input type="text" name="place3" id="place3" placeholder="상세주소">
					</div>

				</div>

				<div class="boardForm">
					<span> 숙식제공여부 </span>
					<div class="col-all-6">
						<input class="imgCheckbox" name="room" type="radio" id="15">
						<label for="15">희망</label>
					</div>
					<div class="col-all-6">
						<input class="imgCheckbox" name="room" type="radio" id="16">
						<label for="16">비희망</label>
					</div>
				</div>

				<div class="boardForm">
					<span>전문분야</span>

					<?  $i = 1;
						while($specialty = sql_fetch_array($specialtyQuery)){ ?>
					<div class="col-all-6">
						<input name="specialty[]" class="imgCheckbox" type="checkbox" id="specialty<?=$specialty['no']?>" value="<?=$specialty['no']?>">
						<label for="specialty<?=$specialty['no']?>"><?=$specialty['specialty']?></label>
					</div>
					<?}?>

				</div>


				<div class="boardForm">
					<span> 취업상황 </span>
					<div class="col-all-6">
						<input class="imgCheckbox" name="status" type="radio" id="13">
						<label for="13">취업준비중</label>
					</div>
					<div class="col-all-6">
						<input class="imgCheckbox" name="status" type="radio" id="14">
						<label for="14">재직중</label>
					</div>
				</div>


				<div class="boardForm">
					<span>고용형태</span>

					<?  while($employKinds = sql_fetch_array($employKindsQuery)){?>
					<div class="col-all-6">
						<input name="employ_kinds[]" class="imgCheckbox" type="radio" id="box<?=$employKinds['no']?>" value="<?=$employKinds['no']?>">
						<label for="box<?=$employKinds['no']?>"><?=$employKinds['employ_kinds']?></label>
					</div>
					<?}?>

				</div>

				<div class="boardForm">
					<span>보유자격증</span>

					<div class="">
						<!--
							<textarea name="" rows="16" placeholder="보유자격증"></textarea>
							-->
						<table id="certificateTable">
							<thead>
								<tr>
									<th>자격증명</th>
									<th>기관명</th>
									<th>자격일</th>
									<th>
										<input type="button" id="certificateAdd" value="+">
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" name="certificate[]" value="" maxlength="20" placeholder="자격증명" /></td>
									<td><input type="text" name="certificate_agency[]" value="" maxlength="30" placeholder="발급기관명" /></td>
									<td><input type="text" name="certificate_date[]" maxlength="8" placeholder="날짜형식 20200101" value="" /></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>

					<span>자기소개서</span>
					<div class="col-all-12">
						<textarea name="myself_text" rows="5" placeholder="자기소개서"></textarea>
					</div>

					<span>특기</span>
					<div class="col-all-12">
						<textarea name="hobby_text" rows="5" placeholder="특기"></textarea>
					</div>

					<span>기타사항</span>
					<div class="col-all-12">
						<textarea name="other_text" rows="5" placeholder="기타사항"></textarea>
					</div>
				</div>


				<button class="submitBtn" id="formAction" onClick="formAction"> 등록 </button>

			</form>
		</div>
	</div>
</section>
