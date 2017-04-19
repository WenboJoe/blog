<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];
    public $timestamps=false;

/*//    获取无限极分类
    public function getTree()
    {
//        取出分类信息
        $data = $this -> all();
//        调取_getTree方法制作无限极分类
        return $this -> _getTree($data);
    }
//    无限极分类
    public function _getTree($data,$parent_id = 0,$level = 0)
    {
        static $_ret = [];
        foreach ($data as $k => $v)
        {
            if ($v->cate_pid == $parent_id)
            {
//                标记分类级别
                $v['level'] = $level;
                $_ret[] = $v;
//                检查分类中是否还有子分类
                $this -> _getTree($data,$v->cate_id,$level+1);
            }
        }
        return $_ret;
    }*/

    public function tree()
    {
        $category = $this -> orderBy('cate_order','asc') -> get();
        return $this -> getTree($category,'cate_name','cate_id','cate_pid');
    }

    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $att = [];
        foreach ($data as $k => $v) {
            if ($v->$field_pid == $pid) {
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m => $n) {
                    if ($n->$field_pid == $v->$field_id) {
                        $data[$m]["_".$field_name] = "├─ " . $data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }


}
