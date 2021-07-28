<section>
	<div class="sectionSell">
		<div class="title">
			<h2>채용공고 작성</h2>
		</div>
		<!--
			<form name="entMembershep" action="/recruitmentWrite_update.php" method="post">
			-->
		<div class="boardSell">
			<!--form id="hireForm"  name="hireForm" method="post" enctype="multipart/form-data"-->
			<form id="hireForm" name="hireForm" action="recruitmentWrite_update.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>" />
				<?/*회원아이디*/?>
				<input type="hidden" name="name" readonly value="<?echo $member['mb_name']?>" />
				<?/*회원이름*/?>
				<input type="hidden" name="email" readonly value="<?echo $member['mb_email']?>" />
				<?/*회원이메일*/?>
				<input type="hidden" name="phone1" readonly value="<?echo $member['mb_hp']?>" />
				<?/*회원연락처*/?>
				<input type="hidden" name="company_name" readonly value="<?echo $member['mb_company']?>" />
				<?/*기업이름*/?>
				<input type="hidden" name="img" readonly value="<?echo $member['mb_img']?>" />
				<?/*기업 로고*/?>


				<!-- 이미지 원본 ============================================================================================= -->
				<div class="boardForm">
					<div class="imgeBox">
						<div id='View_area'></div>
						<div>
							<input type="file" name="profile" id="profile" onchange="previewImage(this,'View_area')">
						</div>
					</div>
				</div>

				<div class="boardForm">
					<span> 채용공고 </span>

					<div class="col-all-12">
						<input type="text" name="subject" id="subject" placeholder="이력서제목">
					</div>
					<!--
						<div class="col-all-12">
							<input type="text" name="company_name" id="company_name" placeholder="회사명">
						</div>
						-->
					<div class="col-all-4">
						<input type="text" name="career" id="career" placeholder="경력(년)">
					</div>

					<div class="unitName col-all-2">
						<span> 년 </span>
					</div>

					<div class="col-all-4">
						<input type="text" name="age" id="age" placeholder="희망나이">
					</div>

					<div class="unitName col-all-2">
						<span> 세 </span>
					</div>

					<div class="col-all-10">
						<input type="text" name="people" id="people" placeholder="모집인원">
					</div>

					<div class="unitName col-all-2">
						<span> 명 </span>
					</div>

					<div class="addres col-all-6">
						<select name="wr_4" class="y1" id="selectID">
							<option value="" required>광역시/도</option>
							<?
								while ($row = sql_fetch_array($area)){?>
							<option name="place1" value="<?=$row['area_number']?>"><?=$row['area']?></option>
							<?}?>
						</select>
					</div>
					<div class="col-all-6">
							<select name="wr_6" class="y2" id="selectID2" required>
								<option value="" required>시/구/군</option>
							</select>
						</div>
					<div class="col-all-12">
						<input type="text" name="place3" id="place3" placeholder="상세주소">
					</div>

					<span>모집 기간</span>
					<div class="col-all-6">
						<input type="text" id="work_s" name="work_s" placeholder="모집시작">
					</div>
					<div class="col-all-6">
						<input type="text" id="work_e" name="work_e" placeholder="마감">
					</div>



					<!--
					<div class="col-all-6">
						<input type="text" id="datepicker1" class="datepicker1" placeholder="면접일" >
					</div>
					-->
					<span>급여</span>
					<div class="col-all-3">
						<input name="price_chk" class="imgCheckbox" type="checkbox" onClick=checkDisable(this.form) id="18" value="1" style="display:none;">
						<label for="18">면접 시 협의</label>
					</div>

					<div class="col-all-9">
						<input type="text" name="price" id="price" placeholder="급여(연봉)">
					</div>

					<span>상여금</span>
					<div class="col-all-6">
						<input name="bonus" class="imgCheckbox" type="radio" id="15" value="1">
						<label for="15">예</label>
					</div>

					<div class="col-all-6">
						<input name="bonus" class="imgCheckbox" type="radio" id="16" value="2">
						<label for="16">아니오</label>
					</div>
				</div>


				<div class="boardForm">
					<span>모집 분야</span>
					<?
						$i = 1;
						while($specialty = sql_fetch_array($specialtyQuery)){
					?>
					<div class="col-all-6">
						<input name="specialty[]" class="imgCheckbox" type="checkbox" id="specialty<?=$specialty['no']?>" value="<?=$specialty['no']?>">
						<label for="specialty<?=$specialty['no']?>"><?=$specialty['specialty']?></label>
					</div>
					<?}?>
				</div>


				<div class="boardForm">
					<span>고용형태</span>
					<?
						while($employKinds = sql_fetch_array($employKindsQuery)){
					?>
					<div class="col-all-6">
						<input name="employ_kinds[]" class="imgCheckbox" type="radio" id="box<?=$employKinds['no']?>" value="<?=$employKinds['no']?>">
						<label for="box<?=$employKinds['no']?>"><?=$employKinds['employ_kinds']?></label>
					</div>
					<? } ?>
				</div>

				<div class="boardForm">
					<span>상세모집요강</span>

					<div class="col-all-12">
						<textarea name="detailed" rows="5" placeholder="상세모집요강"></textarea>
					</div>
				</div>

				<div class="boardForm">
					<span>근무시간</span>

					<div class="col-all-12">
						<textarea name="detailed" rows="5" placeholder="상세모집요강"></textarea>
					</div>
				</div>

				<div class="boardForm">
					<span>회사지원</span>
					<div class="col-all-12">
						<textarea name="welfare" rows="5" placeholder="회사지원"></textarea>
					</div>
				</div>
				<div>
					<button class="submitBtn" id="formAction" onClick="formAction"> 등록 </button>
				</div>
			</form>

		</div>
	</div>
</section>
