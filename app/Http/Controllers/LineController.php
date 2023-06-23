<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineRequest;
use App\Http\Resources\LineResource;
use App\Models\Line;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LineController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return LineResource::collection(Line::all());
    }

    public function store(LineRequest $request): LineResource
    {
        return LineResource::make(
            Line::create($request->validated())
        );
    }

    public function show(Line $line): LineResource
    {
        return LineResource::make($line);
    }

    public function update(LineRequest $request, Line $line): LineResource
    {
        $line->update($request->validated());

        return LineResource::make($line);
    }

    public function destroy(Line $line)
    {
        $line->delete();

        return response()->noContent();
    }
}
