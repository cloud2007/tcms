<?php

/**
 * 文件上传类
 * @author cloud
 * @version 2013.12.31
 */

namespace Common\Org;

class Uploader {

	public $inputname, $immediate, $dirtype, $rootdir, $attachdir, $uploadDir, $maxsize, $msgtype, $allowFile, $enableSize, $needResize, $needWaterMark;

	const WATER_MARK_TEXT = 'text', WATER_MARK_IMAGE = 'image';
	const ALLOWFILE_IMAGE = 'image', ALLOWFILE_FLASH = 'flash', ALLOWFILE_MEDIA = 'media', ALLOWFILE_FILE = 'file';

	private $fileList = array(
		'image' => 'gif,jpg,jpeg,png,bmp',
		'flash' => 'swf,flv',
		'media' => 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb',
		'file' => 'txt,rar,zip',
	);
	private $fileListAll;

	function __construct($config) {
		$this->fileListAll = implode(',', $this->fileList);
		$this->inputname = $config['inputname'] ? $config['inputname'] : 'Filedata';
		$this->immediate = null;
		$this->dirtype = '4';
		$this->rootdir = APP_ROOT;
		$this->attachdir = $this->rootdir . C('UPLOAD_PATH') . $config['uploadPath']; //上传文件保存路径，结尾不要带/
		$this->uploadDir = C('UPLOAD_PATH') . '/' . $config['uploadPath'];
		$this->maxsize = 16777216; //2097152;//最大上传大小，默认是2M
		$this->msgtype = 1; //返回上传参数的格式：1，只返回url，2，返回参数数组
		$this->allowFile = $config['allowFile'] ? $this->fileList[$config['allowFile']] : $this->fileListAll; //上传扩展名
		$this->enableSize = $config['thumbSize'];
		$this->needResize = true;
		$this->needWaterMark = $config['watermark'];
	}

	function save($json = true) {
		$err = $msg = '';
		$upfile = isset($_FILES[$this->inputname]) ? $_FILES[$this->inputname] : null;
		if (is_null($upfile)) {
			$result = array('err' => 'no file', 'msg' => $msg);
			return $json ? json_encode($result) : $result;
		}
		if (!empty($upfile['error'])) {
			switch ($upfile['error']) {
				case '1':
					$err = '文件大小超过了php.ini定义的upload_max_filesize值';
					break;
				case '2':
					$err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
					break;
				case '3':
					$err = '文件上传不完全';
					break;
				case '4':
					$err = '无文件上传';
					break;
				case '6':
					$err = '缺少临时文件夹';
					break;
				case '7':
					$err = '写文件失败';
					break;
				case '8':
					$err = '上传被其它扩展中断';
					break;
				case '999':
				default:
					$err = '无有效错误代码';
			}
		} elseif (empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none') {
			$err = '无文件上传';
		} else {
			$temppath = $upfile['tmp_name'];
			$fileinfo = pathinfo($upfile['name']);
			$extension = $fileinfo['extension']; //文件格式
			//$file_tag = $fileinfo['filename']; //源文件名作为上传后的文件数据库中标签
			if (preg_match('/' . str_replace(',', '|', $this->allowFile) . '/i', $extension)) {
				$filesize = @filesize($temppath);
				if ($filesize > $this->maxsize) {
					$err = '文件大小超过' . $this->maxsize . '字节';
					$result = array('err' => $err, 'msg' => $msg);
					return $json ? json_encode($result) : $result;
				} else {
					/*
					  $imginfo = @getimagesize($temppath);
					  $width_ = $imginfo[0];
					  $height_ = $imginfo[1];
					  if($width_<>660)
					  $err = '图片宽度必须为660';
					  if($height_<>450)
					  $err = '图片高度必须为450';
					 */

					if (!is_dir($this->attachdir)) {
						@mkdir($this->attachdir, 0777);
					}

					switch ($this->dirtype) {
						case 1: $attach_subdir = 'day_' . date('ymd');
							break;
						case 2: $attach_subdir = 'month_' . date('ym');
							break;
						case 3: $attach_subdir = 'ext_' . $extension;
							break;
						case 4: $attach_subdir = date('Ym');
							break;
						default:break;
					}
					$attach_dir = $this->attachdir . '/' . $attach_subdir;
					if (!is_dir($attach_dir)) {
						@mkdir($attach_dir, 0777);
					}
					$filename = date("Ymd") . '_' . date('His') . '_' . rand(1000, 9999) . '.' . $extension;
					$target = $this->rootdir ? str_replace($this->rootdir, '', $attach_dir . '/' . $filename) : $attach_dir . '/' . $filename; //插入编辑器的文件路径 若使用绝对路径则插入编辑器的内容要去掉$this->rootdir
					$targetfile = $attach_dir . '/' . $filename; //上传的文件地址
					move_uploaded_file($upfile['tmp_name'], $targetfile);
					if ($this->immediate == '1')
						$target = '!' . $target;
					if ($this->msgtype == 1)
						$msg = $target;
					else
						$msg = array('url' => $target, 'localname' => $upfile['name'], 'dbPath' => str_replace($this->uploadDir, '', $target)); //id参数固定不变，仅供演示，实际项目中可以是数据库ID
					if ($this->needResize == true) {//需要生成缩略图
						foreach ($this->enableSize as $size => $val) {
							$resize = $this->resize($this->rootdir . $target, $size);
							if (stripos($this->fileList['image'], $extension)) {
								switch ($val['watermark']) {
									case self::WATER_MARK_IMAGE:
										$this->waterMarkImage($resize);
										break;
									case self::WATER_MARK_TEXT:
										$this->waterMarkText($resize);
										break;
									default:
										break;
								}
							}
						}
					}
					if (stripos($this->fileList['image'], $extension)) {
						switch ($this->needWaterMark) {
							case self::WATER_MARK_IMAGE:
								$this->waterMarkImage($this->rootdir . $target);
								break;
							case self::WATER_MARK_TEXT:
								$this->waterMarkText($this->rootdir . $target);
								break;
							default:
								break;
						}
					}
				}
			}
			else
				$err = '上传文件扩展名必需为：' . $this->allowFile;
		}
		/**
		 * 返回数据说明
		 * $msg $url 为不带系统上传路径的图片路径
		 * $real_path 为本次上传真实路径
		 */
		$result = array();
		$result['err'] = $err;
		$result['msg'] = str_replace(C('UPLOAD_PATH'), '', $msg);
		$result['real_path'] = $msg;
		//下面两行为kindEditor返回数据
		$result['error'] = $err ? 1 : 0;
		$result['message'] = $err;
		$result['url'] = $msg;
		//$result = array('err' => $err, 'url' => $msg, 'msg' => str_replace(UPLOAD_PATH, '', $msg));
		return $json ? json_encode($result) : $result;
	}

