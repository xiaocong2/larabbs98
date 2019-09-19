<?php
/**
 * 分类话题控制器
 */
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * 根据话题分类显示不同的列表
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category,Request $request, Topic $topic)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = $topic->withOrder($request->order)->where('category_id',$category->id)->paginate(20);
//        $topics = Topic::where('category_id',$category->id)->paginate(20);

        return view('topics.index',compact('topics','category'));
    }
}
