<?php /* "/tpl/admin/paix.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 20:08:00 �й���׼ʱ�� */ ?>

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