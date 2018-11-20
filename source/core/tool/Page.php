<?php


namespace ng169\tool;
use ng169\tool\Filter as YFilter;
checktop();
class Page{
    
    public static function admin($num, $perpage, $curr_page, $mpurl, $maxpage){
    	/*$num=100000;*/
        $mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';
           
        $fh='=';
        $mpurl=YFilter::filterXSS($mpurl);
       
        if ($num > $perpage) {
            $page    = $maxpage;
            $offset  = floor($page * 0.5);
            $pages   = @ceil($num/$perpage);
            $from    = $curr_page -$offset;
            $to      = $curr_page + $page - $offset - 1;
            if ($page > $pages){
                $from = 1;
                $to   = $pages;
            }
            else {
                if ($from<1) {
                    $to   = $curr_page + 1 - $from;
                    $from = 1;
                    if (($to - $from) < $page && ($to - $from) < $pages) {
                        $to = $page;
                    }
                }
                elseif ($to>$pages){
                    $from = $curr_page - $pages + $to;
                    $to   = $pages;
                    if (($to - $from) < $page && ($to - $from) < $pages) {
                        $from = $pages - $page + 1;
                    }
                }
            }
            
            
            
            
            #页数>1执行
            if ($pages > 1) {
                #分页 [1][2][3]...
                $block_step_size = '';
                for ($i=$from; $i<=$to; $i++) {
                    if ($i!=$curr_page) {
                        $block_step_size .= "<a href='{$mpurl}page{$fh}{$i}'>{$i}</a>&nbsp;";
                    }
                    else{
                        $block_step_size .= "<b>{$i}</b>&nbsp;";
                    }
                }
                #上一页
                $block_pre = '';
                if ($curr_page > 1) {
                    $pre_page = $curr_page-1;
                    if ($pre_page < 2) {$pre_page = 1;}
                    $block_pre = "<a href='{$mpurl}page{$fh}1' class='p_first' />&nbsp;</a>&nbsp;".
                        "<a href='{$mpurl}page{$fh}{$pre_page}' class='p_pre' />&nbsp;</a>&nbsp;";
                }
                #下一页
                $block_next = '';
                if ($pages > 1 && $curr_page < $pages) {
                    $next_page = $curr_page+1;
                    if ($next_page >=$pages) {$next_page = $pages;}
                    $block_next = "<a href='{$mpurl}page{$fh}{$next_page}' class='p_next' />&nbsp;</a>&nbsp;".
                        "<a href='{$mpurl}page{$fh}{$pages}' class='p_last' />&nbsp;</a>&nbsp;";
                }
            }
           $block_sl='';
            if($pages>$maxpage*2 && $curr_page<90){
				 $block_sl = "<a href='###' class='p_slh' />...</a>&nbsp;".
                        "<a href='{$mpurl}page{$fh}100' class='p_100' />100</a>&nbsp;";
			}
			$show_page='';
            #showpage
//            $show_page = "<span>记录：{$num}&nbsp;&nbsp;页次：{$curr_page}/{$pages}&nbsp;&nbsp;&nbsp;</span>";
            //$show_page = "<span>记录：{$num}&nbsp;&nbsp;页次：{$curr_page}/{$pages}&nbsp;&nbsp;&nbsp;</span>";
            $show_page .= $block_pre.$block_step_size.$block_sl.$block_next;
            if ($pages > 1) {
                $show_page .= "<span>&nbsp;跳转：<input style='width:24px!important;text-align:center'   type='text' id='inputpage' name='page' onkeypress=\"if(event.keyCode==13) window.location.href='".$mpurl."page{$fh}'+value\" value='{$curr_page}' />&nbsp;页</span>";
            }
        }
        else {
          //  $show_page = "<span>记录：{$num}&nbsp;&nbsp;</span>";
        }
        if(isset($show_page))
        return $show_page;
        return false;
    }


}
?>
