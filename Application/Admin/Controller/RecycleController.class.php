<?php

/**
 * @Description:类别管理控制器
 * @author Cloud <190296465@qq.com>
 * @since 2014-5-27 16:40:45
 * @copyright ChofnERP
 */

namespace Admin\Controller;

class RecycleController extends AdminController {

    function index() {
        $this->pagesize = C('DEFAULT_PAGE_SIZE_10');
        $this->order = 'deleted asc';
        $model = new \Common\Model\NewsModel();
        $url = 'Recycle/index';
        $pageNo = I('get.PageNo', '1', 'intval');
        $pageNum = ($pageNo - 1) * $this->pagesize;
        $limit = "{$pageNum},{$this->pagesize}";

        if (I('get.wd', '', 'trim') && $model->_selectFields)
            $this->map[$model->_selectFields] = array('LIKE', '%' . I('get.wd') . '%');
        $this->map['deleted'] = array('NEQ', 0);

        $count = $model->where($this->map)->count();

        $pager = new \Common\Org\Pager();
        $pagerData = $pager->getPagerData($count, $pageNo, $url, 2, $this->pagesize); //参数记录数 当前页数 链接地址 显示样式 每页数量

        $data = $model->where($this->map)->order($this->order)->limit($limit)->select();

        $this->assign('data', $data);
        $this->assign('pagerData', $pagerData);

        $this->display();
    }

    function remove() {
        $id = I('get.id', '', 'intval');
        !$id && $this->error('参数错误!');
        $model = new \Common\Model\NewsModel();
        $model->where('`id`=' . $id)->setField('deleted', 0);
        $this->success('操作成功!');
    }

}

?>