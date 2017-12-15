<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\voteRepository;
use App\models\Vote;
use App\models\VotePerson;
use App\models\Person;
use App\Validators\VoteValidator;

/**
 * Class VoteRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VoteRepositoryEloquent extends BaseRepository implements VoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vote::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function getByVote($id)
    {
        $vote = Vote::find($id);
        $vote->person_list =Person::where('vote_id',$vote->id)->get();
        return $vote;
    }
}
