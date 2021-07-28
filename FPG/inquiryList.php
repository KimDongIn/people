<script type="text/javascript" src="/script/jquery-3.4.1.min.js"></script>
<script>
	$(document).ready(function() {
		$(".hideBoard").hide();
		$(".acBt").click(function() {
			$(this).next(".hideBoard").slideToggle(300);

			$(".acBt").not(this).next(".hideBoard").slideUp(300);
			return false;
		});
		//			$(".acBt").eq(0).trigger("click");
	});

	//display: block;

</script>
<script>
	function inquryLink() {
		//로그인 필요
		if ( <? echo $member['mb_level'] ?> == 0) {
			alert("로그인이 필요합니다.");
			location.href = "/memberShipIndi.php";
		} else {
			location.href = "/gnu/bbs/write.php?bo_table=people_QnA";
		}
	};

</script>
<section>
	<div class="sectionSell">
		<div class="QanABoard">

			<div>
				<span>자주 묻는 질문</span>
			</div>

			<div class="QanAList">
				<input type="radio" name="accordion" id="answer03">
				<label class="acBt" for="answer03">회원가입 방법<em></em></label>
				<div class="hideBoard">
					<p>회원가입 클릭</p>
					<img src="../../img/inquiryList/qna1.png" alt="">
					<p>개인 또는 기업회원 선택후 내용 기입</p>
					<img src="../../img/inquiryList/qna2.png" alt="">
					<img src="../../img/inquiryList/qna3.png" alt="">
					<p>회원가입 완료 확인</p>
					<img src="../../img/inquiryList/qna4.png" alt="">
				</div>
			
<!--
				<input type="radio" name="accordion" id="answer01">
				<label class="acBt" for="answer01">무료와 유료차이<em></em></label>
				<div class="hideBoard">
					<p>무료와 유료 차이</p>
					<p class="intext1">채용공고와 이력서 기능을 이용하려면 결제가 필요합니다.</p>
					<p class="intext1">STANDARD</p>
					<p class="intext2">- 기본적인 결제로 채용공고 등록과 이력서보기 기능을 볼 수 있습니다.</p>
					<p class="intext1">PREMIUM</p>
					<p class="intext2">- 기본적인 결제 기능과 추가적인 이력서 검색 기능과 vip이력서 보기<br>
					<span>&nbsp;</span>기능이 추가됩니다.</p>
				</div>

				<input type="radio" name="accordion" id="answer02">
				<label class="acBt" for="answer02">결제 방법<em></em></label>
				<div class="hideBoard">
					<p>로그인 후 화면 우측상단 내정보 클릭</p>
					<img src="../../img/inquiryList/qna5.png" alt="">
					<p>기본 정보창 유료서비스 클릭</p>
					<img src="../../img/inquiryList/qna6.png" alt="">
					<p>원하는 서비스 결제 클릭 및 결제</p>
					<img src="../../img/inquiryList/qna7.png" alt="">
				</div>

				
				<input type="radio" name="accordion" id="answer04">
				<label class="acBt" for="answer04">세금 계산서 및 현금 영수증 발급<em></em></label>
				<div class="hideBoard">
					<p>
						1. 계산서의 발급 신청은 결제 시 바로 신청하시고 늦어도 익일<br>
						<span>&nbsp; &nbsp;</span>영업시간전까지 발급 받으시기 바랍니다. (소급 발행 불가)
					</p>
					<p>2. 현금영수증 </p>
					<p class="intext1">
						➀ 온라인으로 무통장 결제한 이용료에 대한 현금영수증은 신청자가 <br>
						<span>&nbsp; &nbsp;</span>요청한 주민등록번호 또는 핸드폰 번호로 발급 처리됩니다.<br>
					</p>
					<p class="intext1">
						➁ 신용카드(체크카드 포함) 결제한 경우 관계 법령에 의거하여<br>
						<span>&nbsp; &nbsp;</span>계산서나 현금영수증 발급이 불가합니다.
					</p>
					<p class="intext1">
						➂ 현금영수증 신청을 하지 않은 경우 국세청에서 지정한 <br>
						<span>&nbsp; &nbsp;</span>자진발급번호로 자동 발급 처리됩니다.
					</p>
					<p class="intext1">
						➃ 온라인 무통장 결제에 대한 반환 신청을 한 경우 기 발급된 <br>
						<span>&nbsp; &nbsp;</span>현금영수증은 자동으로 취소됩니다.
					</p>
					<p class="intext1">
						➄ 현금 결제시 현금영수증이 필요하신 분은 바로 신청하셔야 합니다.<br>
						<span>&nbsp; &nbsp;</span>(소급 발행 불가)
                    </p>
				</div>
-->
			</div>
			<!--QanAList 끝!-->
			<div class="QanABtn">
				<input type="button" id="answerBtn" onclick="inquryLink()">
				<label for="answerBtn">문의하기</label>
			</div>

		</div>

	</div>
</section>
