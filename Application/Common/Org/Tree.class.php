<?php

/**
 * 生成树的专用类库
 *
 * @author Andy
 * @since 2014-3-28 下午5:00:18
 * @copyright CHOFN
 */
namespace Common\Org;

class Tree {
	/**
	 * 获取可以组装成树结构的数据列表
	 *
	 * @param Model $model
	 *        	模型
	 * @param string $pids
	 *        	传入的ID串（中间用,隔开）
	 * @param string $removeIds
	 *        	需要移除的ID串（中间用,隔开）
	 * @param string $rootText
	 *        	树根显示内容
	 * @param boolen $isTree
	 *        	是否返回树状结构的数据类型
	 * @param string $idField
	 *        	绑定到树的ID字段
	 * @param string $textField
	 *        	绑定到树的text字段
	 * @param string $pidField
	 *        	父ID字段
	 * @return tree 或 list
	 *
	 * @author Andy
	 * @since 2014-4-4 下午2:25:19
	 * @copyright CHOFN
	 */
	public function getTreeList($model, $pids = '', $removeIds = '', $rootText = '', $isTree = false, $idField = 'id', $textField = 'name', $pidField = 'pid') {
		$params = self::handleTreeParams ( $pids, $removeIds, $idField, $textField, $pidField, $isTree );
		if (! is_array ( $params )) {
			return $params;
		}
		$removeIdsArray = $params ['removeIdsArray'];
		$pidArray = $params ['pidArray'];

		$map ['deleted'] = array (
				'eq',
				'0'
		);

		$list = $model->where ( $map )->select ();

		$result = array ();
		if ($pidArray) {
			$where ['id'] = array (
					'in',
					$pids
			);
			$pList = $model->where ( $where )->select ();

			if ($isTree) {
				$result = self::createTree ( $list, $idField, $textField, $pidField, $pList, $removeIdsArray, $rootText );
			} else {
				$result = self::createList ( $list, $pidArray, $pList, $removeIdsArray, $rootText );
			}
		} else {
			if ($isTree) {
				$result = self::createTree ( $list, $idField, $textField, $pidField, null, $removeIdsArray, $rootText );
			} else {
				$result = self::createList ( $list, null, null, $removeIdsArray, $rootText );
			}
		}
		return $result;
	}

	/**
	 * 创建可以填充树结构的列表
	 *
	 * @param list $allDataList
	 *        	所有数据列表
	 * @param array $pidArray
	 *        	父ID数组
	 * @param string $parentDataList
	 *        	根据父ID串获取的列表
	 * @param string $removeIdsArray
	 *        	被排除的ID数组
	 * @param string $rootText
	 *        	根节点显示内容
	 * @return list
	 *
	 * @author Andy
	 * @since 2014-4-4 下午4:08:05
	 * @copyright CHOFN
	 */
	private function createList($allDataList, $pidArray = null, $parentDataList = null, $removeIdsArray = null, $rootText = '') {
		$result = array ();
		if ($parentDataList) {

			foreach ( $pidArray as $currentPid ) {
				self::getChildList ( $allDataList, $currentPid, $removeIdsArray, $parentDataList );
			}
			$result = $parentDataList;
		} else {
			$result = $allDataList;
		}

		// 添加根节点
		if ($rootText) {
			$keys = $allDataList [0];
			$rootArray = array ();

			foreach ( $keys as $key => $value ) {
				if (strstr ( $key, 'name' )) {
					$keys [$key] = $rootText;
				} else {
					$keys [$key] = '';
				}
				$key == 'pid' && $keys ['pid'] = '0';
			}
			$rootArray [] = $keys;
		}
		if ($rootArray && $result) {
			$result = array_merge ( $rootArray, $result );
		} elseif ($rootArray) {
			$result = $rootArray;
		}
		return $result;
	}

	/**
	 * 递归列表结构
	 *
	 * @param SOURCE $data
	 *        	数据源
	 * @param unknown $pid
	 *        	父ID
	 * @param array $removeIdArray
	 *        	被移除的ID数组
	 * @param unknown $result
	 *
	 * @author Andy
	 * @since 2014-4-2 下午3:06:58
	 * @copyright CHOFN
	 */
	private function getChildList($data, $pid, $removeIdArray, &$result) {
		$current_result = array ();
		foreach ( $data as $item ) {
			if (! in_array ( $item ['id'], $removeIdArray ) && $item ['pid'] == $pid) {
				$result [] = $item;
				self::getChildList ( $data, $item ['id'], $removeIdArray, $result );
			}
		}
	}

