<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use Auth;
use CodeFlix\Forms\UserSettingsForm;
use FormBuilder;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\UserRepository;

class UserSettingsController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit()
    {
        $form = FormBuilder::create(UserSettingsForm::class,[
            'url' => route('admin.user_settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.auth.setting', compact('form'));
    }


    public function update(Request $request)
    {
        $form = \FormBuilder::create(UserSettingsForm::class);

        if (!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, \Auth::user()->id);
        $request->session()->flash('message', 'Senha alterada com sucesso');
        return redirect()->route('admin.user_settings.edit');
    }
}
