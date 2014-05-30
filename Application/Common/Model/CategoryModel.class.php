<?php

/**
 * 类别模型
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class CategoryModel extends CommonModel {

	protected $_auto = array();
	protected $_validate = array();

	/**
	 * 写入数据之前处理allow_field
	 */
	function _before_write(&$data) {
		if ($_POST['multiUrl']) {
			$multiArray = array();
			foreach ($_POST['multiUrl'] as $k => $v) {
				$multiArray[] = $_POST['multiOrder'][$k] . '|' . $_POST['multiUrl'][$k] . '|' . $_POST['multiTitle'][$k] . '|' . $_POST['multiDefault'][$k];
			}
			$multiStr = implode("\n", $multiArray);
			$data['category_multipic'] = $multiStr;
		}
	}

}

?>