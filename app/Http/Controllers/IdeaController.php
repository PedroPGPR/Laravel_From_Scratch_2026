<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateIdeaAction;
use App\Http\Requests\IdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Throwable;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ideas = Auth::user()
            ->ideas()
            ->when(in_array($request->status, IdeaStatus::values()), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest('created_at')
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::statusCounts(Auth::user()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Throwable
     */
    public function store(IdeaRequest $request, CreateIdeaAction $ideaAction): RedirectResponse
    {
        $ideaAction->handle($request->safe()->all());

        return to_route('ideas.index')->with('success', 'Idea has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('workWidth', $idea);

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea): void
    {
        dd($request->all());
        Gate::authorize('workWidth', $idea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea): RedirectResponse
    {
        Gate::authorize('workWidth', $idea);

        $idea->delete();

        return to_route('ideas.index');
    }
}
