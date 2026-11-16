import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';

export default function AdminServices({ services }) {
    return (
        <AdminLayout title="Services">
            <h2 className="text-xl font-bold mb-4">Services</h2>
            <div className="surface overflow-x-auto">
                <table className="w-full text-sm">
                    <thead className="surface-2 text-left eyebrow"><tr><th className="p-3">Name</th><th className="p-3">Seller</th><th className="p-3">Category</th><th className="p-3">Price</th></tr></thead>
                    <tbody>
                        {services.data.length === 0 ? <tr><td className="p-6 text-muted" colSpan="4">No services.</td></tr> :
                            services.data.map((s) => (
                                <tr key={s.id} className="border-t border-border">
                                    <td className="p-3"><Link href={route('services.show', s.id)} className="hover:text-brand line-clamp-1">{s.name}</Link></td>
                                    <td className="p-3 text-muted">{s.user?.name}</td>
                                    <td className="p-3 text-muted">{s.category?.name}</td>
                                    <td className="p-3 font-medium">${s.price.toFixed(2)}</td>
                                </tr>
                            ))}
                    </tbody>
                </table>
            </div>
        </AdminLayout>
    );
}