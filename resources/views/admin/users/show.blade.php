@extends('layouts.admin')

@section('content')
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <h3>Ver usuário</h3>
        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('admin.users.edit',['user'=>$user->id])) !!}
        <?php $iconDestroy = Icon::create('remove'); ?>
        {!! Button::danger($iconDestroy)
            ->asLinkTo(route('admin.users.destroy',['user'=>$user->id]))
            ->addAttributes(['onClick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
         !!}
        <?php $formDelete = FormBuilder::plain([
            'id'=>'form-delete',
            'route'=>['admin.users.destroy','user' =>$user->id],
            'method'=>'DELETE',
                'style' => 'display:none'
            ]) ?>
        {!! form($formDelete) !!}
        <br><br>
        <table class="table table-bordered">
               <tbody>
               <tr>
                   <th scope="row">#</th>
                   <td>{{$user->id}}</td>
               </tr>
               <tr>
                   <th scope="row">Nome</th>
                   <td>{{$user->name}}</td>
               </tr>
               <tr>
                   <th scope="row">E-mail</th>
                   <td>{{$user->email}}</td>
               </tr>
               </tbody>
        </table>

    </div>
</div>
@endsection
