<?php

/**
 * 登陆控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class LoginController extends \Think\Controller {

	/**
	 * 登录主页面
	 * @author Cloud
	 * @since 2014-05-12
	 * @copyright TcitCMS
	 */
	function index() {
		if (cookie(C('COOKIE_NAME_ADMIN')))
			$this->success('欢迎回来！', '/');
		if (IS_AJAX) {
			$data = json_decode(I('post.data'), true);
			$Model = new \Home\Model\UserModel ();
			$Res = $Model->loginAction();
			if ($Res == 1) {
				echo 'success';
			} else {
				echo $Res;
			}
			exit;
		}
		$this->display();
	}

	/**
	 * 退出登录
	 *
	 * @return  return_type
	 *
	 * @author Andy
	 * @since 2014-4-1 上午11:02:11
	 * @copyright CHOFN
	 */
	function loginOut() {
		$Model = new \Home\Model\UserModel ();
		$Model->loginOut();
		$this->success('您已安全退出', U('/Login'));
	}

	public function recpassword() {
		if (IS_AJAX) {
			$username = I('post.username', '', 'trim');
			empty($username) && $this->ajaxReturn(array('status' => 0, 'info' => '请输入账号'));
			$model = new \Home\Model\UserModel();
			$model->startTrans();
			$where['username'] = $username;
			$tel = $model->getFieldValue($where, 'tel');
			empty($tel) && $this->ajaxReturn(array('status' => 0, 'info' => '未找到对应手机号'));
			$password = S($username . $tel);
			if (empty($password)) {
				$password = rand(100000, 999999);
				if ($model->where(array('en_name' => $username))->data(array('password' => $password))->save() == false) {
					$model->rollback();
					$this->ajaxReturn(array('status' => 0, 'info' => '重设密码失败'));
					exit;
				}
				S($username . $tel, $password, 600);
			}
			if ($tel) {
				$Mes = new Mes();
				$content = '你的新密码为:' . $password;
				$mesRes = $Mes->addInfo(2, $tel, '重设密码', $content);
				if (!intval($mesRes)) {
					$model->rollback();
					$res = array(
						'status' => 0,
						'info' => $mesRes
					);
				} else {
					$res = array(
						'status' => 1,
						'info' => '新密码已发送至你的手机' . str_replace(substr($tel, 4, 5), '*****', $tel)
					);
					$model->commit();
				}
			} else {
				$res = array(
					'status' => 0,
					'info' => '没找到这个用户名哦'
				);
			}

			$this->ajaxReturn($res);
		} else {
			$this->display();
		}
	}

}

?>