<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/shop/Public/css/pintuer.css">
<link rel="stylesheet" href="/shop/Public/css/admin.css">
<script src="/shop/Public/js/jquery.js"></script>
<script src="/shop/Public/js/pintuer.js"></script>
</head>
<body>
<form method="post" action="<?php echo U('contentsM');?>" id="listform">
  <input type="hidden" name="search" id="action">
  <input type="hidden" name="did" id="did">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="add.html"> 添加内容</a> </li>
        <li>首页
          <select name="ishome" class="input" style="width:60px; line-height:17px; display:inline-block">
            <option value="1">是</option>
            <option value="0">否</option>
          </select>
          &nbsp;&nbsp;
          推荐
          <select name="isvouch" class="input" style="width:60px; line-height:17px;display:inline-block">
            <option value="1">是</option>
            <option value="0">否</option>
          </select>
          &nbsp;&nbsp;
          置顶
          <select name="istop" class="input" style="width:60px; line-height:17px;display:inline-block">
            <option value="1">是</option>
            <option value="0">否</option>
          </select>
        </li>
        <li>
            <select name="cid" class="input" style="width:150px; line-height:17px;" >
                <option value="0">分类</option>
              <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate[id]); ?>"><?php echo ($cate[title]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li>
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 搜索</a>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">排序</th>
        <th>图片</th>
        <th>名称</th>
        <th>属性</th>
        <th width="10%">更新时间</th>
        <th width="310">操作</th>
      </tr>
      <?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align:left; padding-left:20px;">
          	<input type="checkbox" name="id[]" value="<?php echo ($data[id]); ?>" />
          	<?php echo ($data[id]); ?> 
          </td>
          <td><input type="text" name="sort" value="<?php echo ($data[sort]); ?>" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
          <td width="10%"><img src="/shop/Public/contPictures/<?php echo ($data[img]); ?>" alt="" width="70" height="50" /></td>
          <td><?php echo ($data[title]); ?></td>
          <td>
          	<?php if($data['ishome'] == 1): ?>首页
          		<?php else: endif; ?>
          	&nbsp;
          	<?php if($data['istop'] == 1): ?>置顶
          		<?php else: endif; ?>
          	&nbsp;
          	<?php if($data['isvouch'] == 1): ?>推荐
          		<?php else: endif; ?>
		  </td>
          <td><?php echo ($data[time]); ?></td>
          <td><div class="button-group"><a class="button border-red" href="javascript:void(0)" onclick="return del('<?php echo ($data[id]); ?>')"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <tr>
        <td style="text-align:left; padding:19px 0;padding-left:20px;"><input type="checkbox" id="checkall"/>
          全选 </td>
        <td colspan="7" style="text-align:left;padding-left:20px;"><a href="javascript:void(0)" class="button border-red icon-trash-o" style="padding:5px 15px;" onclick="DelSelect()"> 删除</a>
      </tr>
      <tr>
        <td colspan="8"><div class="pagelist">
          <?php echo ($page); ?>
          </div>
        </td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

//搜索
function changesearch(){
    $("#action").val("search");
    $("#listform").submit();
}

//单个删除
function del(id){
	if(confirm("您确定要删除吗?")){
        $("#action").val("del");
        $("#did").val(id);
        $("#listform").submit();
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;
        $("#action").val("delAll");
		$("#listform").submit();
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}


</script>
</body>
</html>