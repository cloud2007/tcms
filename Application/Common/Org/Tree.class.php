<?php

/**
  +------------------------------------------------
 * 通用的树型类
  +------------------------------------------------
 * @author yangyunzhou@foxmail.com
  +------------------------------------------------
 * @date 2010年11月23日10:09:31
  +------------------------------------------------
 */

namespace Common\Org;

class Tree {

	private $arr = array(); //生成树型结构所需要的2维数组
	private $icon = array(' ├- ', ' ├- ', ' └- '); //│├└生成树型结构所需修饰符号，可以换成图片
	private $ret = '';

	/**
	 * 构造函数，初始化类
	 * @param array 2维数组，例如：
	 * array(
	 *      1 => array('id'=>'1','parent_id'=>0,'category_title'=>'一级栏目一'),
	 *      2 => array('id'=>'2','parent_id'=>0,'category_title'=>'一级栏目二'),
	 *      3 => array('id'=>'3','parent_id'=>1,'category_title'=>'二级栏目一'),
	 *      4 => array('id'=>'4','parent_id'=>1,'category_title'=>'二级栏目二'),
	 *      5 => array('id'=>'5','parent_id'=>2,'category_title'=>'二级栏目三'),
	 *      6 => array('id'=>'6','parent_id'=>3,'category_title'=>'三级栏目一'),
	 *      7 => array('id'=>'7','parent_id'=>3,'category_title'=>'三级栏目二')
	 *      )
	 */
	function __construct($arr = array()) {
		$this->arr = $arr;
		$this->ret = '';
		return is_array($arr);
	}

	/**
	 * 得到父级数组
	 * @param int
	 * @return array
	 */
	function get_parent($myid) {
		$newarr = array();
		if (!isset($this->arr[$myid]))
			return false;
		$pid = $this->arr[$myid]['parent_id'];
		$pid = $this->arr[$pid]['parent_id'];
		if (is_array($this->arr)) {
			foreach ($this->arr as $id => $a) {
				if ($a['parent_id'] == $pid)
					$newarr[$id] = $a;
			}
		}
		return $newarr;
	}

	/**
	 * 得到子级数组
	 * @param int
	 * @return array
	 */
	function get_child($myid) {
		$a = $newarr = array();
		if (is_array($this->arr)) {
			foreach ($this->arr as $id => $a) {
				if ($a['parent_id'] == $myid)
					$newarr[$id] = $a;
			}
		}
		return $newarr ? $newarr : false;
	}

	/**
	 * 得到当前位置数组
	 * @param int
	 * @return array
	 */
	function get_pos($myid, &$newarr) {
		$a = array();
		if (!isset($this->arr[$myid]))
			return false;
		$newarr[] = $this->arr[$myid];
		$pid = $this->arr[$myid]['parent_id'];
		if (isset($this->arr[$pid])) {
			$this->get_pos($pid, $newarr);
		}
		if (is_array($newarr)) {
			krsort($newarr);
			foreach ($newarr as $v) {
				$a[$v['id']] = $v;
			}
		}
		return $a;
	}

	/**
	 * -------------------------------------
	 *  得到树型结构
	 * -------------------------------------
	 * @author yangyunzhou@foxmail.com
	 * @param $myid 表示获得这个ID下的所有子级
	 * @param $str 生成树形结构基本代码, 例如: "<option value=\$id \$select>\$spacer\$name</option>"
	 * @param $sid 被选中的ID, 比如在做树形下拉框的时候需要用到
	 * @param $adds
	 * @param $str_group
	 */
	function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '') {
		$number = 1;
		$child = $this->get_child($myid);
		if (is_array($child)) {
			$total = count($child);
			foreach ($child as $id => $a) {
				$j = $k = '';
				if ($number == $total) {
					$j .= $this->icon[2];
				} else {
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds . $j : '';
				$selected = $id == $sid ? 'selected' : '';
				@extract($a);
				$parentid == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				$this->get_tree($id, $str, $sid, $adds . $k . '&nbsp;', $str_group);
				$number++;
			}
		}
		return $this->ret;
	}

	/**
	 * 获取所有子级
	 * @param type $myid
	 * @param type $adds
	 * @return type
	 */
	function get_array($myid = 0, $adds = '') {
		$child = $this->get_child($myid);
		if (is_array($child)) {
			$numbers = 1;
			$total = count($child);
			foreach ($child as $id => $arr) {
				$j = $k = '';
				if ($numbers == $total) {
					$j .= $this->icon[2];
				} else {
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				@extract($arr);
				$arr['spacer'] = $adds ? $adds . $j : '';
				$this->ret[$arr['id']] = $arr;
				$this->get_array($id, $adds . $k . '&nbsp;');
				$numbers++;
			}
		}
		return $this->ret;
	}

	/**
	 * 同上一方法类似,但允许多选
	 */
	function get_tree_multi($myid, $str, $sid = 0, $adds = '') {
		$number = 1;
		$child = $this->get_child($myid);
		if (is_array($child)) {
			$total = count($child);
			foreach ($child as $id => $a) {
				$j = $k = '';
				if ($number == $total) {
					$j .= $this->icon[2];
				} else {
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds . $j : '';
				$selected = $this->have($sid, $id) ? 'selected' : '';
				@extract($a);
				eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				$this->get_tree_multi($id, $str, $sid, $adds . $k . '&nbsp;');
				$number++;
			}
		}
		return $this->ret;
	}

	function have($list, $item) {
		return(strpos(',,' . $list . ',', ',' . $item . ','));
	}

	/**
	 * 格式化数组
	 */
	function getArray($myid = 0, $sid = 0, $adds = '') {
		$number = 1;
		$child = $this->get_child($myid);
		if (is_array($child)) {
			$total = count($child);
			foreach ($child as $id => $a) {
				$j = $k = '';
				if ($number == $total) {
					$j .= $this->icon[2];
				} else {
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds . $j : '';
				@extract($a);
				$selected = $this->have($sid, $id) ? 'selected' : '';
				$a['selected'] = $selected;
				$a['category_title'] = $spacer . ' ' . $a['category_title'];
				$this->ret[$a['id']] = $a;
				$fd = $adds . $k . '&nbsp;';
				$this->getArray($id, $sid, $fd);
				$number++;
			}
		}
		return $this->ret;
	}

}

?>