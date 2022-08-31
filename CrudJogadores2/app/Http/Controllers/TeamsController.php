<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Requests\StoreTeamsRequest;
use App\Http\Requests\UpdateTeamsRequest;

class TeamsController extends Controller
{
    
    public function index(Request $request)
    {
        //$teams = Team::all(); //all(): busca todos os times no banco de dados e retorna para a variável '$teams'

        //dd($teams); //exibindo valor que recebo em 'teams'

        //$teams = Team::where('country', '=', 'Alemanha')->get();
        //where: buscando times da alemanha | get(): busca todos

        //$teams = Team::find($id); //find(): busca direto pelo 'id'

        //$nome = 'Lucas Yurie'; //passando variável do back-end para o front-end
        //return view('teams.index', ['nome' => $nome]); //nome da pasta . nome da view



        //$teams = Team::all(); //buscando todos os times

        //$teams = Team::orderBy('id', 'DESC')->get(); 
        //ordem decrescente por id | get(): buscando todos os registros

        $query = $request->query('queryPesquisa', null); //queryPesquisa: nome do input no index

        if ($query)
        {
            //pesquisar
            $teams = Team::where('name', 'LIKE', "%" . $query . "%")
                ->orWhere('country', 'LIKE', "%" . $query . "%") //pesquisando por país também
                ->orderBy('id', 'DESC')
                ->paginate(5)
                ->withQueryString();
                //withQueryString(): mantendo os parâmetros na url e não perdendo o valor de '$query'
        }
        else
        {
            $teams = Team::orderBy('id', 'DESC')->paginate(5);
            //ordem decrescente por id | paginate(itens de cada página): paginação
        }

        return view('teams.index', ['teams' => $teams, 'queryPesquisa' => $query]); 
        //nome da pasta . nome da rota
        //[passando variável do back-end para o front-end]
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(StoreTeamsRequest $request) //StoreTeamsRequest: nossa classe que implementamos as regras dos campos
    {
        //dd($request->all());

        Team::create($request->all());

        return redirect(route('teams-index'));

    }

    public function edit($id) //variável com mesmo nome do parâmetro passado na rota 'edit'
    {
        $team = Team::find($id); //find(): busca direto pelo 'id'

        if (empty($team))
        {
            return redirect(route('teams-index'));
        }
        else
        {
            return view('teams.edit', ['team' => $team]); //nome da pasta . nome da rota | [passando variável do back-end para o front-end]
        }

        

    }

    public function update(UpdateTeamsRequest $request, $id) //$id: id da rota
    {
        //dd($request, $id);
        
        //conjunto de dados para ser atualizados
        $data = [
            'name' => $request->name,
            'country' => $request->country,
            'foundation_year' => $request->foundation_year,
        ];

        Team::where('id', $id)->update($data); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('teams-index'));

    }

    public function destroy($id)
    {
        Team::where('id', $id)->delete(); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('teams-index'));
    }

}
