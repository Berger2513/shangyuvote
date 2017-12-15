<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\Eloquent\VoteRepositoryEloquent as VoteRepository;
use App\Models\Persion;
use App\Models\Vote;
use App\Models\VotePerson;
use App\Models\VotePoler;

class VoteController extends Controller
{
    public $vote;

    public function __construct(VoteRepository $vote)
    {
        $this->vote = $vote;
    }

    public function index()
    {
        $votes = $this->vote->findWhere(['status'=>1]);
        return view('front.vote.index',compact('votes'));
    }

    public function detail($id)
    {
        $vote = $this->vote->getByVote($id);
        return view('front.vote.detail',compact('vote'));
    }

    public function store(Request $request)
    {

        $poler_info = VotePoler::where('poler_id', 'wangdong')
        ->where('vote_date', date('Y-m-d'))
        ->where('vote_id', $request->vote_id)
        ->first();
        if($poler_info){
            $stat = [
                        'status' =>2,
                        'message'=>'已经投票过了,每个人每天只能投一次'
                    ];
        } else {
                //检查投票最大的 选择数量
                $vote_max_num = $this->getMaxNum($request->vote_id);
                if( count($request->user_id)> $vote_max_num){
                    $stat = [
                        'status' =>2,
                        'message'=>'选择人数超过限制最多只能选择'.$vote_max_num.'人'
                    ];
                } else {
                    $input = $request->except('_token');
                    //投票人信息
                    $input['poler_id'] = 'wangdong';
                    $input['vote_date'] = date('Y-m-d');

                    $res = $this->createByInfo($input);

                    if( $res ){
                        $stat = [
                            'status' =>1,
                            'message'=>'投票成功'
                        ];
                    }else {
                        $stat = [
                            'status' =>2,
                            'message'=>'投票失败'
                        ];
                    }
                }

        }
        return view('front.vote.message',compact('stat'));

    }
    public function getMaxNum($id)
    {
        return $this->vote->find($id)->max_num;
    }
    /**
    *添加 投票 逻辑
    **/
    public function createByInfo($data)
    {
        $tmp_arr = array();
        $vote_tmp_arr = array();
        $tmp_arr = [
            'vote_id'=>$data['vote_id'],
            'poler_id'=>'wangdong',
            'vote_date'=>date('Y-m-d'),
        ];
        $res = VotePoler::create($tmp_arr);

        if($res){
            foreach ($data['user_id'] as $value) {
                $arr = VotePerson::where('user_id', $value)->where('vote_id',$data['vote_id'])->first();
                VotePerson::where('id', $arr->id)->update(['sorce'=>$arr->sorce+1]);
            }
            return true;
        } else {
            return false;
        }



    }

    public function message()
    {
       return view('front.vote.message');
    }
}
// foreach ($request->user_id as $value) {
                    //     # code...
                    // }

                    // $res = VotePoler::create($input);
                    // if($res){
                    //     $user_id = $input['user_id'];
                    //     $vote_id = $input['vote_id'];
                    //     $data = VotePerson::where('user_id', $user_id)->where('vote_id', $vote_id)->first();
                    //     VotePerson::where('id', $data->id)->update(['sorce'=>$data->sorce+1]);
                    //     $message = 'success';
                    // } else {
                    //     $message = 'error';
                    // }