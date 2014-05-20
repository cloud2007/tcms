<?php

/**
 * 用户模型  用于被继承或写模型通用方法
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class MenuModel extends CommonModel {

	// 自动完成字段
	protected $_auto = array(
		array('created','time',1,'function'),
	);
	// 自动验证
	protected $_validate = array(
		array('lm_name','require','lm_id不能为空'),
	);

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

}

?>