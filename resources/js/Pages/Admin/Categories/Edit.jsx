import AdminLayout from '@/Layouts/AdminLayout';
import { Link, useForm } from '@inertiajs/react';

export default function CategoryEdit({ category }) {
    const form = useForm({ name: category.name, description: category.description, _method: 'PATCH' });
    const submit = (e) => { e.preventDefault(); form.put(route('admin.categories.update', category.id), { preserveScroll: true }); };
    return (
        <AdminLayout title="Edit category">
            <h2 className="text-xl font-bold mb-4">Edit category</h2>
            <form onSubmit={submit} className="surface p-6 max-w-md space-y-4">
                <Field label="Name" error={form.errors.name}>
                    <input type="text" value={form.data.name} onChange={(e) => form.setData('name', e.target.value)} required
                        className="block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <Field label="Description" error={form.errors.description}>
                    <textarea rows="3" value={form.data.description} onChange={(e) => form.setData('description', e.target.value)}
                        className="block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <div className="flex gap-3"><Link href={route('admin.categories.index')} className="btn btn-ghost">Cancel</Link><button className="btn btn-brand">Save</button></div>
            </form>
        </AdminLayout>
    );
}

function Field({ label, error, children }) {
    return <div><label className="eyebrow">{label}</label><div className="mt-1">{children}</div>{error && <p className="text-sm text-danger mt-1">{error}</p>}</div>;
}