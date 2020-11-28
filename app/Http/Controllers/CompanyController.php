<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CreateCompanyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $companies = Company::paginate(3);
        return view('company.index', [ 'companies' => $companies ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCompanyRequest $request)
    {

        $payload = $request->all();
        try {
            $company = Company::create($payload);
            if ($request->has('logo')) {
                $company->addMedia($request->file('logo'))->toMediaCollection('images');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Something Went Wrong.');
            return back();
        }
        Session::flash('success', 'Company Added Successfully.');
        return redirect()->route('companies');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $company = Company::findOrFail(getIdFromSlug($slug));
        return view('company.show', [ 'company' => $company ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $company = Company::findOrFail(getIdFromSlug($slug));

        return view('company.edit', [ 'company' => $company ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        if ($request->has('logo')) {
            $company->clearMediaCollection();
            $company->addMedia($request->file('logo'))->toMediaCollection('images');
        }
        $payload = $request->all();
        $company->update($payload);
        Session::flash('success', 'Company Updated Successfully.');

        return redirect()->route('companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return RedirectResponse
     */
    public function destroy($slug)
    {
        $company = Company::findOrFail(getIdFromSlug($slug));
        $company->delete();
        return back();
    }
}
