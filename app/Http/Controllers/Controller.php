<?php

namespace App\Http\Controllers;

use App\Models\StudentTest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function testPassed($testName, string $studentName){
        $student = StudentTest::whereName($studentName)->firstOr(function() use ($studentName) {
            $studentTest = new StudentTest();
            $studentTest->name= $studentName;
            return $studentTest;
        });


        $student->addTest($testName);
        $student->save();
    }

    /**
     *
     * @param Request $request
     * @return Application|JsonResponse|Response|ResponseFactory
     */
    public function checkHeader(Request $request) {
        if(!$request->hasHeader('pokemon')) {
            return response('Missing the pokemon name header !', 400);
        }

        $this->testPassed('customHeader', $request->header('Student-Name'));
        return response()->json([
            'name' =>  $request->header('pokemon'),
            'pv' => rand(10, 100),
            'secret-code' => md5('checkHeader'),
            'status' => 'Well done ✅'
        ]);

    }

    /**
     * Should have an array of data in query parameters named : "favoritePokemons"
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function haveQueryParameterArray(Request $request){

        if(!$request->header('Secret-Code') == md5('checkHeader')){
            return response('Missing the secret code !', 400);
        }

        $data = $request->all();

        if(!isset($data['favoritesPokemon']) && count($data['favoritesPokemon']) <= 1) {
            return response('Missing the favoritesPokemons property', 400);
        }

        $validator = $request->validate(
            [
                'with' => 'array'
            ], ['array' => 'The :attribute must be an array']
        );



        $this->testPassed('arrayInQueryParameter', $request->header('Student-Name'));
        $response = response()->json(['status' => 'Well done ✅', $data]);

        $response->header('Secret-Code', md5('salamèche'));
        return $response;
    }

    public function patchJson(Request $request){
        if(!$request->header('Content-Type') ==  'application/json'){
            return response('Content type for JSON is missing', 400);
        }
        try {
            $json = json_decode($request->getContent(), true);
            $this->testPassed('patchJsonBody', $request->header('Student-Name'));

            return \response()->json(['status' => 'Well done ✅',$json]);
        } catch (\Exception $exception){
            return response('Cannot decode data, check your JSON ---', 400);
        }
    }

    public function putForm(Request $request, $word1, $word2){

        if(!str_contains($request->header('Content-Type'), 'multipart/form-data;')){
            return response('Wrong form type, we want a MultiPart Form data !', 400);
        }

        if(!$request->has('image')){
            return \response('Missing image file in request :(', 400);
        }

        if(!$request->has('image_description')){
            return \response('Missing image description field :(', 400);
        }

        if($word1 == '' || $word2 == ''){
            return \response('Missing Path parameters :(', 404);
        }

        $this->testPassed('putForm', $request);
        return \response('Well done ✅');
    }

    public function delete(Request $request){
        if(!$request->query->has('user_id')){
            return \response('missing query parameter :(', 400);
        }
        $this->testPassed('delete', $request);
        return \response('Well done ✅');
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function jsonBody(Request $request){

        if(!$request->header('Secret-Code') == md5('haveQueryParameterArray')){
            return response('Missing the secret code !', 400);
        }

        if(!$request->header('Content-Type') ==  'application/json'){
            return response('Wrong or missing Content-Type -> JSON', 400);
        }

        try {
            $json = json_decode($request->getContent(), true);
            if(!isset($json['type']) || !isset($json['color']) || !isset($json['brand']) || !isset($json['model'])){
                return response('Missing required value :/', 400);
            }
            $this->testPassed('jsonBody', $request->header('Student-Name'));
            return \response()->json(['status' => 'Well done ✅',$json]);
        } catch (\Exception $exception){
            return response('Cannot decode data ' . $exception->getMessage(), 400);
        }
    }

    public function multipartForm(Request $request){
        if(!str_contains($request->header('Content-Type'), 'multipart/form-data;')){
            return response('Wrong form type, we want a MultiPart Form data !', 400);
        }

        if(!$request->hasFile('image')){
            return \response('Missing image file in request :(', 400);
        }

        if(!$request->has('image_description')){
            return \response('Missing image description field :(', 400);
        }

        $this->testPassed('multipartForm', $request->header('Student-Name'));
        return \response('Well done ✅');
    }

    public function urlEncoded(Request $request){
        if($request->header('Content-Type') != 'application/x-www-form-urlencoded'){
            return response('Wrong form type !', 400);
        }

        if(count($request->all()) < 3) {
            return \response('No data or not enough data in the form :(', 400);
        }

        $this->testPassed('urlEncodedForm', $request->header('Student-Name'));
        return response()->json(['status' => 'Well done ✅', $request->all()]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('auth_token');
            $this->testPassed('loggedIn', Auth::user()->name);

            return response()->json(['token' => $token->plainTextToken]);
        }else{
            return \response('Bad login details or missing', 401);
        }
    }

    public function securedRoute(Request $request): JsonResponse
    {
        $this->testPassed('accessedSuperSecuredData', $request->user()->name);
        return \response()->json(['status' => 'Well done ✅', 'superSecuredData' => 'https://checkboxolympics.com/', 'moreUselessWeb' => 'https://theuselessweb.com/']);
    }

    public function registerApiUser(Request $request): JsonResponse
    {
        $request->validate(
            [
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users',
                'password' =>
                    [
                        'required',
                        'string'
                    ]
            ]
        );

        $user = new User();

        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->testPassed('registrationCompleted', $user->name);
        return response()->json(['status' => 'Well done ✅, you are now registered in the API']);
    }
}
