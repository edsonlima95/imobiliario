<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AuthController extends Controller
{

    public function home()
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login.create');
        }

        //USUARIOS
        $lessors = User::lessors()->count();
        $lessees = User::lessees()->count();
        $admins = User::admins()->count();

        //IMÓVEIS
        $available = Property::available()->count();
        $unavailable = Property::unavailable()->count();
        $propertyAll = Property::all()->count();

        //CONTRATOS
        $pending = Contract::pending()->count();
        $active = Contract::active()->count();
        $canceled = Contract::canceled()->count();
        $contractAll = Contract::all()->count();
        $contracts = Contract::all();

        return view('admin.home', [
            'lessors' => $lessors,
            'lessees' => $lessees,
            'admins' => $admins,
            'available' => $available,
            'unavailable' => $unavailable,
            'propertyAll' => $propertyAll,
            'pending' => $pending,
            'active' => $active,
            'canceled' => $canceled,
            'contractAll' => $contractAll,
            'contracts' => $contracts
        ]);
    }

    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (!Auth::attempt($credentials)) {
            $error = $this->message->error('Usuário ou Senha incorretos, verifique os dados e tente novamente!')->render();
            return view('admin.login', ['message' => $error]);
        }
        $this->authenticated($request->getClientIp());
        return redirect()->route('admin.home');
    }

    private function authenticated($ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.create');
    }
}
