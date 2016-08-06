<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\SendRemindMail;


class BookController extends Controller
{

    protected $books;


    /**
     * BookController constructor.
     * @param BookRepository $books
     */
    public function __construct(BookRepository $books)
    {
        $this->books = $books;
    }

    /**
     * @return mixed
     */
    public function index()
    {
       // $books = $this->books->paginate(10);
        $books = $this->books->all();
        return response()->json($books);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $book = $this->books->get($id);
        return response()->json($book);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request, SendRemindMail $srm, UserRepository $users)
    {
        $validator = Validator::make($request->all(), $this->books->getRules());

        if ($validator->fails())
            return response()->json($validator->messages(), 406);

        $book = $this->books->add($request->all());

        $srm->sendReminderBook($users->all(), 'new', $book);

            return response()->json($book, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->books->getRules());

        if ($validator->fails())
            return response()->json($validator->messages(), 406);

        if ($this->books->update($request->all(), 'id', $id))
            return response()->json($this->books->get($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if ($this->books->isCharged($id))
            return response()->json(['message' => 'Can not delete. Book ID' . $id . ' is charged'], 400);
        else  {
             $this->books->delete($id);
             return response()->json(['message' => 'Record deleted'], 204);
        }
    }

}
