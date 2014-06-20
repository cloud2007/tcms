<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class IndexController extends CommonController {

    function _initialize() {
        parent::_initialize();
    }

    function index() {
        $model = new \Common\Model\NewsModel();
        $aboutData = $model->find(1);
        $aboutData['content'] = $this->handle($aboutData['content'],240);
        $this->assign('aboutData',$aboutData);
        
        $productData = $model->where('`lm_id`=4')->order('hits asc')->select();
        $this->assign('productData',$productData);
        
        $newsData = $model->where('`lm_id`=3')->order('created desc')->limit('6')->select();
        foreach($newsData as $key => $val){
            $newsData[$key]['title']=$this->handle($val['title'], 12);
        }
        $this->assign('newsData',$newsData);
        
        $caseData = $model->where('`lm_id`=6')->order('created desc')->limit('20')->select();
        $this->assign('caseData',$caseData);
        
        $this->display();
    }

}

?>