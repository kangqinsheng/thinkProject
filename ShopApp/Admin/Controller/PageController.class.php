<?php
namespace Admin\Controller;
use Think\Controller;
class PageController extends Controller
{
    public function slider(){
        if(isset($_SESSION["username"])){
            $model = M("slider");
            $res = $model->select();
            $this->assign("slider",$res);
            $this->display();
        }else{
            $this->error("登录超时");
        }
        
    }
    /**
     * 添加图片
     * @param 上传保存文件名 $file
     */
    public function addImg($file){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->autoSub = false;
        $upload->rootPath = './Public/'; // 设置附件上传根目录(项目根目录，需要手动创建)
        $upload->savePath = "{$file}/"; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if(!$info) {
            // 上传错误提示错误信息
            $this->error($upload->getError());
        }else{
            $upload1 = new \Think\Upload();
            // 上传成功
            return $info["img"]["savename"];
        }
    }
    /*
     *添加首页轮播图
     */
    public function addSlider(){
        $model=M('slider');
        $_POST['img'] = $this->addImg('slider');
        $res = $model->add($_POST);
        if($res){
            $this->success("添加成功","slider");
        }else {
            $this->error("添加失败","slider");
        }
    }
    /**
     * 删除首页轮播图
     * 
     */
    public function deletSlider(){
        $id = $_GET["id"];
        $url = $_GET["url"];
        $path = PATH."/Public/slider/".$url;
        unlink($path);
        $model = M("slider");
        $res = $model->where("id={$id}")->delete();
        if($res){
            $this->success("删除成功");
        }else {
            $this->error("删除失败");
        }
    }
    /**
     * 单页管理
     */
    public function page(){
        if(isset($_SESSION["username"])){
            $this->display();
        }else{
            $this->error("登录超时");
        }
    }
    
    /**
     * 单页添加内容
     * 
     */
    public function addContent() {
        if(IS_POST){
            $_POST['img']=$this->addImg('page');
            $model = M("page");
            $res = $model->add($_POST);
            if($res){
                $this->success("添加成功");
            }else {
                $this->error("添加失败");
            }
        }
    }
    /**
     * 栏目管理
     * 
     */
    public function column(){
        if(isset($_SESSION["username"])){
            $model=M("column");
            $data = $model->select();
            $this->assign("data",$data);
            $this->display();
        }else{
            $this->error("登录超时");
        }
    }
    /**
     * 添加栏位
     */
    public function addColumn(){
        if(IS_POST){
            $model=M("column");
            $res = $model->add($_POST);
            if($res){
                $this->success("发表成功");
            }else{
                $this->error("发表失败");
            }
        }
    }
    /**
     * 删除栏位
     */
    public function delColumn(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $model=M("column");
            $res = $model->where("id={$id}")->delete();
            if(res){
                $this->success("删除成功");
            }else{
                $this->error("删除失败");
            }
        }
    }
    /**
     * 分类管理
     */
    public function cate(){
        if(isset($_SESSION["username"])){
            $model=M("cate");
            $sql = "select a.id as id,a.title as title,b.title as p_title,a.sort as sort,b.id as p_id from `cate` a left join `cate` b on a.p_id=b.id order by b.sort desc";
            $data = $model->query($sql);
            $father=$model->field("id,title")->where("p_id=0")->select();
            $this->assign("select",$father);
            $this->assign("data",$data);
            $this->display();
        }else{
            $this->error("登录超时");
        }
    }
    /**
     * 添加分类
     * 
     */
    public function addCate(){
        if(IS_POST){
            $model = M("cate");
            $res = $model->add($_POST);
            if($res){
                $this->success("'添加成功");
            }else {
                $this->error("添加失败");
            }
        }
    }
    /**
     * 删除分类
     */
    
    public function delCate(){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $model = M("cate");
            $son = $model->where("p_id={$id}")->select();
            if(count($son)>0){
                $this->error("删除失败，必须先删除二级标签");
                die();
            }else {
                $res = $model->where("id={$id}")->delete();
                if($res){
                   $this->success("删除成功"); 
                }else{
                    $this->error("网路繁忙，请稍后重试");
                }
            }  
        }
    }
    /**
     * 添加内容
     */
    public function add(){
        if(isset($_SESSION["username"])){
                $model=M("cate");
                $data = $model->select();
                $this->assign("cates",$data);
                $this->display();
        }else{
            $this->error("登录超时");
        }
    }
    /**
     * 添加内容程序
     */
    public function addCont(){
        if(IS_POST){
            $model = M('contents');
            $img = $this->addImg('contPictures');
            $_POST['img'] = $img;
            $res = $model->add($_POST);
            if($res){
                $this->success("添加成功");
            }else{
                $this->error("网路繁忙，请稍后重试");
            }
        }
    }

    /**
     * 分页方法
     */
    public function getPage($table){
        //数据分页
        $User = $table; // 实例化User对象
        $count = $User->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(3)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $User->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('datas',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
    }

    /**
     * 内容管理
     */
    public function contentsM(){
        if(isset($_SESSION["username"])){
            $model=M("cate");
            $cates = $model->select();
            if(I("post.search")){
                $istop = I("post.istop");
                $ishome = I("post.ishome");
                $isvouch = I("post.isvouch");
                $cid = I("post.cid");
                $ids = I("post.id");
                $did = I("post.did");
                $tt = join(",",$ids);
                switch (I("post.search")) {
                    case "search":
                        $data = $model->table("contents")->where("istop={$istop} and ishome={$ishome} and isvouch={$isvouch} and cid={$cid}")->select();
                        $this->assign("datas",$data);
                        break;
                    case "del":$model->table("contents")->delete($did);$data=$model->table("contents")->select();break;
                    case "delAll":
                        $model->table("contents")->delete($tt);
                        $this->getPage(M("contents"));
                        ;break;
                }
            }else{
                $this->getPage(M("contents"));
            }
            $this->assign("cates",$cates);
            $this->display();
        }else{
            $this->error("登录超时");
        }
    }
}