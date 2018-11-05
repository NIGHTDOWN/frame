<?php




checktop();
class  YDate{
    
    public  static function getOrderMonth($sub, $type='asc') {
        $asc_month = array(
            '1'=>'01',
            '2'=>'02',
            '3'=>'03',
            '4'=>'04',
            '5'=>'05',
            '6'=>'06',
            '7'=>'07',
            '8'=>'08',
            '9'=>'09',
            '10'=>'10',
            '11'=>'11',
            '12'=>'12'
        );
        $desc_month = array(
            '1'=>'12',
            '2'=>'11',
            '3'=>'10',
            '4'=>'09',
            '5'=>'08',
            '6'=>'07',
            '7'=>'06',
            '8'=>'05',
            '9'=>'04',
            '10'=>'03',
            '11'=>'02',
            '12'=>'01'
        );
        if ($type == 'asc') {
            return $asc_month[$sub];
        }
        else {
            return $desc_month[$sub];
        }
    }
    
    public static function getDiffMonths($di=6, $type=0) {
        $result = '';
        $time = time();
        $enddate = date('Y-m-d', $time);
        $year = date('Y', $time);
        $month = date('m', $time);
        $intMonth = intval($month);
        $diffs = ($intMonth-$di);

        $startyear = 0;
        if ($diffs >= 0) {
            
            $absmonths = ($diffs+1);
            $startMonth = self::getOrderMonth($absmonths, 'asc');
            $startDate = $year.'-'.$startMonth;
        }
        else {
            
            $absmonths = abs($diffs);
            $diffYear_months = $absmonths;
            if ($absmonths > 12) {
                $multi = floor($absmonths/12);
                $absmonths = ($absmonths-(12*$multi));
            }
            $diffYear = ceil($diffYear_months/12);
            $startyear = ($year-$diffYear);
            $startMonth = self::getOrderMonth($absmonths, 'desc');
            $startDate = $startyear.'-'.$startMonth;
        }
        return self::getContMonths($startDate, $enddate, $type);
    }

    
    public static function getContMonths($startdate, $enddate, $type=0) {
        $result = '';
        if ($startdate == $enddate) {
            $result = $startdate;
        }
        else {
            
            $startArgs = @explode('-', $startdate);
            $startYear = intval($startArgs[0]);
            $startMonth = intval($startArgs[1]);
            
            $endArgs = @explode('-', $enddate);
            $endYear = intval($endArgs[0]);
            $endMonth = intval($endArgs[1]);
            
            for($y=$startYear; $y<=$endYear; $y++) {
                if ($y == $startYear) {$s = $startMonth;} else {$s = 1;}
                if ($y == $endYear) {$e = $endMonth;} else {$e = 12;}
                for ($s; $s<=$e; $s++) {
                    $month = $s;
                    if (strlen($month) == 1) {
                        $month = '0'.$s;
                    }
                    if ($type == 1) {
                        $result .= "'".$y."-".$month."',";
                    }
                    else {
                        $result .= $y.'-'.$month.',';
                    }
                }
            }
            if (!empty($result)) {
                $result = substr($result, 0, (strlen($result)-1));
            }
        }
        return $result;
    }
    
}	
?>
