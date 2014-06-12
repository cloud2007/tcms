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
	}

	function indexInitialize() {
		$map = array();
		$map['deleted'] = array('EQ', 0);
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

}

?>