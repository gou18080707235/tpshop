<?php
namespace Admim\Model;
use Think\Model;
class MemberLevelModel extends Model{
    protected $patchValidate=true;
    protected $_validate=array(
        array('level_name','require','验证码必须！'),
    );
}