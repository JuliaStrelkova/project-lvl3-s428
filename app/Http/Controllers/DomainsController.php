<?php

namespace PageAnalyzer\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use PageAnalyzer\Model\Domain;

class DomainsController extends BaseController
{
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
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

        $domain = $request->get('domain');

        try {
            $response = $this->httpClient->get($domain);
        } catch (ConnectException $e) {
            $request->session()->flash('errors', json_encode(['Can not resolve domain ' . $domain]));

            return redirect()->route('index');
        }
        $body = $response->getBody()->getContents();
        $contentLengthHeaders = $response->getHeader('Content-Length');

        if (!empty($contentLengthHeaders)) {
            $contentLength = (int) $contentLengthHeaders[0];
        } else {
            $contentLength = mb_strlen($body);
        }

        $domain = Domain::create(
            [
                'name' => $domain,
                'body' => $body,
                'code' => $response->getStatusCode(),
                'content_length' => $contentLength,
            ]
        );

        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function show(string $id)
    {
        $domain = Domain::findOrFail($id)->toArray();
        $domain['body'] = route('domains.download', ['id' => $domain['id']]);

        return view('domain', ['domain' => $domain]);
    }

    public function showList(Request $request)
    {
        $curPage = (int) $request->get('page', 1);

        /** @var LengthAwarePaginator $domains */
        $domains = Domain::orderBy('id', 'desc')->paginate(15);

        $params['domains'] = $domains;

        if ($curPage > 1) {
            $params['prevPage'] = $curPage - 1;
        }

        if ($domains->hasMorePages()) {
            $params['nextPage'] = $curPage + 1;
        }

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
