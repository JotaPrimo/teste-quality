<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use App\Models\Dependente;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cadastros = Cadastro::paginate(3);
        return view('listar-cadastros', compact('cadastros'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            self::validarTamanhoImagem($request);
            $nameFile = self::uploadImagem($request);
            $cadastro = new Cadastro();
            $cadastro->fill($request->all());
            $cadastro->size = $request->file_name->getSize();
            $cadastro->file_name = $nameFile;
            $cadastro->save();

            session()->flash('create', 'Cadastrado realizado com sucesso!');
            return redirect('/cadastros');

        } catch (\Exception $exception)
        {
            session()->flash('error-cadastro', 'Erro. Cadastrado não realizado!');
            session()->flash('erro-tamanho-arquivo', 'Verifique o tamanho do arquivo!');
            return redirect()->back();
        }

    }

    public static function validarTamanhoImagem(Request $request)
    {

        if($request->file_name->getSize() > 200000)
        {
           throw new \Exception();
           return redirect()->back();
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cadastro  $cadastro
     * @return \Illuminate\Http\Response
     */
    public static function uploadImagem(Request $request)
    {
        if($request->hasFile('file_name') && $request->file('file_name')->isValid())
        {
            $name = uniqid(time(), true);
            $extension = $request->file_name->extension();
            $nameFile = $name.'.'.$extension;
            $upload =  $request->file_name->storeAs('cadastros', $nameFile);

            if(!$upload)
            {
                return redirect()->back()->with('error', 'Não foi possivel fazer o upload da imagem');
            }

            return $nameFile;

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cadastro  $cadastro
     * @return \Illuminate\Http\Response
     */
    public function edit(Cadastro $cadastro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cadastro  $cadastro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cadastro $cadastro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cadastro  $cadastro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cadastro $cadastro)
    {
        //
    }

    public function desativar($id)
    {
        try {
            $cadastro = (new Cadastro())->find($id);
            $cadastro->status = Cadastro::STATUS_INATIVO;
            $cadastro->save();

            session()->flash('status-alterado-success', 'Status alterado com sucesso!');
            return redirect()->back();

        } catch (\Exception $exception)
        {
            session()->flash('status-alterado-erro', 'Erro. Status não alterado!');
            return redirect()->back();
        }

    }

    public function ativar($id)
    {
        try {
            $cadastro = (new Cadastro())->find($id);
            $cadastro->status = Cadastro::STATUS_ATIVO;
            $cadastro->save();

            session()->flash('status-alterado-success', 'Status alterado com sucesso!');
            return redirect()->back();

        } catch (\Exception $exception)
        {
            session()->flash('status-alterado-erro', 'Erro. Status não alterado!');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        Cadastro::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Cadastros deletados com sucesso"]);
    }

    public function adicionarDependente(Request $request)
    {

        try {
            self::validarIdadeDepente($request->dt_nascimento);
            $cadastro = Cadastro::find($request->id);
            $dependente = new Dependente();
            $dependente->fill($request->all());
            $dependente->cadastro_id = $cadastro->id;
            $dependente->save();

            $cadastro->dependentes()->attach($cadastro->id, ['cadastro_id' => $cadastro->id,'dependente_id' => $dependente->id] );


            session()->flash('dependente-create-success', 'Dependente cadastrado com sucesso!');
            return redirect('/cadastros');

        }catch (\Exception $exception)
        {
            session()->flash('dependente-create-erro', 'Erro. Dependente não foi cadastrado!');
            return redirect()->back();
        }

    }

    public function listarDependente($id)
    {
        $cadastro = Cadastro::find($id);
        return view('dependentes', compact('cadastro'));
    }

    public static function validarIdadeDepente($data)
    {
        // preciso aprender Carbon
        $data = new \DateTime($data);
        $intervalo = $data->diff(new \DateTime(date('Y-m-d')));
        $idade = (int) $intervalo->format('%Y');

        if($idade > 120)
        {
            session()->flash('idade-invalida', 'Erro. Dependente não pode ter idade superior á 120 ano!');
            throw new \Exception();
        }
    }

    public function removerDependente(Request $request)
    {

        try {

            $depente = Dependente::find($request->dependente_id);
            $cadastro = Cadastro::find($request->cadastro_id);
            $cadastro->dependentes()->detach($cadastro->id, ['cadastro_id' => $cadastro->id,'dependente_id' => $depente->id] );
            $depente->delete();

            session()->flash('dependente-deletado-success', 'Dependente removido com sucesso!');
            return redirect('/cadastros');

        }catch (\Exception $exception)
        {
            session()->flash('dependente-deletado-erro', 'Erro. Dependente não foi removido!');
            return redirect()->back();
        }
    }


}
