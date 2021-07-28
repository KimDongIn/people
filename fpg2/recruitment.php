<section>
	<div class="sectionSell">
			<div class="title">
			<h2>채용공고 수정</h2>
		</div>
		<!--
			<form name="entMembershep" action="값을 보낼 주소" method="post">
			-->
		<div class="boardSell">
			<form id="hireForm" action="/recruitment_update.php" name="hireForm" method="post" enctype="multipart/form-data">
						<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>"/><?/*회원아이디*/?>
						<input type="hidden" name="no" readonly value="<?echo $mb['no']?>"/><?/*이력서 번호*/?>
						<input type="hidden" name="name" readonly value="<?echo $member['mb_name']?>"/><?/*회원이름*/?>
						<input type="hidden" name="email" readonly value="<?echo $member['mb_email']?>"/><?/*회원이메일*/?>
						<input type="hidden" name="phone1" readonly value="<?echo $member['mb_hp']?>"/><?/*회원연락처*/?>
						<input type="hidden" name="company_name" readonly value="<?echo $member['mb_company']?>"/><?/*기업이름*/?>


				
				<div class="boardForm">
				<span> 채용공고 </span>
				 
					<div class="board01 col-all-8">
						<div class="col-all-12">
							<input type="text" name="subject" id="subject" placeholder="이력서제목"value="<?=$mb['subject']?>">
						</div>
						<!--
						<div class="col-all-12">
							<input type="text" name="company_name" id="company_name" placeholder="회사명">
						</div>
						-->
						<div class="col-all-4">
							<input type="text" name="career" id="career" placeholder="경력(년)" value="<?=$mb['career']?>">
						</div>
						
						<div class="unitName col-all-2">
							<span> 년 </span>
						</div>

						<div class="col-all-4">
							<input type="text" name="age" id="age" placeholder="희망나이"value="<?=$mb['age']?>">
						</div>
						
						<div class="unitName col-all-2">
							<span> 세 </span>
						</div>
						
						<div class="col-all-10">	
						<input type="text" name="people" id="people" placeholder="모집인원"value="<?=$mb['people']?>">
						</div>
						
						<div class="unitName col-all-2">
								<span> 명 </span>
						</div>
					</div>

					<div class="imgeBox col-all-4">
						<div class="View_area" id='View_area'>
							<img src="/upload/comp_img/<?=$mb['img']?>"/>
						</div>
						<div>
							<input type="file" name="profile" id="profile" onchange="previewImage(this,'View_area')">
						</div>
					</div>
					

					<!--div class="addres col-all-12">
						<input type="button" id="add_num" onclick="sample6_execDaumPostcode()" value="회사주소 찾기">
						<input type="text" name="address1" id="sample6_address" placeholder="주소">
						<input type="text" name="address2" id="sample6_detailAddress" placeholder="상세주소">
					</div-->
					<div class="col-all-6">
							<select name="wr_4" class="y1" id="selectID" required >
							
								<option value="">광역시/도</option>
								<?
									while ($row = sql_fetch_array($area)){?>
										
										<option value="<?=$row['area_number']?>"<? if($row['area_number'] == $mb['place1']){ echo " selected "; } ?>><?=$row['area']?></option>
								<?}?>
							</select>
						</div>

						<div class="col-all-6">
							<select name="wr_6" class="y2" id="selectID2" required >
								<option value="" >시/구/군</option>
								<?while($place2 = sql_fetch_array($placeQuery2)){ ?>
									<option value="<?=$place2['no']?>" <? if($place2['no'] == $mb['place2']){ echo " selected ";}?>><?=$place2['area_details']?></option>
								<?
								}
	
								?>
							</select>
						</div>
						<div class="col-all-12">
							<input type="text" name="place3" id="place3" placeholder="상세주소" value="<?=$mb['place3']?>">
						</div>
					
					<span>모집 기간</span>
					<div class="col-all-6">
						<input type="text" id="work_s" name="work_s" placeholder="모집시작"value="<?=$mb['work_s']?>">
					</div>
					<div class="col-all-6">
						<input type="text" id="work_e" name="work_e" placeholder="마감"value="<?=$mb['work_e']?>">
					</div>
					
					
					
					<!--
					<div class="col-all-6">
						<input type="text" id="datepicker1" class="datepicker1" placeholder="면접일" >
					</div>
					-->
					<span>급여</span>
					<div class="col-all-3">
						<input name="price_chk" class="imgCheckbox" type="checkbox" onClick=checkDisable(this.form) id="18" value="1" 
						<? if($mb['price_chk']==1){echo " checked ";}?> style="display:none;">
						
						<label for="18">면접 시 협의</label>
						
					</div>
					
					<div class="col-all-9">
						<input type="text" name="price" id="price" placeholder="급여(연봉)"value="<?=$mb['price']?>">
					</div>
					
					<span>상여금</span>
					<div class="col-all-6">
						<input name="bonus" class="imgCheckbox" type="radio" id="15" value="1"<? if($mb['bonus']==1){echo " checked ";}?>>
						<label for="15">예</label>
					</div>
					
					<div class="col-all-6">
						<input name="bonus" class="imgCheckbox" type="radio" id="16" value="2"<? if($mb['bonus']==2){echo " checked ";}?>>
						<label for="16">아니오</label>
					</div>
				</div>



				
				<div class="boardForm">
				<span>모집 분야</span>
					<?  $i = 1;
							while($specialty = sql_fetch_array($specialtyQuery)){ 
								$arraySpecialty = explode(",",$mb['specialty']);
							?>
							<div class="col-all-4">
								<input name="specialty[]" class="imgCheckbox" type="checkbox" id="specialty<?=$specialty['no']?>" 
								<? if(in_array($specialty['no'],$arraySpecialty)){echo " checked ";}?>
								value="<?=$specialty['no']?>">
								<label for="specialty<?=$specialty['no']?>"><?=$specialty['specialty']?></label>
							</div>
						<?}?>
				</div>

				
				<div class="boardForm">
				<span>고용형태</span>
					<?  while($employKinds = sql_fetch_array($employKindsQuery)){
							
							$arrayEmployKinds = explode(",",$mb['employ_kinds']);
							?>
							<div  class="col-all-3">
								<input name="employ_kinds[]" class="imgCheckbox" type="checkbox" id="box<?=$employKinds['no']?>" 
								<? if(in_array($employKinds['no'],$arrayEmployKinds)){echo " checked ";}?>
								value="<?=$employKinds['no']?>">
								<label for="box<?=$employKinds['no']?>"><?=$employKinds['employ_kinds']?></label>
							</div>
						<?}?>
					
				</div>

				<div class="boardForm">
				<span>상세모집요강</span>

					<div class="col-all-12">
						<textarea name="detailed" rows="16" placeholder="상세모집요강"><?=$mb['detailed']?></textarea>
					</div>
				</div>

				<div class="boardForm">
				<span>근무시간</span>

					<div class="col-all-12">
						<textarea name="business_time" rows="16" placeholder="근무시간"><?=$mb['business_time']?></textarea>
					</div>
				</div>

				<div class="boardForm">
				<span>회사지원</span>
					<div class="col-all-12">
						<textarea name="welfare" rows="16" placeholder="회사지원"><?=$mb['welfare']?></textarea>
					</div>
				</div>
				<div>
					<button class="submitBtn" id="formAction" onClick="formAction"> 수정 </button>
					
				</div>
			</form>
			
		</div>
	</div>
</section>