<?php

namespace PageAnalyzer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class AppController extends BaseController
{
    public function showIndex()
    {
        return redirect(route('domains.createForm'), Response::HTTP_MOVED_PERMANENTLY);
    }

    public function showCreateForm
()
    {
        return view('layouts.form', ['name' => 'form']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['domain' => 'required|max:255']);
        if ($validator->fails()) {
            return view('layouts.form', ['errors' => $validator->errors()->all()]);
        }

        $domain = $request->get('domain');

        $id = DB::table('domains')
            ->insertGetId(
                [
                    'name' => $domain,
                    'created_at' => (new \DateTimeImmutable())->format(DATE_ATOM),
                    'updated_at' => (new \DateTimeImmutable())->format(DATE_ATOM),
                ]
            );

        //return redirect('/domains/' . $id);

        return redirect()->route('domains.show',['id'=> $id]);
    }

    public function show(string $id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();
        if (!$domain) {
            return redirect()->route('domains.createForm');
        }

        return view(
            'layouts.domain',
            [
                'id' => $domain->id,
                'name' => $domain->name,
                'createdAt' => $domain->created_at,
                'updatedAt' => $domain->updated_at
            ]
        );
    }
}
