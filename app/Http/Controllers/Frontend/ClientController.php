<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Battery\CreateBatteryRequest;
use App\Http\Requests\Frontend\Client\CreateClientRequest;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $paginator = Client::paginate(20);
        return view('frontend.clients.index', [
            'paginator' => $paginator
        ]);
    }

    public function createView() {
        return view('frontend.clients.create', [

        ]);
    }

    public function create(CreateClientRequest $createClientRequest) {
        $email = $createClientRequest->get('email');
        $client = Client::getUserClientByEmail($email);
        if ($client) {
            $createClientRequest->session()->flashInput($createClientRequest->toArray());
            return redirect(route('frontend.client.createView'))->withErrors(['Client email already in use']);
        }
        $createClientArr = $createClientRequest->toArray();
        $createClientArr['user_id'] = \Auth::id();
        Client::create($createClientArr);
        return redirect(route('frontend.client.index'))->withFlashSuccess('Create client success');
    }

    public function editView($id) {
        $client = Client::getUserClientById($id);
        if (!$client) {
            return redirect(route('frontend.client.index'));
        }
        return view('frontend.clients.edit', [
            'client' => $client
        ]);
    }
    public function edit($id, CreateClientRequest $createClientRequest) {
        $client = Client::getUserClientById($id);
        if (!$client) {
            return redirect(route('frontend.client.createView'));
        }
        $testedClient = Client::getUserClientByEmail($createClientRequest->get('email'));
        if ($testedClient AND $testedClient->id != $client->id) {
            $createClientRequest->session()->flashInput($createClientRequest->toArray());
            return redirect(route('frontend.client.editView', ['id' => $id]))->withErrors(['Client email already in use']);
        }
        $client->update($createClientRequest->toArray());
        return redirect(route('frontend.client.editView', ['id' => $id]))->withFlashSuccess('Updated client success');
    }
}
