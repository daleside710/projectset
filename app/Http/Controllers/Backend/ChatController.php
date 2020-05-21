<?php

namespace App\Http\Controllers\Backend;

use App\Events\closedStatus;
use App\Events\sendMessage;
use App\Events\statusChange;
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
            ->where('type','user')
            ->update(['status'=>'read']);
        $messages=Message::where('chat_id',$id)->get();

        $data=ChatQueries::find($id);
        if($data->status == 'pending'){
            $data->status = 'active';
            $data->save();
            $querie=ChatQueries::where('id',$id)->first();
            $msg=['receiver_id'=>$data->sender_id,'sender_id'=>Auth::user()->id,'querie_id'=>$id,'status'=>'active','type'=>'admin'];
            event(new closedStatus($msg));
        }
        else{
            $querie=ChatQueries::where('id',$id)->first();
        }
        return view('backend.pages.chat.chat',compact('messages','querie'));
    }
    public function sendMessage(Request $request){
        $admin=1;
        $user_id=Auth::user()->id;
        $chat_id=$request->querie_id;
        $message=new Message;
        $message->receiver_id=$request->sender_id;
        $message->sender_id=$user_id;
        $message->chat_id= $chat_id;
        $message->message=$request->message;
        $message->type='admin';
        $message->status='unread';
        $message->save();
        if($message)
        {
            $msg=['receiver_id'=>$request->sender_id,'sender_id'=>$user_id,'chat_id'=>$chat_id,'message'=>$request->message,'type'=>'admin'];
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
            // $msg=['receiver_id'=>$admin,'sender_id'=>$user_id,'message'=>$request->message,'type'=>'user'];
            //event(new sendMessage($msg));
            return response()->json(['success' => 'Query send successfully!']);
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
        $msg_status='';
        if($status == 'closed'){
            $msg_status='Chat has closed by admin';
            $data->chat_msg= $msg_status;
        }
        $msg=['receiver_id'=>$data->sender_id,'sender_id'=>Auth::user()->id,'previous_status'=>$data->status,'querie_id'=>$id,'status'=>$status,'message_status'=>$msg_status,'type'=>'admin'];
        event(new closedStatus($msg));
        $data->save();

        return back();
    }
    public function ChatQueries(){
        $sender_id=Auth::user()->id;
        $queries=ChatQueries::orderBy('id','desc')->paginate(10);
        if(count($queries) > 0 ){
            foreach ($queries as $key=>$query){
                $queries[$key]['count_unread']=0;
                $queries[$key]['count_unread']=Message::where('status','unread')
                    ->where('type','user')
                    ->where('chat_id',$query->id)->count();
            }
        }
//         dd($queries);
        return view('backend.pages.chat.chat_query',compact('queries'));
    }
}
