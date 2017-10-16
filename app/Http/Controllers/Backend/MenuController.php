<?php

namespace App\Http\Controllers\Backend;

use App\Models\cms\Menu;
use App\Models\cms\Tree;
use App\Http\Controllers\Controller;
use App\Http\Requests\Form\MenuForm;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(25);

        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tree = Tree::createLevelTree(Menu::all());

        return view('menu.create', compact('tree'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param MenuForm $request
     * 
     * @return mixed
     */
    public function store(MenuForm $request)
    {
        try {
            if (Menu::create($request->all())) {
                return redirect()->back()->withSuccess("新增菜单成功");
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        $tree = Tree::createLevelTree(Menu::all());

        return view('menu.edit', compact('menu', 'tree'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param MenuForm $request
     * @param $id
     * 
     * @return mixed
     */
    public function update(MenuForm $request, $id)
    {
        $data = $request->all();
        unset($data['_method']);
        unset($data['_token']);

        try {
            if (Menu::where('id', $id)->update($data)) {
                return redirect()->back()->withSuccess('编辑菜单成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $childMenus = Menu::where('parent_id', '=', $id)->get()->toArray();

        if ( ! empty($childMenus)) {
            return redirect()->back()->withErrors("请先删除其下级分类");
        }

        try {
            if (Menu::destroy($id)) {
                return redirect()->back()->withSuccess('删除菜单成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
