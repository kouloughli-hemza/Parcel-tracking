<?php

namespace Dsone\Http\Controllers\Web\Clients;

use Dsone\Client;
use Dsone\Http\Requests\Client\CreateClientRequest;
use Dsone\Http\Requests\Client\UpdateClientRequest;
use Dsone\Repositories\Client\ClientRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Dsone\Http\Controllers\Controller;

/**
 * Class ClientsController
 * @package Dsone\Http\Controllers
 */
class ClientsController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $clients;

    /**
     * ActivityController constructor.
     * @param ClientRepository $clients
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    /**
     * Display paginated list of all clients.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $clients = $this->clients->paginate($perPage = 20, $request->search, $request->status);

        return view('client.list', compact('clients'));
    }


    /**
     * Displays Client page.
     *
     * @param Client $client
     * @return Factory|View
     */
    public function show(Client $client)
    {
        return view('client.view', compact('client'));
    }


    /**
     * Displays form for creating a new client.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('client.add');
    }


    /**
     * Stores new client into the database.
     *
     * @param CreateClientRequest $request
     * @return mixed
     */
    public function store(CreateClientRequest $request)
    {

        $this->clients->create($request->all());

        return redirect()->route('clients.index')
            ->withSuccess(__('Client created successfully.'));
    }


    /**
     * Displays edit client form.
     *
     * @param Client $client
     * @return Factory|View
     */
    public function edit(Client $client)
    {
        return view('client.edit', [
            'edit' => true,
            'client' => $client,
        ]);
    }


    /**
     * @param Client $client
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update(Client $client,UpdateClientRequest $request)
    {
        $data = $request->all();


        if (! data_get($data, 'wilaya_id')) {
            $data['wilaya_id'] = $client->wilaya_id;
        }
        if (! data_get($data, 'commune_id')) {
            $data['commune_id'] = $client->commune_id;
        }
        $this->clients->update($client->id,$data);

        return redirect()->back()
            ->withSuccess(__('Client updated successfully.'));
    }



    /**
     * Removes the client from database.
     *
     * @param Client $client
     * @return $this
     */
    public function destroy(Client $client)
    {

        $this->$client->delete($client->id);

        return redirect()->route('clients.index')
            ->withSuccess(__('Client deleted successfully.'));
    }
}
