<?php

namespace Modules\Admin\Repositories;

use App\Models\User;
use DB;

class UserRepository
{
    /**
     * Object of User class
     *
     * @var user
     */
    private $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * search on user_data and users table by (Full name and email)
     *
     * @param string $request
     *
     * @return array
     */
    public function searchManagers($request)
    {
        $users = $this->user;
        $users = $users->where('user_type', User::APPRAISER)->where(function ($query) use ($request) {
                $query->whereHas('userData', function ($q) use ($request) {
                    $q->where(\DB::raw('CONCAT_WS(" ", user_data.firstname, user_data.lastname)'), 'like', '%' . $request . '%');
                })->orwhere('email', 'LIKE', '%' . $request . '%');
        });
        $users = $users->orderBy('id', 'desc')->take(15)->with('userData')->get();
        $dataArray = [
            'users' => $users,
        ];

        return $dataArray;
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function searchAppraisers($request)
    {
        $users = $this->user;
        $users = $users->where('user_type', User::APPRAISER)
            ->doesntHave('appraiserGroups')
            ->where(function ($query) use ($request) {
            $query->whereHas('userData', function ($q) use ($request) {
                $q->where(\DB::raw('CONCAT_WS(" ", user_data.firstname, user_data.lastname)'), 'like', '%' . $request . '%');
            })->orwhere('email', 'LIKE', '%' . $request . '%');
        });
        $users = $users->orderBy('id', 'desc')->take(15)->with('userData')->get();
        $dataArray = [
            'users' => $users,
        ];

        return $dataArray;
    }
}


