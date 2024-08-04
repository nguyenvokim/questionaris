<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Battery\CreateBatteryRequest;
use App\Http\Requests\Frontend\Client\CreateClientRequest;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\ClientTestResult;
use App\Models\UserOrg;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $paginator = Client::where([
            ['user_id', '=', \Auth::id()]
        ])->paginate(20);
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
        $client = Client::getUserClientByCode($createClientRequest->get('personal_code'));
        if ($client) {
            $createClientRequest->session()->flashInput($createClientRequest->toArray());
            return redirect(route('frontend.client.createView'))->withErrors(['Personal Code already exits']);
        }
        $createClientArr = $createClientRequest->toArray();
        $createClientArr['user_id'] = \Auth::id();
        $createClientArr['birth_date'] = Carbon::createFromFormat('d-m-Y', $createClientArr['birth_date']);
        $userOrg = UserOrg::whereUserId(\Auth::id())->first();
        $createClientArr['org_id'] = $userOrg->id;
        Client::create($createClientArr);
        return redirect(route('frontend.client.index'))->withFlashSuccess('Client successfully created');
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
        $testCodeClient = Client::getUserClientByCode($createClientRequest->get('personal_code'));
        if ($testCodeClient AND $testCodeClient->id != $client->id) {
            $createClientRequest->session()->flashInput($createClientRequest->toArray());
            return redirect(route('frontend.client.createView'))->withErrors(['Personal Code already exits']);
        }
        $createClientArr = $createClientRequest->toArray();
        $createClientArr['birth_date'] = Carbon::createFromFormat('d-m-Y', $createClientArr['birth_date']);
        $client->update($createClientArr);
        return redirect(route('frontend.client.editView', ['id' => $id]))->withFlashSuccess('Client details successfully updated');
    }
}
