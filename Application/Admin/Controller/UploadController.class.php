<?php

/**
 * 图片上传控制器
 * @author:Cloud <190296465@qq.com>
 * @since 2014-5-27 16:40:45
 * @copyright ChofnERP
 */

namespace Admin\Controller;

class UploadController extends CommonController {

    protected static $defaultconfig = array(
        'uploadPath' => '',
        'watermark' => '',
    );

    private function getConfig() {
        if (session('lm_id') == 999) {
            $config = array(
                'uploadPath' => '/test',
                'watermark' => C('WATERMARK'),
                'allowFile' => \Common\Org\Uploader::ALLOWFILE_IMAGE,
                'thumbSize' => array(
                    'small' => array(
                        'width' => '229',
                        'height' => '352',
                        'watermark' => C('WATERMARK')
                    ),
                )
            );
        } else {
            $config = self::$defaultconfig;
        }
        return $config;
    }

    private function getMutilConfig() {
        if (session('lm_id') == 999) {
            $config = array(
                'uploadPath' => '/test',
                'watermark' => C('WATERMARK'),
                'allowFile' => \Common\Org\Uploader::ALLOWFILE_IMAGE,
                'thumbSize' => array(
                    'small' => array(
                        'width' => '229',
                        'height' => '352',
                        'watermark' => C('WATERMARK')
                    ),
                )
            );
        } else {
            $config = self::$defaultconfig;
        }
        return $config;
    }

    /**
     * 文件上传
     */
    public function sigleUpload() {
        $uploader = new \Common\Org\Uploader($this->getConfig());
        echo $uploader->save();
    }

    /**
     * 文件上传
     */
    public function mutliUpload() {
        $uploader = new \Common\Org\Uploader($this->getMutilConfig());
        echo $uploader->save();
    }

    /**
     * kindEditor
     */
    public function kindEditor() {
        $config = array(
            'uploadPath' => '/kindEditor',
            'watermark' => '', //text or image
            'inputname' => 'imgFile',
                //'allowFile' => Uploader::ALLOWFILE_IMAGE,
        );
        $uploader = new \Common\Org\Uploader($config);
        echo $uploader->save();
    }

    /**
     * 图片管理
     */
    public function fileManager() {

        $root_path = ROOT_PATH . 'Uploads/kindEditor/'; //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_url = UPLOAD_PATH . '/kindEditor/'; //根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        //$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp'); //图片扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('txt', 'rar', 'zip'),
        );
        //目录名

        $dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
            echo "Invalid Directory name.";
            exit;
        }
        /**
          if ($dir_name !== '') {
          $root_path .= $dir_name . "/";
          $root_url .= $dir_name . "/";
          if (!file_exists($root_path)) {
          mkdir($root_path);
          }
          }
         *
         */
        //根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }

        //排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            echo 'Access is not allowed.';
            exit;
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            echo 'Parameter is not valid.';
            exit;
        }
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            echo 'Directory does not exist.';
            exit;
        }

        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.')
                    continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                    $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                    $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                } else {
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($file_ext, $ext_arr[$dir_name])) {
                        $file_list[$i]['is_dir'] = false;
                        $file_list[$i]['has_file'] = false;
                        $file_list[$i]['filesize'] = filesize($file);
                        $file_list[$i]['dir_path'] = '';
                        $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr['image']);
                        $file_list[$i]['filetype'] = $file_ext;
                        $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                        $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                    }
                }
                $i++;
            }
            closedir($handle);
        }

        //排序
        function cmp_func($a, $b) {
            $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        }

        usort($file_list, 'cmp_func');

        $result = array();

        $result['moveup_dir_path'] = $moveup_dir_path; //相对于根目录的上一级目录
        $result['current_dir_path'] = $current_dir_path; //相对于根目录的当前目录
        $result['current_url'] = $current_url; //当前目录的URL
        $result['total_count'] = count($file_list); //文件数
        $result['file_list'] = $file_list; //文件列表数组
        header('Content-type: application/json; charset=UTF-8');
        echo json_encode($result);
    }

}

?>