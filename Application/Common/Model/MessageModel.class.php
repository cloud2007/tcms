<?php

/**
 * 反馈模型
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class MessageModel extends CommonModel {

	protected $_auto = array(
		array('created', 'time', 1, 'function'), //对created字段在新增的时候写入当前时间戳
		array('created', 'strtotime', 2, 'function'), //对created字段在新增的时候写入当前时间戳
	);
	protected $_validate = array(
		array('lm_id', 'require', '栏目ID不能为空'),
	);
	public $_selectFields = 'uname|phone|tel|email|title|content|re_content';

}

?>