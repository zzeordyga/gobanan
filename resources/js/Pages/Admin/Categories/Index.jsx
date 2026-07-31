import AdminLayout from '@/Layouts/AdminLayout';
import { Link, useForm } from '@inertiajs/react';

function Paginator({ p }) {
    if (p.last_page <= 1) return null;
    const pages = Array.from({ length: p.last_page }, (_, i) => i + 1);
    return (
        <nav className="mt-4 flex flex-wrap gap-1">
            {pages.map((n) => <a key={n} href={`${p.path}?page=${n}`} className={`px-3 py-2 rounded-lg text-sm ${n === p.current_page ? 'bg-brand text-white' : 'surface-2 hover:text-brand'}`}>{n}</a>)}
        </nav>
    );
}

export default function AdminCategories({ categories }) {
    const form = useForm();
    const destroy = (id) => { if (confirm('Delete?')) form.delete(route('admin.categories.destroy', id)); };
    return (
        <AdminLayout title="Categories">
            <div className="flex items-center justify-between mb-4">
                <h2 className="text-xl font-bold">Categories</h2>
                <Link href={route('admin.categories.create')} className="btn btn-brand text-sm">+ New</Link>
            </div>
            <div className="surface overflow-hidden">
                <table className="w-full text-sm">
                    <thead className="surface-2 text-left eyebrow"><tr><th className="p-3">Name</th><th className="p-3">Services</th><th className="p-3">Visits</th><th className="p-3 text-right">Actions</th></tr></thead>
                    <tbody>
                        {categories.data.length === 0 ? (
                            <tr><td className="p-6 text-muted" colSpan="4">No categories.</td></tr>
                        ) : categories.data.map((c) => (
                            <tr key={c.id} className="border-t border-border">
                                <td className="p-3 font-medium">{c.name}</td>
                                <td className="p-3 text-muted">{c.servicesCount}</td>
                                <td className="p-3 text-muted">{c.timesVisited}</td>
                                <td className="p-3 text-right">
                                    <Link href={route('admin.categories.edit', c.id)} className="text-brand hover:underline">Edit</Link>
                                    <button onClick={() => destroy(c.id)} className="text-danger hover:underline ml-3">Delete</button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
            <Paginator p={categories} />
        </AdminLayout>
    );
}