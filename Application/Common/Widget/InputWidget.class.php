<?php

namespace Home\Widget;

/**
 * 年份下拉用户控件
 *
 * @author Andy
 * @since 2014-5-5 下午4:07:05
 * @copyright CHOFN
 */
class YearWidget extends CommonWidget {
	
	/**
	 * 年份的控件
	 *
	 * @param unknown $controlId
	 *        	控件ID
	 * @param number $width
	 *        	控件宽度
	 * @param string $selectedValue
	 *        	被选中的值
	 * @param string $defaultValue
	 *        	默认值
	 * @param int $startYear
	 *        	开始年份（默认今年的前五年）
	 * @param int $length
	 *        	年份跨度（默认11）
	 * @return return_type
	 *
	 * @author Cloud
	 * @since 2014-4-23 14:29:09
	 * @copyright CHOFN
	 */
	function select($controlId, $width = 0, $selectedValue = "", $defaultValue = '--请选择年度--', $startYear = 0, $length = 11) {
		parent::_initialize ( $width, $controlId );
		$data = array (
				array (
						'id' => '0',
						'text' => '不限' 
				) 
		);
		if (! intval ( $startYear )) {
			$startYear = date ( 'Y' ) - 5;
		}
		for($i = $startYear; $i <= $startYear + 10; $i ++) {
			$data [] = array (
					'id' => $i,
					'text' => $i 
			);
		}

		$html = '<input style="width:' . $this->width . '" id="' . $this->controlId . '" name="' . $controlId . '" class="mini-combobox" value="' . $selectedValue . '"  emptyText="' . $defaultValue . '"/>';
		$html .= '<script type="text/javascript">
		try{
			$(function(){
				var _' . $this->controlId . ' = mini.get(\'' . $controlId . '\');
				_' . $this->controlId . '.setData(' . json_encode ( $data ) . ');
				_' . $this->controlId . '.setValue(\'' . $selectedValue . '\')
			})
		}catch(error){}
		</script>';
		return $html;
	}
}