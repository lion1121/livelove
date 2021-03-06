<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\StoreImageTrait;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\ProfileUpdateRequest;


class ProfileController extends Controller
{
    use StoreImageTrait;

    public function __construct()
    {
        $this->middleware('api-version');
        $this->middleware('auth:api');
    }

    /**
     * @SWG\Get(
     *     path="/api/users",
     *     summary="Show users profile",
     *     tags={"User Profile"},
     *     description="Show users profile",
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer token",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="Accept",
     *         in="header",
     *         description="application/json;v=1.0",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="return user data",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthenticated",
     *     ),
     *     @SWG\Response(
     *         response="410",
     *         description="Non valid api version",
     *     ),
     * )
     */


    /**Return auth user data
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = Auth::user();
        $userData = User::with('programs')->findOrFail($user);
        return response()->json(['success' => $userData], 200);
    }

    /**
     * @SWG\Put(
     *     path="/api/users",
     *     summary="Edit users profile",
     *     tags={"Edit users Profile"},
     *     description="Show users profile",
     *     @SWG\Parameter(
     *         name="name",
     *         in="body",
     *         description="Users name",
     *         required=false,
     *         type="string",
     *         @SWG\Schema(type="string")
     *     ),
     *     @SWG\Parameter(
     *         name="phone",
     *         in="body",
     *         description="Users phone",
     *         required=false,
     *         type="string",
     *         @SWG\Schema(type="string")
     *     ),
     *     @SWG\Parameter(
     *         name="biography",
     *         in="body",
     *         description="Users biography",
     *         required=false,
     *         type="string",
     *         @SWG\Schema(type="string")
     *     ),
     *     @SWG\Parameter(
     *         name="position",
     *         in="body",
     *         description="Users position",
     *         required=false,
     *         type="string",
     *         @SWG\Schema(type="string")
     *     ),
     *     @SWG\Parameter(
     *         name="image",
     *         in="body",
     *         description="Users image",
     *         required=false,
     *         type="file",
     *         @SWG\Schema(type="file")
     *     ),
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer token",
     *         required=true,
     *         type="string",
     *     ),
     *    @SWG\Parameter(
     *         name="Content-type",
     *         in="header",
     *         description="application/x-www-form-urlencoded",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="Accept",
     *         in="header",
     *         description="application/json;v=1.0",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="return user data",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthenticated",
     *     ),
     *     @SWG\Response(
     *         response="410",
     *         description="Non valid api version",
     *     ),
     * )
     *
     * Update users date
     * @param ProfileUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    protected function update(ProfileUpdateRequest $request)
    {
        $userData = Auth::user();
        if (!is_null($userData->image)) unlink(storage_path(User::PHOTOPATH . $userData->image));
        $userData->fill($request->validated());
        $userData->image = $this->storeImage($request, 'image');
        $userData->save();
        return response()->json($userData);
    }

//    public function delete($id)
//    {
//        $userId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
//        $user = User::findOrFail($userId)->first();
//        if ($user) {
//            if ($user->image) unlink(storage_path('app/public/' . $user->image));
//            $user->delete();
//            return response('User ' . $user->name . ' has been deleted', 200);
//        } else {
//            return response('Unregistered user', 401);
//        }
//    }

}
