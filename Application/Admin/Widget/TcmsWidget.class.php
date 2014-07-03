<?php

namespace Admin\Widget;

class TcmsWidget extends \Think\Controller {

    /**
     * categoryID 字段
     * @param type $field
     * @return string|null
     */
    public function showCategory($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {

            $categoryModel = new \Common\Model\CategoryModel();
            $map['lm_id'] = array('EQ', $menuData['lm_id']);
            $map['deleted'] = array('EQ', 0);
            $cateData = $categoryModel->where($map)->order('sort asc')->select();
            $treeModel = new \Common\Org\Tree($cateData);
            $cateData = $treeModel->getArray();

            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<select name="' . $field . '">';
            $returnStr .='<option value="0">----请选择----</option>';
            foreach ($cateData as $v) {
                if ($v['id'] == $data['category'])
                    $selectStr = 'selected = "selected"';
                else
                    $selectStr = '';
                $returnStr .= '<option value="' . $v['id'] . '"' . $selectStr . '>' . $v['category_title'] . '</option>';
            }
            $returnStr .='</select>';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * categoryID 字段
     * @param type $field
     * @return string|null
     */
    public function showCategorySelect($data, $selected, $menuData) {
        $categoryModel = new \Common\Model\CategoryModel();
        $map['lm_id'] = array('EQ', $menuData['lm_id']);
        $map['deleted'] = array('EQ', 0);
        $cateData = $categoryModel->where($map)->order('sort asc')->select();
        $treeModel = new \Common\Org\Tree($cateData);
        $cateData = $treeModel->getArray();

        $returnStr = '<tr><td>';
        $returnStr .= '上级类别';
        $returnStr .= '</td><td class="textleft">';
        $returnStr .= '<select name="parent_id">';
        $returnStr .='<option value="0">----顶级类别----</option>';
        foreach ($cateData as $v) {
            if ($v['id'] == $data['parent_id'] || $v['id'] == $selected)
                $selectStr = 'selected = "selected"';
            else
                $selectStr = '';
            $returnStr .= '<option value="' . $v['id'] . '"' . $selectStr . '>' . $v['category_title'] . '</option>';
        }
        $returnStr .='</select>';
        $returnStr .='</td></tr>';
        return $returnStr;

        return NULL;
    }

    /**
     * input 字段
     * @param type $field
     * @return string|null
     */
    public function showInput($field, $data, $menuData) {
        $selectCheckArray = explode('|', $menuData[$field . '_']);
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td width="100">';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            if (in_array($field . '_select', $menuData['allow_field'])) {
                $returnStr .= '<select name="' . $field . '">';
                foreach ($selectCheckArray as $v) {
                    $selected = '';
                    if ($v == $data[$field])
                        $selected = 'selected';
                    $returnStr .= '<option value="' . $v . '" ' . $selected . '>' . $v . '</option>';
                }
                $returnStr .= '</select>';
            } elseif (in_array($field . '_check', $menuData['allow_field'])) {
                foreach ($selectCheckArray as $v) {
                    $checked = '';
                    $fieldArray = explode('|', $data[$field]);
                    if (in_array($v, $fieldArray))
                        $checked = 'checked';
                    $returnStr .= '<input type="checkbox" name="' . $field . '[]" value="' . $v . '"' . $checked . ' />&nbsp;' . $v . '&nbsp;';
                }
            } else {
                $returnStr .= '<input type="text" name="' . $field . '" value="' . $data[$field] . '" size="50" />';
            }
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }
    
    /**
     * 排序字段 sort
     * @param type $field
     * @return string|null
     */
    public function showSort($field, $data, $menuData) {
        $selectCheckArray = explode('|', $menuData[$field . '_']);
        if ($menuData['sort']) {
            $returnStr = '<tr><td width="100">';
            $returnStr .= '排序(越小越前)';
            $returnStr .= '</td><td class="textleft">';
            if (in_array($field . '_select', $menuData['allow_field'])) {
                $returnStr .= '<select name="' . $field . '">';
                foreach ($selectCheckArray as $v) {
                    $selected = '';
                    if ($v == $data[$field])
                        $selected = 'selected';
                    $returnStr .= '<option value="' . $v . '" ' . $selected . '>' . $v . '</option>';
                }
                $returnStr .= '</select>';
            } elseif (in_array($field . '_check', $menuData['allow_field'])) {
                foreach ($selectCheckArray as $v) {
                    $checked = '';
                    $fieldArray = explode('|', $data[$field]);
                    if (in_array($v, $fieldArray))
                        $checked = 'checked';
                    $returnStr .= '<input type="checkbox" name="' . $field . '[]" value="' . $v . '"' . $checked . ' />&nbsp;' . $v . '&nbsp;';
                }
            } else {
                $returnStr .= '<input type="text" name="' . $field . '" value="' . $data[$field] . '" size="50" />';
            }
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * 文本区域
     * @param type $field
     * @return string|null
     */
    public function showTextarea($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<textarea cols="80" rows="8" name="' . $field . '">' . $data[$field] . '</textarea>';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * 回复文本区域
     * @param type $field
     * @return string|null
     */
    public function showRecontent($field, $data, $menuData) {
        if (in_array('huifu', $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= '回复';
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<textarea cols="80" rows="8" name="' . $field . '">' . $data[$field] . '</textarea>';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * 编辑器区域
     * @return string|null
     */
    public function showEditorContent($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<textarea class="content" cols="100" rows="15" name="' . $field . '">' . stripslashes($data[$field]) . '</textarea>';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * 单选按钮
     * @return string|null
     */
    public function showRadio($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $checkedY = '';
            $checkedN = '';
            if ($data[$field])
                $checkedY = 'checked';
            //if (!$newsinfo->$field)
            else
                $checkedN = 'checked';
            $returnStr .= '<input type="radio" name="' . $field . '" value="1" ' . $checkedY . ' /> 是　<input type="radio" name="' . $field . '" value="0"' . $checkedN . ' /> 否';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * 单图片上传字段
     *
     */
    public function showUploadSingle($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<div id="' . $field . 'Div"><ul>';
            if (is_file(APP_ROOT . $data[$field]))
                $returnStr .= '<li class="wait"><a href="' . $data[$field] . '" target="_blank"><img src="' . $data[$field] . '"></a><input type="hidden" name="upload1" value="' . $newsinfo->$field . '"><span class="closed"></span></li>';
            $returnStr .= '<li class="uploadButtonDiv" id="' . $field . 'ButtonDiv"><input id="' . $field . 'Button" type="file" name="file" size="1"/></li>
</ul></div>';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * 多图片上传
     */
    public function showUploadMulti($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<div class="multipicDiv" id="multipicDiv"><ul>';
            if ($data[$field]) {
                $picArray = explode("\n", $data[$field]); //0order 1url 2title 3default
                asort($picArray);
                foreach ($picArray as $value) {
                    $picInfoArray = explode('|', $value);
                    $defaultText = $picInfoArray[3] == 1 ? "默认图片" : "设为默认图";
                    if (is_file(APP_ROOT . $picInfoArray[1]))
                        $returnStr .= '<li class="waits"><div class="list_img"><a href="' . $picInfoArray[1] . '" target="_blank"><img src="' . $picInfoArray[1] . '"></a></div><input type="text" class="multiInputTitle" name="multiTitle[]" value="' . $picInfoArray[2] . '" /><input type="text" class="multiInputOrder" name="multiOrder[]" value="' . $picInfoArray[0] . '" /><input type="hidden" name="multiUrl[]" value="' . $picInfoArray[1] . '" /><input type="hidden" name="multiDefault[]" value="' . $picInfoArray[3] . '"><div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>' . $defaultText . '</a></span></div><span class="closed"></span></li>';
                }
            }
            $returnStr .= '<li class="uploadButtonDiv" id="multipicButtonDiv"><input id="multipicButton" type="file" name="file" size="1"/></li>
</ul></div>';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

    /**
     * input 时间字段
     * @param type $field
     * @return string|null
     */
    public function showCreated($field, $data, $menuData) {
        if (in_array($field, $menuData['allow_field'])) {
            $returnStr = '<tr><td>';
            $returnStr .= $menuData[$field];
            $returnStr .= '</td><td class="textleft">';
            $returnStr .= '<input type="text" name="' . $field . '" value="' . date('Y-m-d H:i:s', $data[$field] ? $data[$field] : NOW_TIME) . '" onClick="WdatePicker()" style="width:182px;" />';
            $returnStr .='</td></tr>';
            return $returnStr;
        }
        return NULL;
    }

}