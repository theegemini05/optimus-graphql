<?php

namespace App\GraphQL\Mutations;

use App\Vehicle;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class VehicleMutator
{
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        $vehicle = new \App\Vehicle($args);
        $context->user()->vehicles()->save($vehicle);

        return $vehicle;
    }

    public function update($rootValue, array $args, GraphQLContext $context)
    {
        $vehicle_id = $args["id"];
        $vehicle = Vehicle::findOrFail($vehicle_id);
        unset($args["id"]);
        unset($args["directive"]);
        $vehicle->update($args);
        return $vehicle;
    }
}
