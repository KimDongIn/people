<section>
	<div class="sectionSell">
		<div class="boardSell">

			<!-- 회사 정보는 얼마나???-->
			<span> 회사정보 </span>
			<div class="infoBox" style="">

				<!--회사로고 -->
				<div class="View_area col-all-3">
					<img src="/upload/comp_img/<?=$company['img']?>" alt="">
				</div>

				<div class="infoArea col-all-9">
					
					<div class="infoData col-all-6">
						<div>관리자</div>
						<div class="infoBoard"><?=$company['master_name']?></div>
					</div>
					
					<div class="infoData col-all-6">
						<div>사업자등록번호</div>
						<div class="infoBoard"><?echo $member['mb_company_number']?></div>
					</div>
					
					<div class="infoData col-all-6">
						<div>주소</div>
						<div class="infoBoard">
						<?
							$areaQuery1 = sql_query("select area,area_number from area where area_number in ($company[place1]) order by area");
							while($area1 = sql_fetch_array($areaQuery1)){
								echo $area1['area']." ";
							}
							$areaQuery2 = sql_query("select area_details,no from area_detail where no in ($company[place2]) order by area_details");
							while($area2 = sql_fetch_array($areaQuery2)){
								echo $area2['area_details']."   ";
							}
						?><br>
						<?echo $company['place3'];?>
						</div>
					</div>
					
					<div class="infoData col-all-6">
						<div>이메일</div>
						<div class="infoBoard"><?echo $company['mb_email']?></div>
					</div>
					
					<div class="infoData col-all-6">
						<div>전화번호</div>
						<div class="infoBoard"><?echo $company['phone']?><?//echo $company['mb_id']?></div>
					</div>

				</div>
			</div>


			<span> 채용공고 </span>
			<div class="infoBox recruiteInfoBox">
				<table>
					<tr class="tableHeader">
						<td class="row1">재목</td>
						<td class="row2">모집분야</td>
						<td class="row3">지역</td>
						<td class="row4">연봉</td>
						<td class="row5">날짜</td>
					</tr>
				
				<!-- 반복문으로  리스트 출력-->

				<?
//					$comp_id = $company['mb_id'];
					$sql = "SELECT *
							FROM hire
							WHERE mb_id = '{$comp_id}'
							";
					//hire DB
/*					$sql = "select *,a.subject,a.price,a.company_name,a.address1,a.address2,
							(select area from area where area_number = a.place1) as place1,
							(select area_details from area_detail where area_number = a.place1 and no = a.place2) as place2,a.price_chk,
							 (select group_concat(d.specialty)
								from hire_specialty e,specialty d
								where e.mb_id = a.mb_id 
								and e.specialty = d.order_num
								and e.hire_num = a.no
							) as specialty
							from hire_application b, 
							hire a ,
							resume c
							where c.no = b.resume_num
							and a.no = b.hire_num
							and c.mb_id = '$mb_id'";*/
					$hire = sql_query($sql);
					$i = 1;
					while($rec=sql_fetch_array($hire)){
				?>
					
					<tr class="tableList">
						<td class="row1"><? echo $rec['subject']?></td>
						<td class="row2"><? echo $rec['']?></td>
						<td class="row3"><? echo $rec['place1']." ".$rec['place2']?></td>
						<td class="row4"><? echo $rec['price']?></td>
						<td class="row5"><? echo $rec['wdate']?></td>
					</tr>			

				<?}?>
					<!-- 기본 틀
					<tr class="tableList">
						<td class="row1">번호</td>
						<td class="row2">제목</td>
						<td class="row3">모집분야</td>
						<td class="row4">지역</td>
						<td class="row5">연봉</td>
						<td class="row6">날짜</td>
					</tr>					
					-->
				</table>
			</div>

			<span> 회사전경 </span>
			<div class="infoBox imgList">
				<!--이미지 반복 출력-->
				<div class="col-all-3">
					<?if(!$company['img1']==null){?>
						<img src="/upload/company/<?=$company['img1']?>"/>
					<?}?>
				</div>
				<div class="col-all-3">
					<?if(!$company['img2']==null){?>
						<img src="/upload/company/<?=$company['img2']?>"/>
					<?}?>
				</div>
				<div class="col-all-3">
					<?if(!$company['img3']==null){?>
						<img src="/upload/company/<?=$company['img3']?>"/>
					<?}?>
				</div>
				<div class="col-all-3">
					<?if(!$company['img4']==null){?>
						<img src="/upload/company/<?=$company['img4']?>"/>
					<?}?>
				</div>
			</div>
		</div>
	</div>
</section>