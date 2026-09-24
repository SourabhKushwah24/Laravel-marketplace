import { useForm } from '@inertiajs/react';

export default function Create({ categories, countries }: any) {

    const { data, setData, post, processing, errors } =
        useForm({
            type: 'product',
            name: '',
            detail: '',
            category_id: '',
            subcategory_id: '',
            country_id: '',
            state_id: '',
            city_id: '',
            area_id: '',
            price: '',
        });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();

        post('/listings');
    };

    return (
        <form onSubmit={submit} className="space-y-6">

            <select
                value={data.type}
                onChange={(e) =>
                    setData('type', e.target.value)
                }
            >
                <option value="product">Product</option>
                <option value="service">Service</option>
            </select>

            <input
                value={data.name}
                onChange={(e) =>
                    setData('name', e.target.value)
                }
                placeholder="Name"
            />

            <textarea
                value={data.detail}
                onChange={(e) =>
                    setData('detail', e.target.value)
                }
                placeholder="Detail"
            />

            <select
                value={data.category_id}
                onChange={(e) =>
                    setData('category_id', e.target.value)
                }
            >
                <option value="">
                    Select Category
                </option>

                {categories.map((category: any) => (
                    <option
                        key={category.id}
                        value={category.id}
                    >
                        {category.name}
                    </option>
                ))}
            </select>

            <input
                type="number"
                value={data.price}
                onChange={(e) =>
                    setData('price', e.target.value)
                }
                placeholder="Price"
            />

            <button
                disabled={processing}
                type="submit"
            >
                {processing ? 'Saving...' : 'Create Listing'}
            </button>

        </form>
    );
}