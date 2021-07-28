	<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);


?>
	<section>
		<div class="sectionSell">

			<div class="payList">

				<!-- STANDARD -->
				<!-- ================================================================================= -->
				<div class="payBox">
					<form name="fitem" method="post" action="https://peoplecar.kr/yc5/shop/cartupdate3.php" onsubmit="return fitem_submit(this);">
						<input type="hidden" name="it_id[]" value="1619208477">
						<input type="hidden" name="sw_direct">
						<input type="hidden" name="url">
						<input type="hidden" name="io_type[1619208477][]" value="0">
						<input type="hidden" name="io_id[1619208477][]" value="">
						<input type="hidden" name="io_value[1619208477][]" value="STANDARD">
						<input type="hidden" class="io_price" value="0">
						<input type="hidden" class="io_stock" value="99999">
						<input type="hidden" name="ct_qty[1619208477][]" value="1" id="ct_qty_11" class="num_input" size="5">

						<span>STANDARD</span>
						<div class="payInfo">
							<p class="word1">월 25,000 만원</p>
							<p>- 채용공고</p>
							<p>- 이력서 지원 받기</p>

						</div>

						<button type="submit" class="btn01" onclick="document.pressed=this.value;" value="바로구매" class="sit_btn_buy">결제</button>
					</form>
				</div>

				<div class="payBox">

					<!-- PREMIUM -->
					<!-- ================================================================================= -->

					<form name="fitem" method="post" action="https://peoplecar.kr/yc5/shop/cartupdate3.php" onsubmit="return fitem_submit(this);">
						<input type="hidden" name="it_id[]" value="1619208591">
						<input type="hidden" name="sw_direct">
						<input type="hidden" name="url">

						<input type="hidden" name="io_type[1619208591][]" value="0">
						<input type="hidden" name="io_id[1619208591][]" value="">
						<input type="hidden" name="io_value[1619208591][]" value="PREMIUM">
						<input type="hidden" class="io_price" value="0">
						<input type="hidden" class="io_stock" value="99999">
						<input type="hidden" name="ct_qty[1619208591][]" value="1" id="ct_qty_11" class="num_input" size="5">


						<span>PREMIUM</span>
						<div class="payInfo">
							<p class="word1">월 50,000 만원</p>
							<p>- 채용공고</p>
							<p>- 이력서 지원 받기</p>
							<p>- 이력서 검색</p>
							<p>- vip 헤드헌팅</p>
						</div>

						<button type="submit" class="btn01" onclick="document.pressed=this.value;" value="바로구매" class="sit_btn_buy">결제</button>

					</form>
				</div>

				<div class="payBox" style="display:none">

					<!-- test결재 -->
					<!-- ================================================================================= -->
					<form name="fitem" method="post" action="https://peoplecar.kr/yc5/shop/cartupdate3.php" onsubmit="return fitem_submit(this);">
						<input type="hidden" name="it_id[]" value="1619209056">
						<input type="hidden" name="sw_direct">
						<input type="hidden" name="url">
						<input type="hidden" name="io_type[1619209056][]" value="0">
						<input type="hidden" name="io_id[1619209056][]" value="">
						<input type="hidden" name="io_value[1619209056][]" value="test결재">
						<input type="hidden" class="io_price" value="0">
						<input type="hidden" class="io_stock" value="99999">
						<input type="hidden" name="ct_qty[1619209056][]" value="1" id="ct_qty_0" class="num_input" size="5">
						<!-- ================================================================================= -->

						<span>test</span>
						<div class="payInfo">
							1. 가격
							<p class="word1">100원</p>
						</div>

					<button class="btn01" type="submit" onclick="document.pressed=this.value;" value="바로구매" class="sit_btn_buy">결제</button>
					</form>
				</div>

				<div class="btnBox1">
					<button class="btn01" type="button" onclick="popupEvnt('on')">
						환불 규정
					</button>
				</div>
			</div>
		</div>

	</section>
	<!-- popup window -->
	<div class="popupBox" id="popupBox">
		<div class="popupCont">
			<div class="titel">
				<h1>환불 규정</h1>
			</div>
			<div class="text">
				서비스 요금의 환불
				<p>①"회사"는 다음 각 호에 해당하는 경우 이용요금을 환불한다. 단, 각 당사자의 귀책사유에 따라 환불 조건이 달라질 수 있다.</p>
				<p>1.유료서비스 이용이 개시되지 않은 경우</p>
				<p>2.네트워크 또는 시스템 장애로 서비스 이용이 불가능한 경우</p>
				<p>3.유료서비스 신청 후 “회원”의 사정에 의해 서비스가 취소될 경우</p>
				<p>②"회사"가 본 약관 제19조에 따라 가입해지/서비스중지/자료삭제를 취한 경우, "회사"는 "회원"에게 이용요금을 환불하지 않으며, 별도로 "회원"에게 손해배상을 청구할 수 있다.</p>
				<p>③이용료를 환불받고자 하는 회원은 고객센터로 환불을 요청해야 한다.</p>
				<p>④"회사"는 환불 요건에 부합하는 것으로 판단될 경우, 각 서비스 환불 안내에 따라 유료이용 계약 당시 상품의 정가 기준으로 서비스 제공된 기간에 해당하는 요금을 차감한 잔액을 환불한다.</p>

			</div>
		</div>

		<div class="backBtn" onclick="popupEvnt('off')">
			<span></span>
			<span></span>
		</div>

	</div>
	<!--팝업창-->
	<script type="text/javascript">
		function popupEvnt(state) {

			if (state == 'on') {
				$('#popupBox').css("display", "block");
			} else {
				$('#popupBox').css("display", "none");
			}

		};

	</script>
	<script>
		// 바로구매, 장바구니 폼 전송
		function fitem_submit(f) {
//			f.action = "<?php echo $action_url; ?>";
			f.target = "";

			if (document.pressed == "장바구니") {
				f.sw_direct.value = 0;
			} else { // 바로구매
				f.sw_direct.value = 1;
			}

			// 판매가격이 0 보다 작다면
			if (document.getElementById("it_price").value < 0) {
				alert("전화로 문의해 주시면 감사하겠습니다.");
				return false;
			}

			if ($(".sit_opt_list").length < 1) {
				alert("상품의 선택옵션을 선택해 주십시오.");
				return false;
			}

			var val, io_type, result = true;
			var sum_qty = 0;
			var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
			var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
			var $el_type = $("input[name^=io_type]");

			$("input[name^=ct_qty]").each(function(index) {
				val = $(this).val();

				if (val.length < 1) {
					alert("수량을 입력해 주십시오.");
					result = false;
					return false;
				}

				if (val.replace(/[0-9]/g, "").length > 0) {
					alert("수량은 숫자로 입력해 주십시오.");
					result = false;
					return false;
				}

				if (parseInt(val.replace(/[^0-9]/g, "")) < 1) {
					alert("수량은 1이상 입력해 주십시오.");
					result = false;
					return false;
				}

				io_type = $el_type.eq(index).val();
				if (io_type == "0")
					sum_qty += parseInt(val);
			});

			if (!result) {
				return false;
			}

			if (min_qty > 0 && sum_qty < min_qty) {
				alert("선택옵션 개수 총합 " + number_format(String(min_qty)) + "개 이상 주문해 주십시오.");
				return false;
			}

			if (max_qty > 0 && sum_qty > max_qty) {
				alert("선택옵션 개수 총합 " + number_format(String(max_qty)) + "개 이하로 주문해 주십시오.");
				return false;
			}

			return true;
		}

	</script>
	<?php /* 2017 리뉴얼한 테마 적용 스크립트입니다. 기존 스크립트를 오버라이드 합니다. */ ?>
	<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>
