<?php /* "ngtpl[start]:/tpl/admin/paix.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 09:45:17 */ ?>

 <script>
	 TableOrderOper.Init("paixun", 1, {
            OnShow: function (i, trJqObj, _tbodyObj) {
                trJqObj.attr("class", ((i + 1) % 2 == 0 ? "tr_b" : ""));
            }
        });
      
        TableOrderOper.SetOrder(1);
        TableOrderOper.SetOrder(2 );
 		TableOrderOper.SetOrder(3 );
        TableOrderOper.SetOrder(4);
         TableOrderOper.SetOrder(5);
        TableOrderOper.SetOrder(6);
         TableOrderOper.SetOrder(7);
          TableOrderOper.SetOrder(8);
           TableOrderOper.SetOrder(9);
            TableOrderOper.SetOrder(10); 
            TableOrderOper.SetOrder(11);

</script> 