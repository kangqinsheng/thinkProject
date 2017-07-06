<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>  
    <link rel="stylesheet" href="/shop/Public/css/pintuer.css">
    <link rel="stylesheet" href="/shop/Public/css/admin.css">
    <script src="/shop/Public/js/jquery.js"></script>
    <script src="/shop/Public/js/pintuer.js"></script>  
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a class="button border-yellow" href="#add"><span class="icon-plus-square-o"></span> 添加内容</a>
  </div> 
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>     
      <th>栏目名称</th>  
      <th>排序</th>     
      <th width="250">操作</th>
    </tr>
   <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($i); ?></td>      
      <td><?php echo ($data[title]); ?></td>  
      <td><?php echo ($data[sort]); ?></td>      
      <td>
      <div class="button-group">
       <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($data[id]); ?>)"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
</div>
<script>
function del(id){
	if(confirm("您确定要删除吗?")){
		location.href="<?php echo U('delColumn');?>?id="+id+"";
	}
}
$(function(){
	$(".button").click(function(){
		$("#isshow").val($(this).find("input").eq(0).val());
	})
})
</script>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
  <a name="add"></a>
    <form method="post" class="form-x" action="<?php echo U('addColumn');?>">   
      <input type="hidden" name="id"  value="" />  
      <div class="form-group">
        <div class="label">
          <label>栏目名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="title" value="" data-validate="required:请输入标题" />         
          <div class="tips"></div>
        </div>
      </div>   
      <div class="form-group">
        <div class="label">
          <label>栏目描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="content" style="height:100px;" ></textarea>        
        </div>
     </div>
    
     <div class="form-group">
        <div class="label">
          <label>显示：</label>
        </div>
        <div class="field">
          <div class="button-group radio">
          <input type="hidden" name="isshow" id="isshow" value="1"/>
          <label class="button active">
         	  <span class="icon icon-check"></span>             
              <input value="1" type="radio" checked="checked">是             
          </label>             
        
          <label class="button"><span class="icon icon-times"></span>          	
              <input value="0"  type="radio">否
          </label>         
           </div>       
        </div>
     </div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="0"  data-validate="required:,number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>