<?php

namespace App\Http\Controllers;

use App\Models\Aitool;
use App\Models\Category;
use Illuminate\Http\Request;

class AitoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aitools = Aitool::all();
        return view('aitools.index', compact('aitools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('aitools.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $hasFreePlan = $request->has('hasFreePlan');
        if($hasFreePlan){
            $request->merge(['hasFreePlan' => true]);
        }
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'category_id'=>'required|exists:categories,id',
            'description' => 'required|string|min:20',
            'link'=> 'required|url',
            'price'=> 'nullable|numeric',

        ]);
        Aitool::create($request->all());
        return redirect()->route('aitools.index')->with('success', 'Az AI eszköz sikeresen hozzáadva.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aitool = Aitool::find($id);
        return view('aitools.show', compact('aitool'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aitool = Aitool::find($id);
        $categories = Category::all();
        return view('aitools.edit', compact('aitool', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hasFreePlan = $request->has('hasFreePlan');
        if($hasFreePlan){
            $request->merge(['hasFreePlan' => true]);
        }
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'category_id'=>'required|exists:categories,id',
            'description' => 'required|string|min:20',
            'link'=> 'required|url',
            'price'=> 'nullable|numeric',

        ]);

        $aitool = Aitool::find($id);
        $aitool->update($request->all());
        return redirect()->route('aitools.index')->with('success', 'Az AI eszköz sikeresen módosítva.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aitool = Aitool::find($id);
        $aitool->delete();

        return redirect()->route('aitools.index')->with('success', 'Kategória sikeresen törölve!');
    }
}
