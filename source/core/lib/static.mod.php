<?php




checktop();
class YMod extends Y{
    
    public static function selectItemParamter($paramter, $inval, $name, $type='', $text='请选择', $extend=array()) {
        $m_item = M('item', 'am');
        $paramter_value = $m_item->getParamterVal($paramter);
        unset($m_item);
        $type = empty($type) ? 'select' : $type;
        $temp = '';
        
        if ($type == 'select') {
            $temp .= "<select name='{$name}' id='{$name}'";
            if (!empty($extend['css'])) {
                $temp .= " css='".$extend['css']."'";
            }
            if (!empty($extend['onchange'])) {
                $temp .= " onchange=\"".$extend['onchange']."\"";
            }
            $temp .= ">";
            $temp .= "<option value=''>{$text}</option>";
            $temp = $temp.self::_paramterOptions($inval, $paramter_value);
            $temp .= "</select>";
        }
        
        elseif ($type == 'multiple') {
            $temp .= "<select name='{$name}[]' id='{$name}[]' multiple='multiple'>";
            $temp .= "<option value=''>{$text}</option>";
            $temp = $temp.self::_paramterMutilpleOptions($inval, $paramter_value);
            $temp .= "</select>";
        }
        
        elseif ($type == 'checkbox') {
            $temp = self::_paramterCheckBox($paramter, $inval, $name, $paramter_value, $extend);
        }
        return $temp;

    }
    
    private static function _paramterOptions($invalue, $paramvalue) {
        $loop  = '';
        $splitarray = explode('|', $paramvalue);
        for($i = 0; $i<sizeof($splitarray); $i++) {
            $itemarray = trim($splitarray[$i]);
            $valuearray = explode('#', $itemarray);
            $loop .= "<option value='".intval($valuearray[0])."'";
            if(intval($invalue) == intval($valuearray[0])){
                $loop .= " selected";
            }
            $loop .= ">".trim($valuearray[1])."</option>";
        }
        return $loop;
    }
    
