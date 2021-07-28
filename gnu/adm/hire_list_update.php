<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_datas = array();

if ($_POST['act_button'] == "선택수정") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb_datas[] = $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {
            if($_POST['mb_certify'][$k])
                $mb_adult = (int) $_POST['mb_adult'][$k];
            else
                $mb_adult = 0;

            $sql = " update {$g5['member_table']}
                        set mb_level = '".sql_real_escape_string($_POST['mb_level'][$k])."',
                            mb_intercept_date = '".sql_real_escape_string($_POST['mb_intercept_date'][$k])."',
                            mb_mailling = '".sql_real_escape_string($_POST['mb_mailling'][$k])."',
                            mb_sms = '".sql_real_escape_string($_POST['mb_sms'][$k])."',
                            mb_open = '".sql_real_escape_string($_POST['mb_open'][$k])."',
                            mb_certify = '".sql_real_escape_string($_POST['mb_certify'][$k])."',
                            mb_adult = '{$mb_adult}'
                        where mb_id = '".sql_real_escape_string($_POST['mb_id'][$k])."' ";
            sql_query($sql);
			
			
			$sql = "update hire
					set mb_id           = '{$mb_id}',
						name 			= '{$name}',			
						email 			= '{$email}',			
						phone1 			= '{$phone1}',		
						phone2 			= '{$phone2}',		
						phone3 			= '{$phone3}',		
						last_access 	= now(),	
						age 			= '{$age}',		
						subject 		= '{$subject}',				
						place1 			= '{$wr_4}',		
						place2 			= '{$wr_6}',
						place3 			= '{$place3}',
						{$imgChange}
						career	 		= '{$career}',	
						people			= '{$people}',
						price 			= '{$price}',	
						price_chk		= '{$price_chk}',
						bonus			= '{$bonus}',
						work_s 			= '{$work_s}',	
						work_e 			= '{$work_e}',	
						employ_kinds 	= '{$employ_kindsArray}',			
						detailed	 	= '{$detailed}',	
						company_name	='{$company_name}',
						business_time	= '{$business_time}',	
						welfare 		= '{$welfare}'
						WHERE mb_id = '{$mb_id}'
						and no = '{$no}'
			";
			//echo $sql;
			sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제") {
	
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $mb_datas[] = $mb = get_member($_POST['mb_id'][$k]);
//		print $_POST['no'][$k];
//		print $mb['mb_id'];
		$sql = "delete from hire where mb_id = '".sql_real_escape_string($_POST['mb_id'][$k])."' and no = '".sql_real_escape_string($_POST['no'][$k])."' ";
		sql_query($sql);
//		print $sql;
		$msg .= $mb['mb_id'].' : 채용공고 삭제 되었습니다.\\n';
	/*
        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_id']) == 'super') {
            $msg .= $mb['mb_id'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            member_delete($mb['mb_id']);
        }
	*/
    }
}

if ($msg)
    echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

run_event('admin_member_list_update', $_POST['act_button'], $mb_datas);

goto_url('./hire_list.php?'.$qstr);


?>
