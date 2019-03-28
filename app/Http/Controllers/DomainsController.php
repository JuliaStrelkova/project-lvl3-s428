<?php

namespace PageAnalyzer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class DomainsController extends BaseController
{
    public function showIndex(Request $request)
    {
        $errors = json_decode($request->session()->get('errors'), true) ?? [];
        $request->session()->reflash();

        return view(
            'form',
            [
                'name' => 'form',
                'errors' => $errors,
            ]
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['domain' => 'required|url|max:255']);

        if ($validator->fails()) {
            $request->session()->flash('errors', $validator->errors()->toJson());

            return redirect()->route('index');
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

        return redirect()->route('domains.show', ['id' => $id]);
    }

    public function show(string $id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();
        if (!$domain) {
            return redirect()->route('domains.createForm');
        }

        return view('domain', ['domain' => $domain]);
    }

    public function showList(Request $request)
    {
        $curPage = $request->get('page', 1);
        $domains = DB::table('domains')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view(
            'domains',
            [
                'nextPage' => $curPage + 1,
                'prevPage' => $curPage - 1 < 1 ? 1 : $curPage - 1,
                'domains' => $domains,
            ]
        );
    }
}
