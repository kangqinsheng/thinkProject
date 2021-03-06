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
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">
    <button type="button" class="button border-yellow" onclick="window.location.href='#add'"><span class="icon-plus-square-o"></span> 添加分类</button>
  </div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">编号</th>
      <th width="10%">分类等级</th>
      <th width="10%">分类名称</th>
      <th width="10%">父级名称</th>
      <th width="10%">排序</th>
      <th width="10%">操作</th>
    </tr>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($i); ?></td>
      <td>
      	<?php if($data[p_id] == 0): ?>一级
      		<?php else: ?>
      		二级<?php endif; ?>
      </td>
      <td><?php echo ($data[title]); ?></td>
      <td><?php echo ($data[p_title]); ?></td>
      <td>
      	<?php echo ($data[sort]); ?>
      </td>
      <td><div class="button-group"><a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($data[id]); ?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
</div>
<script type="text/javascript">
function del(id){
	if(confirm("您确定要删除吗?")){			
		location.href="<?php echo U(delCate);?>?id="+id+"";
	}
}
</script>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('addCate');?>">
      <div class="form-group">
        <div class="label">
          <label>上级分类：</label>
        </div>
        <div class="field">
          <select name="p_id" class="input w50">
            <option value="0">请选择分类</option>
            <?php if(is_array($select)): $i = 0; $__LIST__ = $select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sel): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sel[id]); ?>"><?php echo ($sel[title]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
          <div class="tips">不选择上级分类默认为一级分类</div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>分类标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="title" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>分类描述：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="content"/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="1"  data-validate="number:排序必须为数字" />
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
</body>
</html>