<section>
	<div class="sectionSell" style="">

		<div class="boardSell">
			<form name="companyForm" id="companyForm"action="/company_update.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>"/><?/*회원아이디*/?>
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>"/><?/*회원아이디*/?>
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>"/><?/*회원아이디*/?>
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>"/><?/*회원아이디*/?>
				<input type="hidden" name="mb_id" readonly value="<?echo $member['mb_id']?>"/><?/*회원아이디*/?>
				
				<span> 기업정보 </span>

				<div class="companyBoard">
					<div class="company01">
						<div>
							<input type="text" name="company_name" id="company_name" placeholder="기업이름" value="<?=$mb['company_name']?>">
						</div>
						<div>
							<input type="text" name="master_name" id="master_name" placeholder="관리자 이름" value="<?=$mb['master_name']?>">
						</div>
						<div>
							<input type="text" name="email" id="email" placeholder="이메일" value="<?=$mb['email']?>">
						</div>
						<div>
							<input type="text" name="phone1" id="phone1" placeholder="전화번호" value="<?=$mb['phone']?>">
						</div>
						
					</div>
				</div>
				
				
				<!--이미지-->
				<div class="imgBox col-all-12" align="center">
					<!--이미지 업로드 버튼-->
					<input type='file' name='upload[]' id='upload' multiple='multiple'>
					<!--input type="file" name="uploadFile" id="uploadFile" multiple-->

					<div id="preview">
						<div class="col-all-3">
							<?if(!$mb['img1']==null){?>
								<img src="/upload/company/<?=$mb['img1']?>"/>
							<?}?>
						</div>
						<div class="col-all-3">
							<?if(!$mb['img2']==null){?>
								<img src="/upload/company/<?=$mb['img2']?>"/>
							<?}?>
						</div>
						<div class="col-all-3">
							<?if(!$mb['img3']==null){?>
								<img src="/upload/company/<?=$mb['img3']?>"/>
							<?}?>
						</div>
						<div class="col-all-3">
							<?if(!$mb['img4']==null){?>
								<img src="/upload/company/<?=$mb['img4']?>"/>
							<?}?>
						</div>
						
						<!-- 기본형틀
						<div class="col-all-3">
								<span>네임</span>
								<img src="" title="">
						</div>
					-->
					</div>

				</div>

				<div>
					<button class="submitBtn" id="formAction" onClick="formAction"> 등록 </button>
				</div>
			</form>
		</div>
	</div>
</section>
