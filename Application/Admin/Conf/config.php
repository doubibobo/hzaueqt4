<?php
return array(
	//ÐÞ¸Ä×ó¶¨½ç·û
	'TMPL_L_DELIM' => '<{',
	//ÐÞ¸ÄÓÒ¶¨½ç·û
	'TMPL_R_DELIM' => '}>',
	'DB_TYPE' => 'mysql',//ÉèÖÃÊý¾Ý¿âÀàÐÍ
	'DB_HOST' => '127.0.0.1',//ÉèÖÃÖ÷»úÃû
	'DB_NAME' => 'zkydatabase',//ÉèÖÃÊý¾Ý¿âÃû
	'DB_USER' => 'doubibobo',//ÉèÖÃÓÃ»§Ãû
	'DB_PWD' => '12151618',//ÉèÖÃÃÜÂë
	'DB_PORT' =>'3306', //ÉèÖÃ¶Ë¿ÚºÅ
	'DB_PREFIX' => 'tp_',//ÉèÖÃ±íÇ°×º*/
	//'DB_DSN' => 'mysql://root:@localhost:3306/zky',//Èç¹ûÁ½ÖÖ·½Ê½Í¬Ê±´æÔÚ£¬ÔòÒÔDSNÎªÓÅÏÈ
	'SHOW_PAGE_TRACE' => true,

    // 第一个数据库的配置
    'DB_CONFIG1'=>array(
        'DB_TYPE'=>'mysql',
        'DB_HOST'=>'127.0.0.1',
        'DB_USER'=>'root',
        'DB_PWD'=>'12151618',
        'DB_PORT' =>'3306',
        'DB_NAME' => 'zkyuser',
        'DB_PREFIX' => 'tp_',
        'SHOW_PAGE_TRACE' => true,
    ),

);
?>