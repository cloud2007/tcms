<?php

/**
 * 分页类
 * @author:Laven<190296465@vip.qq.com>
 * @copyright:Copyright 2009 Laven
 * @create:2010-11-13
 * @modify:2014-01-03
 */

namespace Common\Org;

class Pager {

	private $Total;
	private $PageSize;
	private $First;
	private $Last;
	private $Current;
	private $Prev;
	private $Next;
	private $PageCount;
	private $Offset;
	private $Url;
	private $Links;
	private $LinksHtml;
	private $PagerData;

	public function getPagerData($TotalItems, $current, $url = '?', $resultType = 1, $PageSizeNum = 10) {
		$this->PagerData = array('offset' => 0, 'pagesize' => $PageSizeNum, 'current' => $current);
		$this->LinksHtml = '';
		$this->Links = array();
		$this->Total = $TotalItems;
		$this->PageSize = $PageSizeNum;
		//$this->Url = $url.'?';
		$this->Url = Util::htmlquery();
		$this->Current = $current;

		$this->PageCount = ceil($this->Total / $this->PageSize);
		if ($this->Current > $this->PageCount) {
			$this->Current = $this->PageCount;
		}
		if ($this->Current <= 0) {
			$this->Current = 1;
		}
		$this->Offset = ($this->Current - 1) * $this->PageSize;
		$this->Prev = $this->Current - 1;
		$this->Next = $this->Current + 1;
		$this->First = 1;
		$this->Last = $this->PageCount;

		$this->PagerData['offset'] = $this->Offset;
		$this->PagerData['total'] = $this->PageCount;


		if ($resultType == 1) {
			$this->createHtml();
		}

		if ($resultType == 2) {
			$this->createNumHtml();
		}
		if ($resultType == 3) {
			$this->createHtml_ajax();
		}

		return $this->PagerData;
	}

	//create html
	public function createHtml() {
		if ($this->Prev > 1) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->First . '">首页</a> ';
		} else {
			$this->LinksHtml.='<a href="javascript:;">首页</a> ';
		}
		if ($this->Prev > 0) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->Prev . '">上一页</a> ';
		} else {
			$this->LinksHtml.='<a href="javascript:;">上一页</a> ';
		}
		if ($this->Next <= $this->PageCount) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->Next . '">下一页</a> ';
		} else {
			$this->LinksHtml.='<a href="javascript:;">下一页</a> ';
		}
		if ($this->Next < $this->PageCount) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->Last . '">尾页</a> ';
		} else {
			$this->LinksHtml.='<a href="javascript:;">尾页</a> ';
		}
		if ($this->PageCount > 1) {
			$this->LinksHtml.='第' . $this->Current . '页/共' . $this->PageCount . '页';
		}
		$this->PagerData['linkhtml'] = $this->LinksHtml;
	}

	// ajax
	public function createHtml_ajax() {
		if ($this->Prev > 0) {
			$this->LinksHtml.='<a href="javascript:void(0);" onclick="house(' . $this->First . ')">首页</a> ';
		}
		if ($this->Prev > 0) {
			$this->LinksHtml.='<a href="javascript:void(0);" onclick="house(' . $this->Prev . ')">上一页</a> ';
		}
		if ($this->Next <= $this->PageCount) {
			$this->LinksHtml.='<a href="javascript:void(0);" onclick="house(' . $this->Next . ')">下一页</a> ';
		}
		if ($this->Next <= $this->PageCount) {
			$this->LinksHtml.='<a href="javascript:void(0);" onclick="house(' . $this->Last . ')">尾页</a> ';
		}
		if ($this->PageCount > 1) {
			$this->LinksHtml.='第' . $this->Current . '页/共' . $this->PageCount . '页';
		}
		$this->PagerData['linkhtml'] = $this->LinksHtml;
	}

	//create number html
	public function createNumHtml() {

		if ($this->Prev > 0) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->First . '">首页</a><a href="' . $this->Url . 'PageNo=' . $this->Prev . '">上一页</a>';
		} else {
			$this->LinksHtml.='<a href="javascript:;">首页</a><a href="javascript:;">上一页</a>';
		}

		if ($this->PageCount > 10) {
			if ($this->Current > 5) {
				if ($this->Current + 4 >= $this->PageCount) {
					$start = $this->PageCount - 9;
				} else {
					$start = $this->Current - 5;
				}
			} else {
				$start = 1;
			}
			if ($this->Current + 3 < $this->PageCount) {
				$end = $this->Current + 4;
				if ($end < 10) {
					$end = 10;
				}
			} else {
				$end = $this->PageCount;
			}
		} else {
			$start = 1;
			$end = $this->PageCount;
		}
		for ($i = $start; $i <= $end; $i++) {
			if ($i == $this->Current) {
				$this->LinksHtml.='<a class="current" href="javascript:;">' . $i . '</a>';
			} else {
				$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $i . '">' . $i . '</a>';
			}
		}

		if ($this->Next <= $this->PageCount) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->Next . '">下一页</a>';
		} else {
			$this->LinksHtml.='<a href="javascript:;">下一页</a>';
		}

		if ($this->Next <= $this->PageCount) {
			$this->LinksHtml.='<a href="' . $this->Url . 'PageNo=' . $this->Last . '">尾页</a>';
		} else {
			$this->LinksHtml.='<a href="javascript:;">尾页</a>';
		}

		//if ($this->PageCount > 1) {
		$this->LinksHtml.='&nbsp;第' . $this->Current . '页/共' . $this->PageCount . '页';
		//}
		$this->PagerData['linkhtml'] = $this->LinksHtml;
	}

}

//检测是否传入当前页数----------------------
if (isset($_GET['PageNo']) && is_numeric($_GET['PageNo'])) {
	$currentpage = $_GET['PageNo'];
} else {
	$currentpage = 1;
}



//--------------------------------实例化-------------------------------
//$pager=new Pager();
//$pagerData=$pager->getPagerData(20,$currentpage,'?',4,'5');//参数总页数 当前页数 链接地址 显示样式 每页数量
//echo '<div class="pager" >'.$pagerData['linkhtml'].'</div>';


/*
  echo '<div class="pager" >'.$pagerData['linkhtml'].'</div>';


  //get page list by type=1
  $pagerData=$pager->getPagerData(160,$currentpage,'?',1);
  echo '<div class="pager" >'.$pagerData['linkhtml'].'</div>';


  //get page list by type=2
  $pagerData=$pager->getPagerData(160,$currentpage,'?',2);
  echo '<div class="pager">';
  foreach($pagerData['links'] as $key=>$value){
  echo '<a href="'.$value.'">'.$key.'</a>';
  }
  echo $pagerData['current'].'/'.$pagerData['total'];
  echo '</div>';


  //get page list by type=3
  $pagerData=$pager->getPagerData(160,$currentpage,'?',3);
  echo '<div class="pager">';
  foreach($pagerData['links'] as $key=>$value){
  if($currentpage==$key){
  echo '<a href="'.$value.'" class="current" >'.$key.'</a>';
  }else{
  echo '<a href="'.$value.'">'.$key.'</a>';
  }
  }
  echo $pagerData['current'].'/'.$pagerData['total'];
  echo '</div>';
 */
?>