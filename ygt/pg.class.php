<?php
class PaymentLog {
    protected $table = "payment_data";
    
    public function __construct(){
        
    }
    
    public function install(){
        $sql= "
            CREATE TABLE IF NOT EXISTS `{$this->table}` (
              `pd_id` bigint(20) unsigned NOT NULL,
              `mb_id` varchar(20) NOT NULL DEFAULT '',
              `pd_pg` varchar(20) NOT NULL DEFAULT '',
              `pd_data` text NOT NULL,
              `pd_ip` varchar(20) NOT NULL DEFAULT '',
              `is_confirm` tinyint not null default 0,
              `receipt_time` datetime,
              app_no varchar(32) not null default '',
              tno varchar(32) not null default '',
              amount int(11) not null default 0,
              `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
              UNIQUE KEY `pd_id` (`pd_id`),
              KEY `mb_id` (`mb_id`))
        ";
        sql_query($sql, true);
    }
    
    public function get($oid){
        $sql = " select * from {$this->table} where pd_id = '$oid' ";
        return sql_fetch($sql);
    }
    public function delete($oid){
        $sql = " delete from {$this->table} where pd_id = '$oid' ";
        return sql_fetch($sql);
    }
    public function fetch($id, $set=[]){
        if(empty($id) || empty($set)) return null;
        $set_querys= [];
        foreach($set as $key=> $value){
            $set_querys[] = " {$key} = '{$value}' ";
        }
        $set_query= implode(",", $set_querys);
        $sql = " update {$this->table} set {$set_query} where pd_id = '$id' ";
        return sql_query($sql);
        
    }
}
