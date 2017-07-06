<?php
namespace Home\Controller;

use Think\Controller;
class UserController extends Controller
{
    public function login(){
        if(session("username")){
            if(session("lev")!=1){
                $this->assign("user",session("username"));
                $this->display("home");
            }else{
                header("location:../../Admin/User/home");
            }
        }else{
            if($_POST["username"]){
                $name = $_POST["username"];
                $pass = $_POST["password"];
                $code = $_POST['code'];
                $Verify = new \Think\Verify();
                $yan = $Verify->check($code,$id='');
                if($yan){
                    $model=M("user");
                    $hasN = $model->where("username='{$name}'")->getField("username");
                    if($hasN["username"]){
                        $hasP = $model->where("username='{$name}' and password='{$pass}'")->getField("username");
                        if($hasP["username"]){
                            session("username",$name);
                            $this->assign("user",session("username"));
                            $lev = $model->where("username='{$name}'")->getField("level");
                            if($lev["level"]==0){
                                session("lev",1);
                                $this->display("home");
                            }else{
                                header("location:../../Admin/User/home");
                            }
                        }else{
                            $this->assign("massage","密码错误");
                            $this->display();
                        }
                    }else{
                        $this->assign("massage","用户名不存在");
                        $this->display();
                    }
                }else{
                    session_start();
                    $this->assign("massage",$yan);
                    $this->display();
                }
            }else{
                $this->display();
            }
        }
    }
    public function logout(){
        session("username",null);
        $this->display("login");
    }
    public function register(){
        if($_POST["username"]){
            $name = $_POST["username"];
            $pass = $_POST["password"];
            if($name=="Admin"){
                $level=1;
            }else{
                $level=0;
            }
            $model = M("user");
            $in = $model->where("username='{$name}'")->getField("password");
            if(!$in["password"]){
                $res = $model->add(array("username"=>$name,"password"=>$pass,"level"=>$level));
                if($res){
                    $this->assign("massage","注册成功");
                }else{
                    $this->assign("massage","注册失败");
                }
            }else{
                $this->assign("massage","用户名已存在");
            }
            $this->display();
        }else{
            $this->display();
        }
    }
    public function home(){
        if(session("?username")){
            $this->assign("user",session("username"));
            $model = M("slider");
            $imgs = $model->field("name,img")->limit(3)->select();
            $this->assign("images",$imgs);
            $this->display();
        }else{
            $this->display("login");
        }
    }
    public function codes(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length = 4;
        $Verify->codeSet = "123456789";
        $Verify->entry();
    }
}

?>