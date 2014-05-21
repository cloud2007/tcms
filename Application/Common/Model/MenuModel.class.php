<?php

/**
 * 用户模型  用于被继承或写模型通用方法
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class MenuModel extends CommonModel {

	//表名
	protected $tableName = 'menu';
	// 自动完成字段
	protected $_auto = array(
		array('created', 'time', 1, 'function'),
	);
	// 自动验证
	protected $_validate = array(
			//array('lm_id', 'require', '栏目ID不能为空'),
			//array('lm_name', 'require', '栏目名不能为空'),
			//array('menu_name', 'require', '菜单名不能为空'),
			//array('action', 'require', '控制器名不能为空'),
			//array('function', 'require', '方法名不能为空'),
	);

	/**
	 * 创建菜单
	 * @param type $user
	 * @return type
	 */
	function createMenu($user) {
		$grantword = explode('|', $user['grantword']);
		$order = 'sort asc';
		$map = array();
		$map['id'] = array('not in', '1,2,4,7');
		if ($user['username'] == 'cloud') {
			$menuList = $this->where($map)->order($order)->group('lm_name')->select();
			foreach ($menuList as $k => $v) {
				$map['lm_name'] = array('eq', $v['lm_name']);
				$menuList[$k]['son'] = $this->where($map)->order($order)->select();
			}
		} elseif (in_array('ALL', $grantword)) {
			$map['grantword'] = array('not in', "{'Core','Grant'}");
			$menuList = $this->where($map)->order($order)->group('lm_name')->select();
			foreach ($menuList as $k => $v) {
				$map['lm_name'] = array('eq', $v['lm_name']);
				$menuList[$k]['son'] = $this->where($map)->order($order)->select();
			}
		} else {
			$GrantwordStr = implode(',', $grantword);
			$map['grantword'] = array('not in', $GrantwordStr);
			$menuList = $this->where($map)->order($order)->group('lm_name')->select();
			foreach ($menuList as $k => $v) {
				$map['lm_name'] = array('eq', $v['lm_name']);
				$menuList[$k]['son'] = $this->where($map)->order($order)->select();
			}
		}
		return $menuList ? $menuList : null;
	}

	/**
	 * 查询数据成功后处理allow_field
	 * @param int $data
	 * @param type $options
	 */
	protected function _after_select(&$data, $options) {
		foreach ($data as $key => $value) {
			$data[$key]['allow_field'] = 12;
		}
	}

	protected function _after_find(&$result, $options) {
		$result['allow_field'] = explode('|', $result['allow_field']);
	}

}

?>