export default function Show({ listing }: any) {
    return (
        <div className="mx-auto max-w-5xl px-4 py-10">

            <div className="rounded-xl bg-white p-8 shadow">

                <div className="flex justify-between">
                    <h1 className="text-3xl font-bold">
                        {listing.name}
                    </h1>

                    <span className="text-2xl font-bold">
                        ₹{listing.price}
                    </span>
                </div>

                <div className="mt-6">
                    <p className="text-gray-700">
                        {listing.detail}
                    </p>
                </div>

                <div className="mt-8 grid gap-4 md:grid-cols-2">

                    <div>
                        <strong>Category:</strong>
                        <p>{listing.category?.name}</p>
                    </div>

                    <div>
                        <strong>Subcategory:</strong>
                        <p>{listing.subcategory?.name}</p>
                    </div>

                    <div>
                        <strong>City:</strong>
                        <p>{listing.city?.name}</p>
                    </div>

                    <div>
                        <strong>Area:</strong>
                        <p>{listing.area?.name}</p>
                    </div>

                </div>

                <div className="mt-8 border-t pt-6">
                    <strong>Seller</strong>
                    <p>{listing.user?.name}</p>
                </div>

            </div>
        </div>
    );
}