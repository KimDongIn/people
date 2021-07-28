		<!--개인회원정보------------------------------------->
		<section>
			<div class="sectionSell">
				<div class="boardSell">


					<!--개인회원가입=================================================-->
					<form name="indMembershep" action="/memberIndi_update.php" method="post" enctype="multipart/form-data">

						<input type="hidden" name="w" value="">
						<input type="hidden" name="url" value="%2Fgnu%2Fbbs%2Fregister_form.php">
						<input type="hidden" name="agree" value="1">
						<input type="hidden" name="agree2" value="1">
						<input type="hidden" name="cert_type" value="">
						<input type="hidden" name="cert_no" value="">
						<input type="hidden" name="mb_sex" value="">
						<input type="hidden" name="mb_id" value="<?=$mb['mb_id']?>">

						<div class="boardForm">

							<!--
								<p class="" style="float: right; margin: 10px"><strong>*</strong> 필수 입력 정보입니다.</p>
								-->

							<div class="col-all-6">
								<span>기본 정보 수정</span>
							</div>

							<div class="col-all-12">
								<input type="text" name="mb_name" value="<?=$mb['mb_name']?>" disabled>
							</div>

							<div class="col-all-12">
								<input type="text" name="mb_id" value="<?=$mb['mb_id']?>" disabled>
							</div>

							<div class="col-all-12">
								<input type="text" name="mb_email" id="reg_mb_email" placeholder="이메일" value="<?=$mb['mb_email']?>">
							</div>

							<div class="col-all-12">
								<input type="text" name="mb_hp" id="reg_mb_hp" placeholder="전화번호" value="<?=$mb['mb_hp']?>">
							</div>



							<div class="col-all-6">
								<select name="wr_4" class="y1" id="selectID" required>

									<option value="">광역시/도</option><?=$mb['mb_addr1']?>
									<?
									while ($row = sql_fetch_array($area)){?>

									<option value="<?=$row['area_number']?>" <? if($row['area_number']==$mb['mb_addr1']){ echo " selected " ; } ?>><?=$row['area']?></option>
									<?}?>
								</select>
							</div>

							<div class="col-all-6">
								<select name="wr_6" class="y2" id="selectID2" required>
									<option value="">시/구/군</option>
									<?while($place2 = sql_fetch_array($placeQuery2)){ ?>
									<option value="<?=$place2['no']?>" <? if($place2['no']==$mb['mb_addr2']){ echo " selected " ;}?>><?=$place2['area_details']?></option>
									<?
								}
	
								?>
								</select>
							</div>
							<div class="col-all-12">
								<input type="text" name="place3" id="place3" placeholder="상세주소" value="<?=$mb['mb_addr3']?>">
							</div>

							<!--탈퇴 부분   s 2021.01.19-->
							<div class="secessionBtn col-all-12">
								<a href="javascript:member_leave();" class="btn_cancel">회원탈퇴</a>
							</div>
							<!--탈퇴 부분   e 2021.01.19-->


							<input class="submitBtn" type="submit" value="수정">
						</div>
					</form>



				</div>
			</div>
		</section>
