import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link, useForm } from '@inertiajs/react';

export default function ServicesCreate({ categories }) {
    const form = useForm({ name: '', description: '', category_id: '', price: '', picture: null });

    const submit = (e) => {
        e.preventDefault();
        const data = new FormData();
        data.append('name', form.data.name);
        data.append('description', form.data.description);
        data.append('category_id', form.data.category_id);
        data.append('price', form.data.price);
        if (form.data.picture) data.append('picture', form.data.picture);

        form.transform(() => data);
        form.post(route('services.store'), {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => form.reset(),
        });
    };

    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-2xl px-4 sm:px-6 py-8">
                <h1 className="text-2xl font-bold mb-6">List a new service</h1>
                <form onSubmit={submit} className="surface p-6 space-y-4" encType="multipart/form-data">
                    <Field label="Service name" error={form.errors.name}>
                        <input type="text" value={form.data.name} onChange={(e) => form.setData('name', e.target.value)} required
                            className="w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                    </Field>
                    <Field label="Description" error={form.errors.description}>
                        <textarea rows="5" value={form.data.description} onChange={(e) => form.setData('description', e.target.value)} required
                            className="w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                    </Field>
                    <div className="grid grid-cols-2 gap-4">
                        <Field label="Category" error={form.errors.category_id}>
                            <select value={form.data.category_id} onChange={(e) => form.setData('category_id', e.target.value)} required
                                className="w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                                <option value="">Select…</option>
                                {categories.map((c) => <option key={c.id} value={c.id}>{c.name}</option>)}
                            </select>
                        </Field>
                        <Field label="Price ($)" error={form.errors.price}>
                            <input type="number" step="0.01" value={form.data.price} onChange={(e) => form.setData('price', e.target.value)} required
                                className="w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                        </Field>
                    </div>
                    <Field label="Cover image" error={form.errors.picture}>
                        <input type="file" accept="image/*" onChange={(e) => form.setData('picture', e.target.files[0])}
                            className="block w-full text-sm text-muted file:btn file:btn-ghost file:mr-3" />
                    </Field>
                    <div className="flex justify-end gap-3 pt-2">
                        <Link href={route('explore')} className="btn btn-ghost">Cancel</Link>
                        <button type="submit" className="btn btn-brand" disabled={form.processing}>Publish service</button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}

function Field({ label, error, children }) {
    return (
        <div>
            <label className="eyebrow">{label}</label>
            <div className="mt-1">{children}</div>
            {error && <p className="text-sm text-danger mt-1">{error}</p>}
        </div>
    );
}