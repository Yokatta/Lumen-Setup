<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Note;
use Auth;
class NoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $note = Auth::user()->todo()->get();
        return response()->json(['status' => 'success','result' => $note]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'completed' => 'boolean|required|nullable',
        'description' =>'required',
         ]);
        if(Auth::user()->todo()->Create($request->all())){
            return response()->json(['status' => 'success','data'=>$request->all()]);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::where('id', $id)->get();
        return response()->json($note);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'description' => 'string',
        'completed' => 'boolean'
         ]);
        $note = Note::where('id',$id)->where('owned_by',Auth::id())->first();
        if ($note) {
            if(!($request->completed)){
                $note->completed_at = null;
            }
            else {
                $note->completed_at = date("Y-m-d H:i:s"); 
            }
            $note->completed = $request->completed;
            $note->description = $request->description;
            if($note->save()){
                $note = Note::where('id',$id)->where('owned_by',Auth::id())->first();
               return response()->json(['status' => 'success', $note]);
            }
        }
        return response()->json(['status' => 'failed', 'msg' => 'either you are not autheorized to change note or this note does not exists.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //own_id
    {
        $note = Note::where('id',$id)->where('owned_by',Auth::id());
        if ($note) {
            $note->delete($id);
            return response()->json(['status' => 'success','msg'=> 'note has been deleted']);
        }
        else{
             return response()->json(['status' => 'failed','msg'=>'either you are not autheorized to change note or this note does not exists.']);
        }
    }
}
