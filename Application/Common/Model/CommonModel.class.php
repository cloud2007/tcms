<?php

/**
 * 基模型  用于被继承或写模型通用方法
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class CommonModel extends \Think\Model {

	function addSave($data = '', $options = array()) {
		$pk = $this->getPk();
		if ($this->$pk)
			parent::save($data = '', $options = array());
		else
			parent::add($data = '', $options = array());
	}

}

?>