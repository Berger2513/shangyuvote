<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\VotePerson;
use App\Models\Vote;
use Storage;
use App\Http\Requests\PersonRequest;

class PersonController extends Controller
{


    public function index(Request $request)
    {
        $vote =Vote::find($request->vote_id);

        $persons = Person::where('vote_id',$request->vote_id)->get();

        return view('admin.person.create', compact('vote', 'persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personRequest $request)
    {
        // dd($request->all());
        $file = $request->file('image');
        $avatar = $this->upload($file);
        $inpit =  $request->except('_token');
        $inpit['avatar']= $avatar;
        $result = Person::create($inpit);

        if($result) {
            $person_input = array();
            $person_input['user_id'] = $result->id;
            $person_input['vote_id'] = $result->vote_id;
            $person_input['sorce'] = 0;
            VotePerson::create($person_input);
            flash('添加成功','success');
        } else {
            flash('添加失败','error');
        }
        return redirect()->back();
    }
    public function upload($file)
    {
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            return $filename;
        } else {
            return false;
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res =  Person::where('id',$id)->delete();
        if ($res){
            VotePerson::where('user_id',$id)->delete();
            flash('投票删除成功','success');
        }else{
            flash('投票删除失败','error');
        }
        return redirect('admin/vote');
    }

}
