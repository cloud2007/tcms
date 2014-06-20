<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class NewsController extends CommonController {

    function _initialize() {
        $this->lm_id = 3;
        parent::_initialize();
    }

    function index() {
        parent::indexInitialize();
        $categoryModel = new \Common\Model\CategoryModel();
        $model = new \Common\Model\NewsModel();
        $menuData = $categoryModel->where('`lm_id`=' . $this->lm_id)->order('sort asc')->select();
        $this->assign('menuData', $menuData);
        $id = I('get.id', '', 'intval');
        if ($id)
            $menuDataInfo = $categoryModel->find($id);
        else
            $menuDataInfo = array('id' => '', 'category_title' => '所有新闻');
        $this->assign('menuDataInfo', $menuDataInfo);
        $this->assign('web_title', $menuData['category_title']);

        $pageNo = I('get.PageNo', '1', 'intval');
        $pageNum = ($pageNo - 1) * $this->pagesize;
        $limit = "{$pageNum},{$this->pagesize}";

        if (I('get.id', '', 'intval'))
            $this->map['category'] = array('EQ', I('get.id'));

        $count = $model->where($this->map)->count();

        $pager = new \Common\Org\Pager();
        $pagerData = $pager->getPagerData($count, $pageNo, $url, 2, $this->pagesize); //参数记录数 当前页数 链接地址 显示样式 每页数量

        $data = $model->where($this->map)->order($this->order)->limit($limit)->select();

        $this->assign('data', $data);
        $this->assign('pagerData', $pagerData);
        $this->display();
    }
    
    function detail(){
         $model = new \Common\Model\NewsModel();
         parent::commonDetail($model);
    }

}

?>