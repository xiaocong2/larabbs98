<?php
/**
 * 个人中心控制器
 */
namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;


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
    public function update(UserRequest $request ,User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show',$user->id)->with('success',"个人资料更新成功！");
    }
}
