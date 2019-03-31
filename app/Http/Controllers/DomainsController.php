<?php

namespace PageAnalyzer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use PageAnalyzer\Model\Domain;
use PageAnalyzer\Service\DomainDataRetrievingService;

class DomainsController extends BaseController
{
    private $domainDataRetrievingService;

    public function __construct(DomainDataRetrievingService $domainDataRetrievingService)
    {
        $this->domainDataRetrievingService = $domainDataRetrievingService;
    }

    public function showIndex(Request $request)
    {
        $errors = json_decode($request->session()->get('errors'), true) ?? [];

        return view('form', ['name' => 'form', 'errors' => $errors]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['domain' => 'required|url|max:255']);

        if ($validator->fails()) {
            $request->session()->flash('errors', $validator->errors()->toJson());

            return redirect()->route('index');
        }

        $domainName = $request->get('domain');

        $domain = Domain::create(['name' => $domainName]);

        $this->domainDataRetrievingService->fillDomainSeoData($domain);

        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function show(string $id)
    {
        $domain = Domain::findOrFail($id);

        return view(
            'domain',
            [
                'domain' => $domain,
                'download_body_url' => route('domains.download', ['id' => $domain->id]),
            ]
        );
    }

    public function showList()
    {
        $domains = Domain::orderBy('id', 'desc')->paginate(15);

        $params['domains'] = $domains;

        return view('domains', $params);
    }

    public function downloadBody($id)
    {
        $domain = Domain::findOrFail($id);

        return response(
            $domain->body,
            200,
            [
                'Content-Type' => 'text/html',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $domain->name . '.html'),
            ]
        );
    }
}
