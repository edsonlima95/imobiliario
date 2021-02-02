<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User as UserRequest;
use App\Models\User;
use App\Support\Cropper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function team()
    {
        $users = User::where('admin', 1)->get();
        return view('admin.users.team', [
            'users' => $users
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('client', 1)->get();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $userCreate = User::create($request->all());

        if($userCreate->client == null && $userCreate->admin == null){
            $userCreate->all()['client'] = 1;
            $userCreate->all()['admin'] = 0;
            $userCreate->save();
        }

        if (!empty($request->file('cover'))) {
            $userCreate->cover = $request->file('cover')->store('user');
            $userCreate->save();
        }

        if ($userCreate) {
            return redirect()->route('admin.users.edit', ['user' => $userCreate->id])
                ->with(['color' => 'success', 'message' => 'O cliente foi cadastrado com sucesso']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $userUpdate = User::find($id);

        $userUpdate->setLessorAttribute($request->lessor);
        $userUpdate->setLesseeAttribute($request->lessee);
        $userUpdate->setAdminAttribute($request->admin);
        $userUpdate->setClientAttribute($request->client);

        //Apaga a imagem se existir antes de salvar a nova.
        if (!empty($request->file('cover'))) {
            Storage::delete($userUpdate->cover);
            Cropper::flush($userUpdate->cover);
            $userUpdate->cover = '';
        }

        $userUpdate->fill($request->all());

        if (!empty($request->file('cover'))) {
            $userUpdate->cover = $request->file('cover')->store('user');
        }

        if (!$userUpdate->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.users.edit', [
            'user' => $userUpdate->id])->with(['color' => 'success', 'message' => 'Usuário atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
