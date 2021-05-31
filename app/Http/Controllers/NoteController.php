<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    private $array = ['error'=>'', 'result'=>[]];

    //pesquisa todos
    public function all() {
        $notes = Note::all();

        foreach($notes as $note) {
            $this->array['result'][] = [
                'id' => $note->id,
                'title' => $note->title
            ];
        }
        return $this->array;
    }

    //pesquisa por id
    public function one($id) {
        $note = Note::find($id);

        if($note) {
            $this->array['result'] = $note;
        } else {
            $this->array['error'] = 'ID não encontrado';
        }
        return $this->array;
    }

    public function new(Request $request) {
        //pego os campos
        $title = $request->input('title');
        $body = $request->input('body');

        //verifico se eles estão preenchidos
        if($title && $body) {
            //add no db
            $note = new Note();
            $note->title = $title;
            $note->body = $body;
            $note->save();

            $this->array['result'] = [
                'id' => $note->id,
                'title' => $title,
                'body' => $body
            ];

        } else {
            $this->array['error'] = 'Campos não enviados';
        }
        return $this->array;
    }

    public function edit(Request $request, $id) {
        //pego o title e o body enviados pelo corpo da requisição
        $title = $request->input('title');
        $body = $request->input('body');

        //verifico se ambos foram enviados
        if($id && $title && $body) {

            //verifico se o ip corresponde a uma nota cadastrada no db
            $note = Note::find($id);

            //se encontrar a nota, atualiza os dados e salva
            if($note) {
                $note->title = $title;
                $note->body = $body;
                $note->save();

                //retorna as anotações em array
                $this->array['result'] = [
                    'id' => $id,
                    'title' => $title,
                    'body' => $body
                ];
            } else {
                $this->array['error'] = 'ID inexistente';
            }
        } else {
            $this->array['error'] = 'Campos não enviados';
        }

        return $this->array;
    }

    public function delete($id) {
        $note = Note::find($id);

        if($note) {
            $note->delete();
        } else {
            $this->array['error'] = 'ID inexistente';
        }
        return $this->array;
    }
}
