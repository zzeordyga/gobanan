import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';

export default function AdminTransactionShow({ header }) {
    return (
        <AdminLayout title={`Transaction #${header.id}`}>
            <div className="flex items-center justify-between mb-4">
                <h2 className="text-xl font-bold">Transaction #{header.id}</h2>
                <Link href={route('admin.transactions.index')} className="btn btn-ghost text-sm">← Back</Link>
            </div>
            <div className="surface p-4 mb-4 text-sm">
                <p><span className="eyebrow">Buyer:</span> {header.user?.name}</p>
                <p><span className="eyebrow">Payment:</span> {header.paymentType}</p>
            </div>
            <div className="surface overflow-x-auto">
                <table className="w-full text-sm">
                    <thead className="surface-2 text-left eyebrow"><tr><th className="p-3">Service</th><th className="p-3">Seller</th><th className="p-3">Status</th><th className="p-3">Notes</th></tr></thead>
                    <tbody>
                        {header.details.length === 0 ? <tr><td className="p-6 text-muted" colSpan="4">No items.</td></tr> :
                            header.details.map((d) => (
                                <tr key={d.id} className="border-t border-border">
                                    <td className="p-3"><Link href={route('services.show', d.service.id)} className="hover:text-brand line-clamp-1">{d.service.name}</Link></td>
                                    <td className="p-3 text-muted">{d.seller?.name}</td>
                                    <td className={`p-3 ${d.status === 'Done' ? 'text-success' : 'text-accent'}`}>{d.status}</td>
                                    <td className="p-3 text-muted line-clamp-1">{d.notes ?? '—'}</td>
                                </tr>
                            ))}
                    </tbody>
                </table>
            </div>
        </AdminLayout>
    );
}