<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;

class PlayersController extends Controller
{
    
    public function index(Request $request)
    {
        //$players = Player::all(); //buscando todos os jogadores

        //$players = Player::orderBy('id', 'DESC')->get();
        //ordem decrescente por id | get(): buscando todos os registros

        $query = $request->query('queryPesquisa', null);

        if ($query)
        {
            //pesquisar
            $players = Player::where('name', 'LIKE', "%" . $query . "%")
                ->orWhere('position', 'LIKE', "%" . $query . "%")
                ->orWhere('country', 'LIKE', "%" . $query . "%")
                ->orderBy('id', 'DESC')
                ->paginate(5)
                ->withQueryString();
                //withQueryString(): mantendo os parâmetros na url e não perdendo o valor de '$query'
        }
        else
        {
            $players = Player::orderBy('id', 'DESC')->paginate(5);
            //ordem decrescente por id | paginate(itens de cada página): paginação
        }

        return view('players.index', ['players' => $players, 'queryPesquisa' => $query]);
        //nome da pasta . nome da rota
        //[passando variável do back-end para o front-end]
    }

    public function create()
    {
        $teams = Team::all(); //importando todos os times

        return view('players.create', ['teams' => $teams]); //passando os dados do back para o front-end
    }

    public function store(StorePlayerRequest $request) //StorePlayerRequest: nossa classe que implementamos as regras dos campos
    {
        Player::create($request->all());

        return redirect(route('players-index'));
    }

    public function edit($id) //variável com mesmo nome do parâmetro passado na rota 'edit'
    {
        $player = Player::where('id', $id)->first();

        //verificando se o jogador existe
        if (!empty($player)) //se a variável '$player' não estiver vazia
        {
            $teams = Team::all();

            return view('players.edit', ['teams' => $teams, 'player' => $player]);
        }
        else
        {
            return redirect(route('players-index'));
        }
    }

    public function update(UpdatePlayerRequest $request, $id) //$id: está vindo da rota
    {
        //conjunto de dados para ser atualizados
        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'number' => $request->number,
            'country' => $request->country,
            'born_at' => $request->born_at,
            'team_id' => $request->team_id,
        ];

        Player::where('id', $id)->update($data); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('players-index'));

    }

    public function destroy($id)
    {
        Player::where('id', $id)->delete(); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('players-index'));
    }

}
