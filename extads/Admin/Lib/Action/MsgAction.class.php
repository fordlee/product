<?php
// 本类由系统自动生成，仅供测试用途
class MsgAction extends Action {
    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rule'] == 'admin') {
            $ret = true;
        }
        return $ret;
    }

    public function index() {
        if ($this -> _checklogin()) {
            $m = M('Msg');
            $ret = $m -> where(array('isactive' => 1)) -> order('id desc') -> limit(30) -> select();
            $this -> assign('ret', $ret);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function add() {
        if ($this -> _checklogin()) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $href = $_POST['href'];
                $content = $_POST['content'];
                $type = $_POST['type'];
                $m = M('Msg');
                $item = array(
                    "title" => $title,
                    "href" => $href,
                    "content" => $content,
                    "type" => $type,
                    "addtime" => date('Y-m-d H:m:s')
                );
                $ret = false;
                if (empty($id)) {
                    $ret = $m -> add($item);
                    if ($ret > 0) {
                        $this -> _addUserMsg($ret);
                    }
                } else {
                    $item['id'] = $id;
                    $ret = $m -> save($item);
                }
                if ($ret > 0) {
                    $this -> success('成功！');
                } else {
                    $this -> error('失败！');
                }
            } else if (isset($_GET['id'])) {
                //edit
                $id = $_GET['id'];
                $where = array(
                    "id" => $id
                );
                $m = M('Msg');
                $item = $m -> where($where) -> find();
                $this -> assign('item', $item);
                $this -> assign('btn', "修改");
                $this -> display();
            } else {
                $this -> assign('btn', "添加");
                $this -> display();
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _addUserMsg($mid) {
        $m = M('user');
        $where = array(
            "isactive" => 1
        );
        $users = $m -> where($where) -> select();
        if (count($users) > 0) {
            $um = M('usermsg');
            for ($i = 0; $i < count($users); $i++) {
                $ret = $um -> add(array(
                    "uid" => $users[$i]['uid'],
                    "mid" => $mid
                ));
            }
        }
    }

    public function detail() {
        if ($this -> _checklogin()) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $where = array(
                    "id" => $id
                );
                $m = M('Msg');
                $item = $m -> where($where) -> find();
                $this -> assign('item', $item);
            }
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function msgdel() {
        if ($this -> _checklogin()) {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $m = M('Msg');
                $item = array(
                    "id" => $id,
                    "isactive" => 0
                );
                $ret = $m -> save($item);
                if ($ret == false) {
                    echo "删除失败！";
                } else {
                    echo 1;
                }
            } else {
                echo "参数有误！";
            }
        } else {
            echo 0;
        }
    }
}