<?php

namespace App\Http\Controllers\Frontend;

use App\Events\closedStatus;
use App\Events\querystatus;
use App\Events\sendMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatQueries;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function chat($id){
        $admin=1;
        $user_id=Auth::user()->id;
        Message::where('chat_id',$id)
            ->where('type','admin')
            ->update(['status'=>'read']);

        $messages=Message::where('chat_id',$id)->get();
        $querie=ChatQueries::where('id',$id)->first();
        //dd($messages);
        return view('frontend.pages.chat.chat',compact('messages','querie'));
    }
    public function sendMessage(Request $request){
        $admin=1;
        $user_id=Auth::user()->id;
        $chat_id=$request->querie_id;
        $message=new Message;
        $message->receiver_id=$admin;
        $message->sender_id=$user_id;
        $message->chat_id= $chat_id;
        $message->message=$request->message;
        $message->type='user';
        $message->status='unread';
        $message->save();
        if($message)
        {
            $msg=['receiver_id'=>$admin,'sender_id'=>$user_id,'chat_id'=>$chat_id,'message'=>$request->message,'type'=>'user'];
            event(new sendMessage($msg));
            return response()->json(['success'=>'message send successfully']);
        }
        else
            return response()->json(['error'=>'Message sending failed']);
    }


    // send new query through ajax
    public function sendQuery(Request $request)
    {
        $admin = 1;
        $user_id = Auth::user()->id;
        $QueryOb= new ChatQueries;
        $QueryOb->sender_id= $user_id;
        $QueryOb->receiver_id= $admin;
        $QueryOb->status= 'pending';
        $QueryOb->message= $request->queryText;
        $QueryOb->save();
        if ($QueryOb) {
            $querie_url=route('admin.chat',$QueryOb->id);
             $msg=['receiver_id'=>$admin, 'query_url'=>$querie_url ,'querie_id'=>$QueryOb->id,'sender_id'=>$user_id,'sender_email'=>Auth::user()->email,'sender_name'=>Auth::user()->name,'status'=>'pending','messages'=>$request->queryText,'type'=>'user'];
            event(new querystatus($msg));
            return response()->json(['success' => 'Query send successfully!','querie_id'=>$QueryOb->id]);
        }
        else
        {
            return response()->json(['error'=>'Query sending failed']);
        }
    }
    // ajax request for changeStatus
    public function changeStatus(Request $request){
        $id=$request->chat_querie;
        $status=$request->querie_status;
        $data=ChatQueries::find($id);
        $data->status=$status;
        $msg_status="";
        if($status == 'closed'){
            $msg_status='Chat is closed by user';
            $data->chat_msg= $msg_status;
        }
        $data->save();
       // $querie_url=route('admin.chat',$QueryOb->id);
        $msg=['receiver_id'=>$data->sender_id,'sender_id'=>Auth::user()->id,'querie_id'=>$id,'status'=>$status,'message_status'=>$msg_status,'type'=>'user'];
        event(new closedStatus($msg));
       return back();
    }
    public function ChatQueries(){
          $sender_id=Auth::user()->id;
//        $QueryOb= new ChatQueries;
//        $QueryOb->sender_id= Auth::user()->id;
//        $QueryOb->receiver_id= '14';
//        $QueryOb->status= 'pending';
//        $QueryOb->message= 'This is simple testing text';
//        $QueryOb->save();
        $queries=ChatQueries::where('sender_id',$sender_id)->orderBy('id','desc')->paginate(10);
        if(count($queries) > 0 ){
            foreach ($queries as $key=>$query){
                $queries[$key]['count_unread']=0;
                $queries[$key]['count_unread']=Message::where('status','unread')
                    ->where('type','admin')
                    ->where('chat_id',$query->id)->count();
            }
        }
        return view('frontend.pages.chat.chat_query',compact('queries'));
    }


}
