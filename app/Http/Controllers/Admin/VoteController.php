<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\VoteRepositoryEloquent as VoteRepository;

use App\Models\Person;
use App\Models\Vote;
use App\Models\VotePerson;

use App\Http\Requests\VoteRequest;

class VoteController extends Controller
{
    public $vote;

    public function __construct(VoteRepository $vote)
    {
        $this->middleware('CheckPermission:vote');
        $this->vote = $vote;
    }

     public function index()
    {
        $votes = $this->vote->all();
        foreach ($votes as $key => $value) {
            $end_time = strtotime($value->end_time);
            $now_time = strtotime(date('m/d/Y'));

            if($end_time < $now_time) {
                //结束
                $value = $this->vote->update(['status'=>3],$value->id);
            }
        }
        $votes = $this->vote->all();
        return view('admin.vote.index', compact('votes'));
    }

    public function create()
    {
        $vote = new Vote();
        $persons = Person::all();

        return view('admin.vote.create', compact('persons', 'vote'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(VoteRequest $request)
    {
        if( empty($request->id)) {//新增
            $input = $request->except('_token');
            $input['status'] = 1;

            $result = $this->vote->create($input);
            if ($result){
                flash('投票添加成功','success');
            }else{
                flash('投票添加失败','error');
            }
            return redirect('admin/vote');
        } else {// edit
            $input = $request->except('_token');
            $result = $this->vote->update($input, $request->id);
            if ($result){
                flash('投票修改成功','success');
             }else{
                 flash('投票修改失败','error');
            }
            return redirect('admin/vote');
        }

    }

    public function  personAction(Request $request)
    {
        if(!empty($request->Person))
        {
            foreach ($request->Person as $val) {
                $person_input = array();
                $person_input['vote_id'] = $request->vote_id;
                $person_input['vote_id'] = $request->vote_id;
                $person_input['cour'] = $request->vote_id;
                VotePerson::create($person_input);
            }
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //结束投票
        $result = $this->vote->update(array('status'=>3),$id);
        if ($result){
            flash('投票关闭成功','success');
        } else {
            flash('投票关闭失败','error');
        }
        return redirect('admin/vote');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vote = $this->vote->find($id);
        $persons = Person::all();
        $vote_persons  = VotePerson::where('vote_id', $id)->get()->toArray();

        $vote_persons  = array_column($vote_persons, 'user_id');
        return view('admin.vote.create', compact('persons', 'vote', 'vote_persons'));
    }

    /**
     * Update the specified resource in storage.
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AdminUserRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->vote->delete($id);
        if ($res){
            VotePerson::where('vote_id',$id)->delete();
            Person::where('vote_id',$id)->delete();
            flash('投票删除成功','success');
        }else{
            flash('投票删除失败','error');
        }
        return redirect('admin/vote');
    }
}
