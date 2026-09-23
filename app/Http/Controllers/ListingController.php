<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Listing;
use App\Models\State;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ListingController extends Controller
{
    /**
     * Show create listing form.
     */
    public function create(): View
    {
        $categories = Category::where('status', true)
            ->with([
                'subcategories' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderBy('name')
            ->get();

        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        return view('listings.create', compact(
            'categories',
            'countries'
        ));
    }

    /**
     * Store new listing.
     */
    public function store(StoreListingRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        $listing = Listing::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'country_id' => $validated['country_id'],
            'state_id' => $validated['state_id'],
            'city_id' => $validated['city_id'],
            'area_id' => $validated['area_id'],
            'type' => $validated['type'],
            'name' => $validated['name'],
            'slug' => $this->generateUniqueSlug(
                $validated['name']
            ),
            'detail' => $validated['detail'],
            'price' => $validated['price'],
            'status' => 'active',
        ]);

        return redirect()
            ->route('listings.show', $listing)
            ->with(
                'success',
                'Your listing has been created successfully.'
            );
    }

    /**
     * Display listing.
     */
    public function show(Listing $listing): View
    {
        abort_if(
            $listing->status !== 'active',
            404
        );

        $listing->load([
            'user',
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ]);

        return view(
            'listings.show',
            compact('listing')
        );
    }

    /**
     * Display logged-in user's listings.
     */
    public function myListings(): View
    {
        $listings = Listing::with([
            'category',
            'subcategory',
            'city',
            'area',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view(
            'listings.mine',
            compact('listings')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(Listing $listing): View
    {
        Gate::authorize('update', $listing);

        $categories = Category::where('status', true)
            ->with([
                'subcategories' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderBy('name')
            ->get();

        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where(
            'country_id',
            $listing->country_id
        )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $cities = City::where(
            'state_id',
            $listing->state_id
        )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $areas = Area::where(
            'city_id',
            $listing->city_id
        )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'listings.edit',
            compact(
                'listing',
                'categories',
                'countries',
                'states',
                'cities',
                'areas'
            )
        );
    }

    /**
     * Update listing.
     */
    public function update(UpdateListingRequest $request,        Listing $listing): RedirectResponse
    {

        Gate::authorize('update', $listing);

        $validated = $request->validated();

        $listing->update([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'country_id' => $validated['country_id'],
            'state_id' => $validated['state_id'],
            'city_id' => $validated['city_id'],
            'area_id' => $validated['area_id'],
            'type' => $validated['type'],
            'name' => $validated['name'],
            'detail' => $validated['detail'],
            'price' => $validated['price'],
        ]);

        return redirect()
            ->route('listings.show', $listing)
            ->with(
                'success',
                'Listing updated successfully.'
            );
    }

    /**
     * Delete listing.
     */
    public function destroy(Listing $listing): RedirectResponse
    {

        Gate::authorize('delete', $listing);

        $listing->delete();

        return redirect()
            ->route('listings.mine')
            ->with(
                'success',
                'Listing deleted successfully.'
            );
    }

    /**
     * Get states by country.
     */
    public function states(Country $country): JsonResponse
    {

        $states = $country->states()
            ->where('status', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($states);
    }

    /**
     * Get cities by state.
     */
    public function cities(State $state): JsonResponse
    {

        $cities = $state->cities()
            ->where('status', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($cities);
    }

    /**
     * Get areas by city.
     */
    public function areas(City $city): JsonResponse
    {

        $areas = $city->areas()
            ->where('status', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($areas);
    }

    /**
     * Get subcategories by category.
     */
    public function subcategories(Category $category): JsonResponse
    {

        $subcategories = $category->subcategories()
            ->where('status', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($subcategories);
    }

    /**
     * Generate unique listing slug.
     */
    private function generateUniqueSlug(string $name): string
    {

        $slug = Str::slug($name);

        $originalSlug = $slug;

        $counter = 1;

        while (Listing::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
