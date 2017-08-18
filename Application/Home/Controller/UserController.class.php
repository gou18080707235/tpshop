<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\oAuth;
use Common\Common\SaeTClientV2;
class UserController extends Controller
{
    //用户登陆页面
    public function login()
    {
        if (IS_POST) {
            $name = I('post.username');
            $pwd = I('post.password');
            $pwd = md5($pwd);
            $info = D('User')->where(array('username' => $name, 'password' => $pwd))->find();
            if ($info !== null) {
                //判断用户是否被冻结
                if ($info['flag'] == 2) {
                    $this->assign('errorInfo', '还用户已被冻结，请与管理员联系');
                }else if($info['is_active']=='未激活'){
                    $this->assign('errorInfo','亲，您还没有激活哟');
                } else {
                    session('username', $info['username']);
                    session('user_id', $info['user_id']);
                    $back_url = session('back_url');
                    if (!empty($back_url)) {
                        session('back_url', null);
                        $this->redirect($back_url);
                    }
                    $this->redirect('Index/index');
                }

            } else {
                $this->assign('errorInfo', '用户名或密码错误');
            }
        }
        //dump(sendMsg('18111010506',array('1111','3')));
        $this->display();
    }

    //用户注册页面
    public function regist(){
        //接收数据
        if(IS_POST){
            $code=I('post.code');
            $nowtime=time();
            $data=session('data');
            $codes=$data['code'];
            $nowtimes=$data['nowtime'];
            $limittime=$data['limittime'];
            if(empty($code)){
                $this->assign('errorInfo','验证码不能为空');
            }else if($nowtimes+$limittime>$nowtime){
                $this->assign('errorInfo','验证码过期');
            }else if($code!=$codes){
                $this->assign('errorInfo','验证码错误');
            }else{
                session('data',null);
                $data=I('post.');
                $data['password']=md5($data['password']);
                $data['user_time']=$data['last_time']=time();
                if($new_id=D('User')->add($data)){
                    $address=I('post.address');
                    $active_code=substr(md5($address),-15);
                    $data['user_id']=$new_id;
                    $data['active_code']=$active_code;
                    D('User')->save($data);
                    $url="http://www.tpshop.com/index.php/Home/User/active/user_id/".$new_id."/active_code/".$active_code."";
                    $content="<p>点击以下链接激活账号</p>";
                    $content.="<a href=".$url.">.$url.</a>";
                    sendMail('激活账号', $content, $address);
                    $this->redirect('User/login');
                }else{
                    $this->redirect('regist');
                }
            }
        }
        //sendMail('你好', '天气不错', '353164750@qq.com');
        $this->display();
    }

    //用户退出
    public function logout()
    {
        session(null);
        $this->redirect('User/login');
    }
    //手机验证码
    public function sendCode(){
        if(IS_AJAX){
            //接收数据
            $tel=I('get.user_tel');
            $data['code']=mt_rand(1000,9999);
            $data['limittime']=3;
            $data['nowtime']=time();
            session('data',$data);
            //dump($data);die;
            $z=sendMsg($tel,array($data['code'],$data['limittime']));
            if($z){
                echo json_encode(array('status'=>0));
            }else{
                echo json_encode(array('status'=>1));
            }
        }
    }
    //激活账号
    public function active(){
        //接收数据
        $user_id=I('get.user_id');
        $active_code=I('get.active_code');
        $info=D('User')->where(array('user_id'=>$user_id,'active_code'=>$active_code))->find();
        if($info){
            $data['user_id']=$user_id;
            $data['is_active']='激活';
            $data['active_code']='';
           if(D('User')->save($data)){
               $this->success('账号激活成功',U('User/login'));
           }
        }else{
            $this->error('账号激活失败',U('User/regist'));
        }
    }
    public function wb_login(){
        //vendor('weibo.oAuth');
        $o = new oAuth(C('WB_AKEY'),C('WB_SKEY') );

        $code_url = $o->getAuthorizeURL(C('SITE'));
        //dump($code_url);die;
        $js=<<<eof
         <script type='text/javascript'>
        window.location.href="$code_url";
        </script>
eof;
        echo $js;

    }
    public function wb_backcall(){
        //vendor('weibo.oAuth');
        $o = new oAuth(C('WB_AKEY'),C('WB_SKEY'));
        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = C('SITE');
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;
            } catch (OAuthException $e) {
            }
        }
        //dump($token);die;
        if($token){
            $oAuthResult = new SaeTClientV2(C('WB_AKEY'),C('WB_SKEY'), $token['access_token'] );
            //获取用户uid
            $uid_get = $oAuthResult->get_uid();
            //根据uid获取微博用户信息
            $user_message = $oAuthResult->show_user_by_id($uid_get['uid']);
            //dump($user_message);
            $user=D('User');
            //dump($user_message);die;
            $info=$user->where(array('wb_id'=>$user_message['id']))->find();
            //dump($info);die;
            if($info){
                if($info['username']!=$user_message['name']){
                    $data['wb_id']=$user_message['id'];
                    $data['username']=$user_message['name'];
                    $data['last_time']=time();
                    $user->save($data);
                }
                session('username',$user_message['name']);
                session('user_id',$info['user_id']);
                $this->success('登陆成功',U('Index/index'));
            }else{
                $data['wb_id']=$user_message['id'];
                $data['username']=$user_message['name'];
                $data['user_time']=$data['last_time']=time();
                $data['is_active']='激活';
                $user->add($data);
                session('username',$user_message['name']);
                session('user_id',$info['user_id']);
                //dump(session('username'));die;
                $this->success('登陆成功',U('Index/index'));

            }
        }
    }
}