    private static function _paramterMutilpleOptions($invalue, $paramvalue) {
        $loop  = '';
        $splitarray = explode('|', $paramvalue);
        for($i = 0; $i<sizeof($splitarray); $i++) {
            $itemarray = trim($splitarray[$i]);
            $valuearray = explode('#', $itemarray);
            $loop .= "<option value='".intval($valuearray[0])."'";
            if (!empty($invalue)) {
                if (YHandle::foundInChar($invalue, intval($valuearray[0]), ',')) {
                    $loop .= ' selected';
                }
            }
            $loop .= ">".trim($valuearray[1])."</option>";
        }
        return $loop;
    }
    private static function _paramterCheckBox($paramter, $invalue, $name, $paramvalue, $extend) {
        $maxnum = empty($extend['maxnum']) ? 5 : $extend['maxnum'];
        $trnum = empty($extend['trnum']) ? 5 : $extend['trnum'];
        $width = empty($extend['width']) ? '98%' : $extend['width'];
        $css = empty($extend['css']) ? 'hback' : $extend['css'];
        $temp = '';
        $loop = '';
        $splitarray = explode('|', $paramvalue);
        for($i=0; $i<sizeof($splitarray); $i++){
            $itemarray  = trim($splitarray[$i]);
            $valuearray = explode('#', $itemarray);
            $loop = $loop ." <td class='".$css."' width='20%'>";
            if (intval($maxnum)>0) {
                $loop = $loop ." <input type='checkbox' name='".$name."[]' id='".$name."[]' onclick=\"check_maxnum('".$paramter."', this, ".$maxnum.")\" value='".intval($valuearray[0])."'";
            }
            else {
                $loop = $loop ." <input type='checkbox' name='".$name."[]' id='".$name."[]' value='".intval($valuearray[0])."'";
            }
            if (!empty($invalue)) {
                if (YHandle::foundInChar($invalue, intval($valuearray[0]), ',')) {
                    $loop .= ' checked';
                }
            }
            $loop .= " /> ".trim($valuearray[1])."";
            $loop .= " </td>";
            if (($i+1)%($trnum) == 0) {
                $loop .= "</tr><tr>";
            }
        }
        $temp  = "<table width='{$width}' border='0' align='left' cellpadding='0' cellspacing='0'>";
        $temp .= "  <tr>";
        $temp .= $loop;
        $temp .= "  </tr>";
        $temp .= "</table>";
        return $temp;
    }


    
    public static function getItemParamter($paramter, $inid, $type='', $text='未填写') {
        $type = empty($type) ? 'text' : $type;
        $string = '';
        $m_item = M('item', 'am');
        $paramter_value = $m_item->getParamterVal($paramter);
        unset($m_item);
        if (empty($inid) || $inid==0) {
            $string = $text;
        }
        else {
            if ($type == 'text') {
                return self::_paramterText($inid, $paramter_value);
            }
            else {
                $array  = explode(',', $inid);
                for ($ii=0; $ii<sizeof($array); $ii++) {
                    $string .= self::_paramterText(intval($array[$ii]), $paramter_value)."&nbsp;&nbsp;";
                }
            }
        }
        return $string;
    }
    private static function _paramterText($inval, $paramvalue) {
        $text_val = '';
        $splitarray = explode('|', $paramvalue);
        for ($i=0; $i<sizeof($splitarray); $i++) {
            $itemarray = trim($splitarray[$i]);
            $valuearray = explode('#', $itemarray);
            if(intval($inval) == intval($valuearray[0])){
                $text_val = trim($valuearray[1]);
            }
        }
        return $text_val;
    }

    
    public static function selectDeparts($value, $name, $text='请选择', $css='', $onchange='') {
        $temps = '';
        $temps .= "<select name='{$name}' id='{$name}'";
        if (!empty($css)) {
            $temps .= " class='{$css}'";
        }
        if (!empty($onchange)) {
            $temps .= " onchange=\"".$onchange."\"";
        }
        $temps .= ">";
        if (!empty($text)) {
            $temps .= "<option value=''>{$text}</option>";
        }
        #MODEL
        $m_depart = M('departs', 'am');
        $temps .= $m_depart->dataOptionTree(intval($value));
        unset($m_depart);
        $temps .= "</select>";
        return $temps;
    }

    
    public static function selectRoles($value, $name, $text='请选择', $css='', $onchange='') {
        $temps = '';
        $temps .= "<select name='{$name}' id='{$name}'";
        if (!empty($css)) {
            $temps .= " class='{$css}'";
        }
        if (!empty($onchange)) {
            $temps .= " onchange=\"".$onchange."\"";
        }
        $temps .= ">";
        if (!empty($text)) {
            $temps .= "<option value=''>{$text}</option>";
        }
        #MODEL
        $m_roles = M('roles', 'am');
        $temps .= $m_roles->dataOptionTree(intval($value));
        unset($m_roles);
        $temps .= "</select>";
        return $temps;
    }

    
    public static function selectGoodscat($value, $name, $text='请选择', $css='', $onchange='') {
        $temps = '';
        $temps .= "<select name='{$name}' id='{$name}'";
        if (!empty($css)) {
            $temps .= " class='{$css}'";
        }
        if (!empty($onchange)) {
            $temps .= " onchange=\"".$onchange."\"";
        }
        $temps .= ">";
        if (!empty($text)) {
            $temps .= "<option value=''>{$text}</option>";
        }
        #MODEL
        $m_roles = M('goodscat', 'am');
        $temps .= $m_roles->dataOptionTree(intval($value));
        unset($m_roles);
        $temps .= "</select>";
        return $temps;
    }

    
    public static function selectAdmin($value, $name, $text='请选择', $css='', $onchange='') {
        $temps = '';
        $temps .= "<select name='{$name}' id='{$name}'";
        if (!empty($css)) {
            $temps .= " class='{$css}'";
        }
        if (!empty($onchange)) {
            $temps .= " onchange=\"".$onchange."\"";
        }
        $temps .= ">";
        $temps .= "<option value=''>{$text}</option>";
        $m_admin = M('admins', 'am');
        $temps .= $m_admin->getOptions(intval($value));
        unset($m_admin);
        $temps .= "</select>";
        return $temps;
    }

    
    public static function selectMysubAdmin($value, $name, $text='请选择', $css='', $onchange='') {
        $temps = '';
        $temps .= "<select name='{$name}' id='{$name}'";
        if (!empty($css)) {
            $temps .= " class='{$css}'";
        }
        if (!empty($onchange)) {
            $temps .= " onchange=\"".$onchange."\"";
        }
        $temps .= ">";
        $temps .= "<option value=''>{$text}</option>";
        $m_admin = M('admins', 'am');
        $temps .= $m_admin->getOptionMysubAdmins(intval($value));
        unset($m_admin);
        $temps .= "</select>";
        return $temps;
    }
}
?>
