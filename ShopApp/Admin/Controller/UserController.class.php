<?php
namespace Admin\Controller;

use Think\Controller;
class UserController extends Controller
{
    public function logout(){
        session("username",null);
        R("Home/User/login");
    }
    public function home(){
        if(isset($_SESSION["username"])){
            $this->assign("user",session("username"));
            $this->display();
        }else{
            R("Home/User/login");
        }
    }
    public function addImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->autoSub = false;
        $upload->rootPath = './Public/'; // 设置附件上传根目录(项目根目录，需要手动创建)
        $upload->savePath = 'photo/'; // 设置附件上传（子）目录
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
    /**
     * 进入info页面执行查询回显
     */
    public function info(){
        $model=M('info');
        $info = $model->order("id desc")->limit(1)->select();
        $this->assign("data",$info[0]);
        $this->display();
    }
    public function addinfo(){
        $model=M('info');
        $_POST['img'] = $this->addImg();
        $res = $model->add($_POST);
        if($res){
            $this->success("修改成功","info");
        }else {
            $this->error("修改失败","info");
        }
    }
    /**
     * 进入修改密码页面
     */
    public function pass(){
        $user = session("username");
        $this->assign("user",$user);
        $this->display();
    }
    
    /**
     * 验证密码修改逻辑
     */
    public function updataPass(){
        $name = session("username");
        $model=M("user");
        $res = $model->where("username='{$name}'")->getField("password");
        if($res==$_POST["mpass"]){
            $data = array('password'=>$_POST["newpass"]);
            $res1 = $model->where("username='{$name}'")->save($data);
            if($res1){
                $this->success("修改成功");
            }else{
                $this->success("网络出错，请稍后重试");
            }
        }else{
            $this->assign("massage","原密码错误");
            $this->display("pass");
        }
    }
}

?>