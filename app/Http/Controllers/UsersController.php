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
        return view('users.edit',compact('user'));
    }

    /**
     * 更新个人信息
     */
    public function update(UserRequest $request ,ImageUploadHandler $uploader,User $user)
    {
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
