<?php

/**
 * 设置表模型
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class SettingModel extends CommonModel {

	protected $_validate = array(
		array('key', 'require', '标识名不能为空'),
		array('text', 'require', '配置名不能为空'),
		array('key', '', '标识名已存在', 1, 'unique', 3),
		array('text', '', '配置名已存在', 1, 'unique', 3),
	);

}

?>