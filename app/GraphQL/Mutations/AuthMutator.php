<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AuthMutator
{
    public function login($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $credentials = Arr::only($args, ['email', 'password']);

        if (Auth::once($credentials)) {
            $token = Str::random(60);

            $user = auth()->user();
            $user->api_token = $token;
            $user->save();

            return $token;
        }

        return null;
    }

    public function logout($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo){
        $user = auth()->user();
        Log::debug($user);
        $user->api_token = null;
        $user->save();

        return "TOKEN REVOKED";
    }
}
