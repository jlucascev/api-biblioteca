<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\CategoriesBook;
use App\Models\Category;

class BookController extends Controller
{
    //

	public function createBook(Request $request)
	{
		
		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el libro
		if($data){
			$book = new Book();

			//TODO: Validar los datos antes de guardar el libro

			$book->ISBN = $data->ISBN;
			$book->title = $data->title;
			$book->description = $data->description;
			try{
				$book->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

			
		}

		
		return response($response);
	}

	public function updateBook(Request $request, $isbn){

		$response = "";

		//Buscar el libro por su id

		$book = Book::find($isbn);

		if($book){

			//Leer el contenido de la petición
			$data = $request->getContent();

			//Decodificar el json
			$data = json_decode($data);

			//Si hay un json válido, buscar el libro
			if($data){
			
				//TODO: Validar los datos antes de guardar el libro
				$book->title = (isset($data->title) ? $data->title : $book->title);
				$book->description = (isset($data->description) ? $data->description : $book->description);

				try{
					$book->save();
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

	public function deleteBook(Request $request, $isbn){

		$response = "";
		
		//Buscar el libro por su id

		$book = Book::find($isbn);

		if($book){

			try{
				$book->delete();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}
						
		}else{
			$response = "No book";
		}

		
		return response($response);
	}

	public function addCategory(Request $request){

		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el libro
		if($data&&Book::find($data->book)&&Category::find($data->category)){
			$bookCategory = new CategoriesBook();

			//TODO: Validar los datos antes de guardar el libro

			$bookCategory->books_id = $data->book;
			$bookCategory->categories_id = $data->category;
			try{
				$bookCategory->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

		}
		return response($response);

	}

	public function viewBook($id){

		$response = "";
		$book = Book::find($id);

		if($book){

			$response = [
				"title" => $book->title,
				"description" => $book->description,
				"categories" => $book->categories
			];

		}else{
			$response = "Libro no encontrado";
		}

		return response()->json($response);
	}

	public function listBooks(){

		$response = "";
		$books = Book::all();

		$response= [];

		foreach ($books as $book) {
			$response[] = [
				"isbn" => $book->ISBN,
				"title" => $book->title
			];
		}
		


		return response()->json($response);
	}

	public function viewCopies($id){

		$book = Book::find($id);

		$response = "";

		if($book){
			$response = $book->copies;
		}

		return response()->json($response);
	}
}