	function resize($imagePath, $size) {
		if ((bool) $imagePath && is_file($imagePath) && in_array($size, array_keys($this->enableSize))) {
			$config = array(
				'source_image' => $imagePath,
				'create_thumb' => true,
				'maintain_ratio' => true,
				'width' => $this->enableSize[$size]['width'],
				'height' => $this->enableSize[$size]['height'],
			);
			$image = new Image($config);
			$resize = $image->full_dst_path = str_replace($image->thumb_marker, "_{$size}", $image->full_dst_path);
			$image->resize();
			$image->clear();
			return $resize;
		}
	}

	private function waterMark($imagePath, $config) {
		$file = $imagePath;
		if ((bool) $imagePath && is_file($file)) {
			$defaultConfig = array_merge(array(
				'source_image' => $file,
				'quality' => 100,
				'wm_vrt_alignment' => 'bottom',
				'wm_hor_alignment' => 'right',
				'wm_padding' => '-20',
					), $config);
			$image = new Image($defaultConfig);
			//$image->full_dst_path = str_replace($image->thumb_marker, "_{$size}", $image->full_dst_path);
			$image->watermark();
			$image->clear();
		}
	}

	private function waterMarkText($imagePath, $text = 'Veision1.0!') {
		if (is_null($text))
			$text = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
		if (!is_null($text)) {
			$this->waterMark($imagePath, array(
				'wm_text' => $text,
				'wm_type' => 'text', //(必须)设置想要使用的水印处理类型(text, overlay)
				'wm_font_size' => 5, //字体大小 没有使用自定义字体则只能是1-5之间
				'wm_font_color' => 'FF0000', //字体颜色
				'wm_shadow_color' => 'ffffff', //阴影的颜色
				'wm_shadow_distance' => 0, //阴影与文字之间的距离(以像素为单位)。
					//'wm_font_path' => Url::filePath('msyh.ttf'),//水印字体名字和路径
			));
		}
	}

	private function waterMarkImage($imagePath) {

		$this->waterMark($imagePath, array(
			'wm_overlay_path' => APP_ROOT . '/Public/Uploads/logo.png', //水印图像的名字和路径
			'wm_type' => 'overlay', //(必须)设置想要使用的水印处理类型(text, overlay)
			'wm_x_transp' => 4, //水印图像通道
			'wm_y_transp' => 4, //水印图像通道
			'wm_opacity' => 100, //水印图像的透明度
		));
	}

}

?>