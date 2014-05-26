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
	protected $_auto = array();
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
		$order = 'sort_no asc';
		$map = array();
		$map['id'] = array('NEQ', '1');
		$map['use'] = array('EQ', '1');
		if ($user['username'] == 'cloud') {
			$menuList = $this->where($map)->order($order)->group('lm_name')->select();
			foreach ($menuList as $k => $v) {
				$map['lm_name'] = array('EQ', $v['lm_name']);
				$menuList[$k]['son'] = $this->where($map)->order($order)->select();
			}
		} elseif (in_array(0, $user['grantArray'])) {
			$map['id'] = array('GT', 7);
			$menuList = $this->where($map)->order($order)->group('lm_name')->select();
			foreach ($menuList as $k => $v) {
				$map['lm_name'] = array('EQ', $v['lm_name']);
				$menuList[$k]['son'] = $this->where($map)->order($order)->select();
			}
		} else {
			$map['id'] = array('IN', $user['grantArray']);
			$menuList = $this->where($map)->order($order)->group('lm_name')->select();
			foreach ($menuList as $k => $v) {
				$map['lm_name'] = array('EQ', $v['lm_name']);
				$menuList[$k]['son'] = $this->where($map)->order($order)->select();
			}
		}
		return $menuList ? $menuList : null;
	}

	/**
	 * 查询一条数据成功后处理allow_field
	 * @param int $data
	 * @param type $options
	 */
	protected function _after_find(&$result, $options) {
		$result['allow_field'] = explode(',', $result['allow_field']);
	}

	/**
	 * 写入数据之前处理allow_field
	 */
	function _before_write(&$data) {
		if ($data['allow_field'])
			$data['allow_field'] = is_array($data['allow_field']) ? implode(',', $data['allow_field']) : $data['allow_field'];
	}

}

?>