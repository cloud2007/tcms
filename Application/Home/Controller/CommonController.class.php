<?php

/**
 * 通用控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class CommonController extends \Think\Controller {

	protected $menu_id;
	protected $lm_id;
	protected $map;
	protected $order;
	protected $pagesize;
	protected $url;

	function _initialize() {
		$settingModel = new \Common\Model\SettingModel();
		$settingData = $settingModel->select();
		$_data = array();
		foreach ($settingData as $value) {
			$_data[$value['key']] = $value['value'];
		}
		$settingData = $_data;
		unset($_data);
		$this->assign('settingData', $settingData);
		if ($this->lm_id) {
			$menuModel = new \Common\Model\MenuModel();
			$seoData = $menuModel->where('`lm_id`=' . $this->lm_id)->getField('lm_id,seo_title,seo_keywords,seo_description');
			$this->assign('seoData', $seoData[$this->lm_id]);
		}

		$model = new \Common\Model\NewsModel();
		$cateModel = new \Common\Model\CategoryModel();

		$aboutMenuData = $model->where('`lm_id`=2 and `deleted`=0')->order('sort asc')->select();
		$this->assign('aboutMenuData', $aboutMenuData);
		$this->assign('aboutMenuDataCount', count($aboutMenuData) - 1);

		$newsMenuData = $cateModel->where('`lm_id`=3 and `deleted`=0')->order('sort asc')->select();
		$this->assign('newsMenuData', $newsMenuData);
		$this->assign('newsMenuDataCount', count($newsMenuData) - 1);
	}

	function indexInitialize() {
		$map = array();
		$map['deleted'] = array('EQ', 0);
		$map['lm_id'] = array('EQ', $this->lm_id);
		$this->map = $map;
		$this->order = 'created desc';
		$this->pagesize = C('DEFAULT_PAGE_SIZE_10');
		$this->url = U(CONTROLLER_NAME . '/index');
	}

	function commonIndex($model = '') {
		empty($model) && $this->error('模型不能为空');
		$url = $this->url ? $this->url : U(CONTROLLER_NAME . '/index');
		$pageNo = I('get.PageNo', '1', 'intval');
		$pageNum = ($pageNo - 1) * $this->pagesize;
		$limit = "{$pageNum},{$this->pagesize}";

		$count = $model->where($this->map)->count();

		$pager = new \Common\Org\Pager();
		$pagerData = $pager->getPagerData($count, $pageNo, $url, 2, $this->pagesize); //参数记录数 当前页数 链接地址 显示样式 每页数量

		$data = $model->where($this->map)->order($this->order)->limit($limit)->select();

		$this->assign('data', $data);
		$this->assign('pagerData', $pagerData);

		$this->display();
	}

	function commonDetail($model = '') {
		empty($model) && $this->error('模型不能为空');
		$id = I('get.id', '', 'intval');
		!$id && $this->error('参数错误!');
		$data = $model->find($id);
		$this->assign('data', $data);
		$this->display();
	}

	//处理HTML标签,并转换成HTML实体,并截取指定长度
	function handle($str, $length) {
		return $length ? \Common\Org\Util::csubstr(strip_tags(htmlspecialchars_decode($str)), 0, $length) : htmlspecialchars_decode($str);
	}

}

?>