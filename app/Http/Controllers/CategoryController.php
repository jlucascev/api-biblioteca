<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
	{
		
		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear la categoría
		if($data){
			$category = new Category();

			//TODO: Validar los datos antes de guardar la categoría

			$category->name = $data->name;

			try{
				$category->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

			
		}else{
			$response = "Datos incorrectos";
		}

		
		return response($response);
	}
}
