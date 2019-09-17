<?php
/**
 * 个人中心控制器
 */
namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use DB;


class UsersController extends Controller
{
    public function __construct()
    {
        //用中间件auth判断用户是否登录，except指定除此方法外其他都要登录才能操作
        $this->middleware('auth',['except' => ['show']]);
    }

    /**
     * 显示个人中心
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * 编辑个人资料
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    /**
     * 更新个人信息
     */
    public function update(UserRequest $request ,ImageUploadHandler $uploader,User $user)
    {
        $this->authorize('update',$user);
//        dd($request->all());
        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar,'avatars',$user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success',"个人资料更新成功！");


//          $user->update($request->all());
//        return redirect()->route('users.show',$user->id)->with('success',"个人资料更新成功！");
    }
}
