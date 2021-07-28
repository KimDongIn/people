<!--기업회원정보 변경------------------>
<section>
	<div class="sectionSell">
		<div class="boardSell">


			<form name="indMembershep" action="/memberComp_update.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mb_id" value="<?=$mb['mb_id']?>">
				<div class="boardForm" style="">


					<div class="boardbox col-all-8">

						<div class="col-all-12">
							<input type="text" name="mb_name" value="<?=$mb['mb_name']?>" disabled>
						</div>

						<div class="col-all-12">
							<input type="text" name="mb_id" value="<?=$mb['mb_id']?>" disabled>
						</div>

						<div class="col-all-12">
							<input type="text" name="mb_company" id="mb_company" placeholder="회사명" value="<?=$mb['mb_company']?>">
						</div>

					</div>

					<!-- 이미지 추가됨 ============================================================================================= -->

					<div class="imgeBox col-all-4">
						<div id='View_area' style="background:none">
							<img id="prev_View_area" class="obj" src="/upload/comp_img/<?=$mb['mb_profile']?>" onerror="this.src='/img/icon.png'" />
						</div>
						<div>
							<input type="file" name="profile" id="profile" onchange="previewImage(this,'View_area')">
						</div>
					</div>
					<!-- 이미지 추가됨 ============================================================================================= -->





					<div class="col-all-6">
						<select name="wr_4" class="y1" id="selectID" required>

							<option value="">광역시/도</option>
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


					<div class="col-all-12">
						<input type="text" name="mb_email" id="reg_mb_email" placeholder="이메일" value="<?=$mb['mb_email']?>">
					</div>

					<div class="col-all-12">
						<input type="text" name="mb_hp" id="reg_mb_hp" placeholder="전화번호" value="<?=$mb['mb_hp']?>">
					</div>

					<!--탈퇴 부분   s 2021.01.19-->
					<div class="secessionBtn col-all-12">
						<a href="javascript:member_leave();" class="btn_cancel">회원탈퇴</a>
					</div>
					<!--탈퇴 부분   e 2021.01.19-->

				</div>

				<input class="submitBtn" type="submit" value="변경">
			</form>



		</div>
	</div>
</section>
