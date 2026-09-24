import { Link } from '@inertiajs/react';

interface Listing {
    id: number;
    name: string;
    price: string;
    detail: string;
    city?: {
        name: string;
    };
    area?: {
        name: string;
    };
    category?: {
        name: string;
    };
}

interface Props {
    listing: Listing;
}

export default function ListingCard({ listing }: Props) {
    return (
        <Link
            href={`/listings/${listing.id}`}
            className="block rounded-xl border bg-white p-5 shadow-sm transition hover:shadow-md"
        >
            <div className="mb-3 flex items-start justify-between">
                <span className="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-700">
                    {listing.category?.name}
                </span>

                <span className="text-lg font-bold">
                    ₹{listing.price}
                </span>
            </div>

            <h3 className="text-lg font-semibold">
                {listing.name}
            </h3>

            <p className="mt-2 line-clamp-2 text-sm text-gray-600">
                {listing.detail}
            </p>

            <div className="mt-4 text-sm text-gray-500">
                {listing.area?.name}, {listing.city?.name}
            </div>
        </Link>
    );
}