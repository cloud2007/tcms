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

namespace Org\Util;

class Tree {

    private $arr = array(); //生成树型结构所需要的2维数组
    //private $icon = array(' ├- ', ' ├- ', ' └- '); //│├└生成树型结构所需修饰符号，可以换成图片
    private $ret = '';

    /**
     * 构造函数，初始化类
     * @param array 2维数组，例如：
     * array(
     *      1 => array('id'=>'1','pid'=>0,'title'=>'一级栏目一'),
     *      2 => array('id'=>'2','pid'=>0,'title'=>'一级栏目二'),
     *      3 => array('id'=>'3','pid'=>1,'title'=>'二级栏目一'),
     *      4 => array('id'=>'4','pid'=>1,'title'=>'二级栏目二'),
     *      5 => array('id'=>'5','pid'=>2,'title'=>'二级栏目三'),
     *      6 => array('id'=>'6','pid'=>3,'title'=>'三级栏目一'),
     *      7 => array('id'=>'7','pid'=>3,'title'=>'三级栏目二')
     *      )
     */

    function __construct($arr = array()) {
        $this->arr = $arr;
        $this->arr = $this->fomatArray($this->arr);
        $this->ret = '';
        return is_array($this->$arr);
    }

    /**
     * 格式化数组(无序变有序 键名为数组中元素实际ID值)
     * @return type
     */
    private function fomatArray() {
        $arr = array();
        foreach ($this->arr as $v) {
            $arr[$v['id']] = $v;
        }
        return $arr;
    }

    /**
     * 得到父级同级数组(一级)
     * @param int
     * @return array
     */
    function getParent($myid) {
        $newarr = array();
        if (!isset($this->arr[$myid]))
            return false;
        $pid = $this->arr[$myid]['pid'];
        $pid = $this->arr[$pid]['pid'];
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['pid'] == $pid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr;
    }

    /**
     * 得到子级数组(一层)
     * @param int
     * @return array
     */
    function getChild($myid) {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['pid'] == $myid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }

    /**
     * 获取子级数组(全部)
     * @param type $myid
     * @param type $adds
     * @return type
     */
    function getChildAll($myid = 0) {
        $child = $this->getChild($myid);
        if (is_array($child)) {
            $numbers = 1;
            foreach ($child as $id => $arr) {
                @extract($arr);
                //$this->ret[$arr['id']] = $arr;
                $this->ret[] = $arr;
                $this->getChildAll($id);
                $numbers++;
            }
        }
        return $this->ret;
    }

    /**
     * 得到当前位置数组
     * @param int
     * @return array
     */
    function getPos($myid, &$newarr) {
        $a = array();
        if (!isset($this->arr[$myid]))
            return false;
        $newarr[] = $this->arr[$myid];
        $pid = $this->arr[$myid]['pid'];
        if (isset($this->arr[$pid])) {
            $this->getPos($pid, $newarr);
        }
        if (is_array($newarr)) {
            krsort($newarr);
            foreach ($newarr as $v) {
                $a[$v['id']] = $v;
            }
        }
        return $a;
    }

}

?>