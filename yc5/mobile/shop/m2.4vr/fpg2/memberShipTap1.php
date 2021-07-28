
	<section>
		<div class="sectionSell">

			<div class="boardSell">

				<input type="radio" name="tabmenu" id="tab01">
				<label for="tab01">
					<span>개인회원</span>
				</label>

				<input type="radio" name="tabmenu" id="tab02"  checked="checked">
				<label for="tab02">
					<span>기업회원</span>
				</label>


				<!--------------------------------------------------------->

				<div class="boardWrite box2">
					<form id="fregisterform" name="fregisterform" action="/gnu/bbs/register_form_update.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<!--form  action="/gnu/bbs/register_form_update.php" method="post"-->
						
						<input type="hidden" name="w" value="">
						<input type="hidden" name="url" value="%2Fgnu%2Fbbs%2Fregister_form.php">
						<input type="hidden" name="agree" value="1">
						<input type="hidden" name="agree2" value="1">
						<input type="hidden" name="cert_type" value="">
						<input type="hidden" name="cert_no" value="">
						<input type="hidden" name="mb_sex" value="">


						<div class="boardForm">

							<!--
							<p class="" style="float: right; margin: 10px"><strong>*</strong> 필수 입력 정보입니다.</p>
							-->

							<div class="col-all-6">
								<input type="text" name="compamy_name" id="compamy_name" placeholder="회사명">
							</div>

							<div class="col-all-6">
								<input type="text" name="mb_company_name" id="mb_company_name" placeholder="대표자명">
							</div>


							<div class="col-all-12">
								<input type="text" name="mb_company_number" id="mb_company_number" placeholder="사업자등록번호">
							</div>

							<div class="col-all-12">
								<!-- 주소 링크 만들기-->
								<input type="button" onclick="sample4_execDaumPostcode()" value="주소 찾기"><br>

								<input type="text" name="address1" id="sample4_roadAddress" placeholder="도로명주소">

								<input type="text" name="address2" id="sample4_detailAddress" placeholder="상세주소">
							</div>



							<div class="">
								<input type="text" name="mb_name" id="mb_name" placeholder="가입자명">
							</div>

							<div class="">
								<input type="text" name="mb_id" id="reg_mb_id" placeholder="아이디">
							</div>
							
							<div class="">
								<input type="text" name="mb_nick" value="" id="reg_mb_nick" required="" placeholder="닉네임" >
							</div>

							<div class="">
								<input type="password" name="mb_password" id="reg_mb_password" required="" placeholder="비밀번호">
							</div>
							
							<div class="">
								<input type="password" name="mb_password_re" id="reg_mb_password_re" required="" placeholder="비밀번호확인">
							</div>

							<div class="">
								<input type="text" name="mb_email" id="reg_mb_email" placeholder="이메일">
							</div>

							<div class="">
								<input type="text" name="mb_hp" id="reg_mb_hp" placeholder="전화번호">
							</div>

							<!--이용약관-->
<div class="">
								<div class="termsBox">
									<span>이용약관1</span>
									<div>
										<p>
											이용약관을 넣어주세요
										</p>
									</div>
									<input type="checkbox" name="" value=""><p>약관동의</p>
								</div>
								

								<div class="termsBox">
									<span>이용약관2</span>
									<div>
										<p>
											이용약관을 넣어주세요
										</p>
									</div>
									
									
									<input type="checkbox" name="" value=""><p>약관동의</p>
								</div>
							</div>

							<!--추가 동의-->
							<!--
								<div>
									<div class="chk_box">
										<input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" checked="" class="selec_chk">
										<label for="reg_mb_mailling">
											<span></span>
											<b class="sound_only">메일링서비스</b>
										</label>
										<span class="chk_li">정보 메일을 받겠습니다.</span>
									</div>

									<div class="chk_box">
										<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" checked="" class="selec_chk">
										<label for="reg_mb_sms">
											<span></span>
											<b class="sound_only">SMS 수신여부</b>
										</label>
										<span class="chk_li">휴대폰 문자메세지를 받겠습니다.</span>
									</div>

									<div class="chk_box">
										<input type="checkbox" name="mb_open" value="1" id="reg_mb_open" checked="" class="selec_chk">
										<label for="reg_mb_open">
											<span></span>
											<b class="sound_only">정보공개</b>
										</label>
										<span class="chk_li">다른분들이 나의 정보를 볼 수 있도록 합니다.</span>
										<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
										<span class="tooltip">
											정보공개를 바꾸시면 앞으로 0일 이내에는 변경이 안됩니다.
										</span>
										<input type="hidden" name="mb_open_default" value="">
									</div>
								</div>
								-->


						</div>


						<div class="autoRegister">
							<fieldset id="captcha" class="">
								<legend><label for="captcha_key">자동등록방지</label></legend>
								<img src="/gnu/plugin/kcaptcha/kcaptcha_image.php?t=1584002153001" alt="" id="captcha_img">

								<div><input type="text" name="captcha_key" id="captcha_key" required="" style="width: 50%">
									<button type="button" id="captcha_mp3"><strong>숫자음성듣기</strong></button>
									<button type="button" id="captcha_reload"><strong>새로고침</strong></button>
								</div>
								<div>
									<strong>자동등록방지 숫자를 순서대로 입력하세요.</strong>
								</div>
							</fieldset>
						</div>
						<button type="submit" id="btn_submit" accesskey="s" style="width: 100%; height: 60px;"> 가입 </button>
						<!--input class="submitBtn" type="submit" value="등록"-->
					</form>
					
					
				</div>

			</div>
		</div>
	</section>