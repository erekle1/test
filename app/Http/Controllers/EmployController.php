<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employ;
use App\Http\Requests\CreateEmployRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class EmployController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $employees = Employ::paginate(3);
        return view('employ.index', [ 'employees' => $employees ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $companies = Company::all();
        return view('employ.create', [ 'companies' => $companies ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEmployRequest $request
     * @return RedirectResponse
     */
    public function store(CreateEmployRequest $request)
    {

        $payload = $request->all();
        try {
            $employ = Employ::create($payload);
            if ($request->has('image')) {
                $employ->addMedia($request->file('image'))->toMediaCollection('images');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            Session::flash('error', 'Something Went Wrong.');
            return back();
        }
        Session::flash('success', 'Employ Added Successfully.');
        return redirect()->route('employees');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $employ = Employ::findOrFail(getIdFromSlug($slug));
        return view('employ.show', [ 'employ' => $employ ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $employ = Employ::findOrFail(getIdFromSlug($slug));
        $companies = Company::all();
        return view('employ.edit', [ 'employ' => $employ, 'companies' => $companies ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $employ = Employ::findOrFail(getIdFromSlug($slug));
        if ($request->has('image')) {
            $employ->clearMediaCollection();
            $employ->addMedia($request->file('image'))->toMediaCollection('images');
        }
        $payload = $request->all();
        $employ->update($payload);
        Session::flash('success', 'Employ Updated Successfully.');
        return redirect()->route('employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return RedirectResponse
     */
    public function destroy($slug)
    {
        $employ = Employ::findOrFail(getIdFromSlug($slug));
        $employ->delete();
        return back();
    }
}
