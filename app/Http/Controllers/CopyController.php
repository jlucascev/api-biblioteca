<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Copy;
use App\Models\Book;

class CopyController extends Controller
{
    public function createCopy(Request $request)
	{
		
		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el ejemplar
		if($data && Book::find($data->book)){
			$copy = new Copy();

			//TODO: Validar los datos antes de guardar el ejemplar

			$copy->publisher = $data->publisher;
			$copy->edition = $data->edition;
			$copy->book_id = $data->book;
			try{
				$copy->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

			
		}else{
			$response = "Datos incorrectos o libro no encontrado";
		}

		
		return response($response);
	}

	public function updateBook(Request $request, $id){

		$response = "";

		//Buscar el ejemplar por su id

		$copy = Copy::find($isbn);
		//Buscar el ejemplar
		if($copy){

			//Leer el contenido de la petición
			$data = $request->getContent();

			//Decodificar el json
			$data = json_decode($data);

			//Si hay un json válido
			if($data){
			
				//TODO: Validar los datos antes de guardar el ejemplar
				$copy->publisher = (isset($data->publisher) ? $data->publisher : $copy->publisher);
				$copy->edition = (isset($data->edition) ? $data->edition : $copy->edition);

				try{
					$copy->save();
					$response = "OK";
				}catch(\Exception $e){
					$response = $e->getMessage();
				}
			}

			
		}else{
			$response = "No book";
		}

		
		return response($response);
	}

	public function deleteCopy($id){

		$response = "";
		
		//Buscar el libro por su id

		$copy = Copy::find($id);

		if($copy){

			try{
				$copy->delete();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}
						
		}else{
			$response = "No copy";
		}

		
		return response($response);
	}

	public function viewCopy($id){

		$response = "";
		$copy = Copy::find($id);

		if($copy){

			$response = [
				"publisher" => $copy->publisher,
				"edition" => $copy->edition,
				"title" => $copy->book
			];

		}else{
			$response = "Ejemplar no encontrado";
		}

		return response()->json($response);
	}
}
