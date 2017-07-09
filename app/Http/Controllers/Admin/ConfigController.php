<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    //    get.admin/config 全部配置项列表
    public function index()
    {
        $data = Config::orderBy('conf_order','asc') -> get();

        foreach ($data as $k => $v)
        {
            switch ($v -> field_type)
            {
                case 'input';
                    $data[$k] -> _html = '<input type="text" class="lg" name="conf_content[]" value="'.$v -> conf_content.'">';
                    break;
                case 'textarea';
                    $data[$k] -> _html = '<textarea type="text" class="lg" name="conf_content[]">'.$v -> conf_content.'</textarea>';
                    break;
                case 'radio';
//                    1|开启,0|关闭
//                    拆分
                    $arr = explode(',',$v -> field_value);
                    $str = '';
                    foreach ($arr as $m => $n)
                    {
//                        循环拆分后的项，再次拆分
                        $r = explode('|',$n);
                        $c = $v -> conf_content == $r[0]?' checked ':'';
                        $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                    }
                    $data[$k] -> _html = $str;
                    break;
            }
        }

        return view('admin.config.index',compact('data'));
    }

    //    排序
    public function changeOrder()
    {
        $input = Input::all();
//        使用js提交过来的link_id值来查找是那条数据
        $config = Config::find($input['conf_id']);
//        改变order值
        $config -> conf_order = $input['conf_order'];
//        更新
        $re = $config -> update();
//        判断更新正确还是错误
        if ($re){
            $data = [
                'status' => 0,
                'msg' => '配置项排序更新成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置项更新失败，请稍后重试',
            ];
        }
        return $data;
    }

    //    index 配置项内容修改
    public function changeContent()
    {
//        接收数据
        $input = Input::all();
        foreach ($input['conf_id'] as $k => $v)
        {
            Config::where('conf_id',$v) -> update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this -> putFile();
        return back() -> with('errors','配置项更新成功!');
    }

//    写入配置文件
    public function putFile()
    {
//        取出数据
        $config = Config::pluck('conf_content','conf_name') -> all();
        $path = base_path().'\config\web.php';
        //        将数组转换为字符串 写入$path文件中
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
    }

    //    get.admin/config/{config} 显示单个配置项信息
    public function show()
    {

    }

    //    get.admin/config/create  添加配置项
    public function create()
    {
        return view('admin.config.add');
    }

    //    post.admin/store  添加配置项提交
    public function store()
    {
//        接收表单提交的数据 除了token值
        if ($input = Input::except('_token'))
        {
            $rules = [
                'conf_name' => 'required',  //配置项名称不能为空
                'conf_title' => 'required', //配置项标题不能为空
            ];
            $message = [
                'conf_name.required' => '配置项名称不能为空',
                'conf_title.required' => '配置项标题不能为空',
            ];
//            验证数据合法性
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证成功
//                添加数据
                if ($re = Config::create($input))
                {
//                    添加数据成功 重定向
                    return redirect('admin/config');
                }else{
//                    添加数据失败
                    return back() -> with('errors','添加数据失败，请稍后再试');
                }
            }else{
//                验证失败
                return back() -> withErrors($validator);
            }
        }else{
//            接收数据失败
            return view('admin.config.create');
        }
    }

    //    get.admin/config/{config}/edit 编辑配置项
    public function edit($conf_id)
    {
        $data = Config::find($conf_id);

        return view('admin/config/edit',compact('data'));
    }

    //    put/patch.admin/config/{config} 更新配置项
    public function update($conf_id)
    {
        //        接收数据
        if ($input = Input::except('_token','_method'))
        {
//            接收数据成功,验证数据
            $rules = [
                'conf_name' => 'required',  //配置项名称不能为空
                'conf_title' => 'required', //配置项地址不能为
            ];
            $message = [
                'conf_name.required' => '配置项名称不能为空',
                'conf_title.required' => '配置项不能为空',
            ];
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证通过,修改数据
                if (Config::where('conf_id',$conf_id) -> update($input))
                {
//                    调用putFile方法来实现配置项的更改
                    $this -> putFile();
//                    修改成功, 重定向网址
                    return redirect('admin/config');
                }else{
//                    修改失败，提示错误
                    return back() -> with('errors','修改数据失败，请稍后再试');
                }
            }else{
//                验证失败
                return back() -> withErrors($validator);
            }
        }else{
//            接收数据失败
            return view('admin/config/edit');
        }
    }

    //    delete.admin/config/{config} 删除单个配置项
    public function destroy($conf_id)
    {
        if (Config::where('conf_id',$conf_id) -> delete())
        {
            $this -> putFile();
//            删除成功
            $data = [
                'status' => 0,
                'msg' => '删除友情链接成功',
            ];
        }else{
//            删除失败
            $data = [
                'status' => 1,
                'msg' => '删除友情链接失败',
            ];
        }
        return $data;
    }


}
