<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Repositories\UserRepository;


class UserController extends Controller
{

    protected $users;


    /**
     * UserController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function index()
    {
       // $users = $this->users->paginate(10);
        $users = $this->users->all();
            return response()->json($users);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user =  $this->users->get($id);

            return response()->json($user);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->users->getCreateRules());

        if ($validator->fails())
            return response()->json($validator->messages(), 406);

        $user = $this->users->add($request->all());
             return response()->json($user, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),  $this->users->getUpdateRules());

        if ($validator->fails())
            return response()->json($validator->messages(), 406);

        if ($this->users->update($request->all(), 'id', $id))
            return response()->json($this->users->get($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (!$this->users->isBookHolder($id)) {
            $this->users->delete($id);
            return response()->json(['message'=>'Record deleted'], 204);
        } else
            return response()->json(['message'=>'Can not delete, User ID'.$id.'holds books'], 400);
    }
    
}
