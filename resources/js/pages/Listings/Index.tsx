import { Link, router } from '@inertiajs/react';
import { FormEvent, useState } from 'react';
import ListingCard from '@/components/ListingCard';

interface Props {
    listings: any;
    title?: string;
    filters?: {
        search?: string;
    };
}

export default function Index({
    listings,
    title = 'Latest Listings',
    filters,
}: Props) {
    const [search, setSearch] = useState(
        filters?.search ?? ''
    );

    const submitSearch = (e: FormEvent) => {
        e.preventDefault();

        router.get(
            '/listings',
            { search },
            {
                preserveState: true,
                replace: true,
            }
        );
    };

    return (
        <div className="min-h-screen bg-gray-50">
            <div className="mx-auto max-w-7xl px-4 py-8">

                <div className="mb-8 flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">
                            {title}
                        </h1>

                        <p className="mt-2 text-gray-600">
                            Find products and services near you.
                        </p>
                    </div>

                    <Link
                        href="/listings/create"
                        className="rounded-lg bg-blue-600 px-5 py-3 text-white"
                    >
                        Post Listing
                    </Link>
                </div>

                <form
                    onSubmit={submitSearch}
                    className="mb-8 flex gap-3"
                >
                    <input
                        value={search}
                        onChange={(e) =>
                            setSearch(e.target.value)
                        }
                        placeholder="Search listings..."
                        className="flex-1 rounded-lg border px-4 py-3"
                    />

                    <button
                        type="submit"
                        className="rounded-lg bg-gray-900 px-6 py-3 text-white"
                    >
                        Search
                    </button>
                </form>

                {listings.data.length > 0 ? (
                    <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        {listings.data.map((listing: any) => (
                            <ListingCard
                                key={listing.id}
                                listing={listing}
                            />
                        ))}
                    </div>
                ) : (
                    <div className="rounded-xl bg-white p-10 text-center">
                        <h2 className="text-xl font-semibold">
                            No listings found
                        </h2>

                        <p className="mt-2 text-gray-500">
                            Try another search.
                        </p>
                    </div>
                )}
            </div>
        </div>
    );
}