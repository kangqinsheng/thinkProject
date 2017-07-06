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
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" enctype="multipart/form-data" action="<?php echo U('addCont');?>">  
      <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="file" id="url1" name="img" class="input tips" style="width:25%; float:left;"/>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>描述：</label>
        </div>
        <div class="field">
          <textarea class="input" name="note" style=" height:90px;"></textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <textarea name="content" class="input" style="height:450px; border:1px solid #ddd;"></textarea>
          <div class="tips"></div>
        </div>
      </div>
     
      <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>内容关键字：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="s_keywords" value=""/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>关键字描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="s_desc" style="height:80px;"></textarea>
        </div>
      </div>
 
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="0"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="authour" value=""  />
          <div class="tips"></div>
        </div>
      </div>
      <div class="padding">
	      <ul class="search" style="padding-left:10px;">
	        <li>首页
	          <select name="ishome" class="input" onchange="changesearch()" style="width:60px; line-height:17px; display:inline-block">
	            <option value="0">选择</option>
	            <option value="1">是</option>
	            <option value="0">否</option>
	          </select>
	          &nbsp;&nbsp;
	          推荐
	          <select name="isvouch" class="input" onchange="changesearch()"  style="width:60px; line-height:17px;display:inline-block">
	            <option value="0">选择</option>
	            <option value="1">是</option>
	            <option value="0">否</option>
	          </select>
	          &nbsp;&nbsp;
	          置顶
	          <select name="istop" class="input" onchange="changesearch()"  style="width:60px; line-height:17px;display:inline-block">
	            <option value="0">选择</option>
	            <option value="1">是</option>
	            <option value="0">否</option>
	          </select>
	          </li>
	          <li>
	            <select name="cid" class="input" style="width:200px; line-height:17px;" onchange="changesearch()">
	              <option value="0">请选择分类</option>
	              <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate[id]); ?>"><?php echo ($cate[title]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	            </select>
	          </li>
	      </ul>
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