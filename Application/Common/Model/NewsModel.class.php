<?php

/**
 * 类别模型
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class NewsModel extends CommonModel {

	protected $_auto = array(
		array('created', 'strtotime', 3, 'function'), //对created字段在新增的时候写入当前时间戳
	);
	protected $_validate = array(
		array('lm_id', 'require', '栏目ID不能为空'),
	);
	public $_selectFields = 'title|content';

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
			$data['multipic'] = $multiStr;
		}
	}

	/**
	 * 查询数据成功后
	 * @author Cloud
	 * @since 2014-05-14
	 */
	protected function _after_select(&$resultSet, $options) {
		foreach ($resultSet as $key => $value) {
			$newArray = array();
			$data = $this->getCagegoryTitle($resultSet[$key]['category'], $newArray);
			arsort($newArray);
			$resultSet[$key]['categoryHtml'] = implode('-', $newArray);

			$menuModel = new MenuModel();
			$menuData = $menuModel->where('`lm_id`=' . $value['lm_id'])->getField('lm_id,is_tj,is_gd,is_ab,is_cd,is_ef,is_gh,is_jk,is_mn');
			$tempArray = array();
			if ($value['is_tj'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_tj'];
			if ($value['is_gd'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_gd'];
			if ($value['is_ab'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_ab'];
			if ($value['is_cd'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_cd'];
			if ($value['is_ef'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_ef'];
			if ($value['is_gh'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_gh'];
			if ($value['is_jk'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_jk'];
			if ($value['is_mn'] == 1)
				$tempArray[] = $menuData[$value['lm_id']]['is_mn'];
			$resultSet[$key]['attributeHtml'] = implode(' ', $tempArray);
			$this->_after_find($resultSet[$key], $options);
		}
	}

	protected function getCagegoryTitle($category_id, &$newArray) {
		$cateModel = new CategoryModel();
		$resData = $cateModel->find($category_id);
		$newArray[] = $resData['category_title'];
		if ($resData['parent_id'] != 0)
			$this->getCagegoryTitle($resData['parent_id'], $newArray);
	}

	protected function _after_find(&$data, $options) {
		foreach($data as $key=>$value){
			$data[$key]=htmlspecialchars_decode($value);
		}
	}

}

?>