	/**
	 * 创建树
	 *
	 * @param list $allDatalist
	 *        	所有数据列表
	 * @param string $idField
	 *        	绑定到树的ID字段
	 * @param string $textField
	 *        	绑定到树的text字段
	 * @param string $pidField
	 *        	父ID字段
	 * @param list $parentDataList
	 *        	根据PIDS字符串获取到的数据列表
	 * @param array $removeIdsArray
	 *        	被排除的IDS数组
	 * @param string $rootText
	 *        	树根显示内容
	 * @return tree
	 *
	 * @author Andy
	 * @since 2014-4-4 下午2:59:33
	 * @copyright CHOFN
	 */
	private function createTree($allDataList, $idField, $textField, $pidField, $parentDataList = null, $removeIdsArray = null, $rootText = '') {
		$result = array ();

		if ($rootText) {
			$result [] = array (
					'id' => '',
					'text' => $rootText,
					'children' => null
			);
		}

		if ($parentDataList) {
			foreach ( $parentDataList as $parent ) {
				$currentObj = array ();
				$currentObj ['id'] = $parent [$idField];
				$currentObj ['text'] = $parent [$textField];
				$currentObj ['children'] = self::getChildTree ( $allDataList, $idField, $textField, $pidField, $parent [$idField], $removeIdsArray );
				$result [] = $currentObj;
			}
		} else {
			$result_tmp = self::getChildTree ( $allDataList, $idField, $textField, $pidField, 0, $removeIdsArray );
			foreach ( $result_tmp as $v ) {
				$result [] = $v;
			}
		}

		return $result;
	}

	/**
	 * 递归树结构
	 *
	 * @param list $data
	 * @param string $idField
	 * @param string $textField
	 * @param string $pid
	 * @param array $removeIdsArray
	 * @return tree
	 *
	 * @author Andy
	 * @since 2014-4-4 下午3:36:01
	 * @copyright CHOFN
	 */
	private function getChildTree($data, $idField, $textField, $pidField, $pid, $removeIdsArray) {
		$current_result = array ();
		foreach ( $data as $item ) {
			if (! in_array ( $item [$idField], $removeIdsArray )) {
				$current_obj = array ();
				$current_obj ['id'] = $item [$idField];
				$current_obj ['text'] = $item [$textField];
				if ($item [$pidField] == $pid) {
					$current_obj ['children'] = self::getChildTree ( $data, $idField, $textField, $pidField, $item [$idField], $removeIdsArray );
					$current_result [] = $current_obj;
				}
			}
		}
		return $current_result;
	}

	/**
	 * 处理获取树数据时各个参数的合法性
	 *
	 * @param string $pids
	 *        	传入的ID串（中间用,隔开）
	 * @param string $removeIds
	 *        	需要移除的ID串（中间用,隔开）
	 * @param string $idField
	 *        	绑定到树的ID字段
	 * @param string $textField
	 *        	绑定到树的text字段
	 * @param string $pidField
	 *        	父id字段
	 * @param string $isTree
	 *        	是否返回树状结构的数据类型
	 * @return return_type
	 *
	 * @author Andy
	 * @since 2014-4-4 下午2:33:41
	 * @copyright CHOFN
	 */
	private function handleTreeParams(&$pids = '', &$removeIds = '', $idField = 'id', $textField = 'name', $pidField = 'pid', $isTree = false) {
		if (trim ( $pids ) && trim ( $pids ) == trim ( $removeIds )) {
			return L ( 'PID_EQ_REMOVEIDS' );
		}
		// 处理传入的参数
		$newPidArray = array ();
		if ($pids) {
			$pidArray = explode ( ",", $pids );
			foreach ( $pidArray as $p ) {
				if (intval ( $p ) > 0) {
					$newPidArray [] = intval ( $p );
				}
			}
			$pids = implode ( ",", $newPidArray );
		}
		$newRemoveIdsArray = array ();
		if ($removeIds) {
			$removeIdsArray = explode ( ",", $removeIds );
			foreach ( $removeIdsArray as $r ) {
				if (intval ( $r ) > 0) {
					$newRemoveIdsArray [] = intval ( $r );
				}
			}
			$removeIds = implode ( ",", $newRemoveIdsArray );
		}

		// 判断传入的PID是否在被移除的ID串中,如果在直接从PID串中将其剔除
		unset ( $pidArray );
		unset ( $removeIdsArray );
		$pidArray = array ();
		if ($newPidArray && $newRemoveIdsArray) {
			foreach ( $newPidArray as $pid ) {
				if (! in_array ( $pid, $newRemoveIdsArray )) {
					$pidArray [] = $pid;
				}
			}
		} else {
			$pidArray = $newPidArray;
		}

		if ($isTree && (! $idField || ! $textField || ! $pidField)) {
			return L ( 'MAKE_TREE_PARAMS_ERROR' );
		}

		$removeIdsArray = $newRemoveIdsArray;
		$pids = implode ( ",", $pidArray );
		return array (
				'pidArray' => $pidArray,
				'removeIdsArray' => $removeIdsArray
		);
	}
}