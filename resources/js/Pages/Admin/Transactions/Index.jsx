import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';

export default function AdminTransactions({ headers }) {
    return (
        <AdminLayout title="Transactions">
            <h2 className="text-xl font-bold mb-4">Transactions</h2>
            <div className="surface overflow-x-auto">
                <table className="w-full text-sm">
                    <thead className="surface-2 text-left eyebrow"><tr><th className="p-3">ID</th><th className="p-3">Buyer</th><th className="p-3">Payment</th><th className="p-3">Items</th><th className="p-3 text-right">Actions</th></tr></thead>
                    <tbody>
                        {headers.data.length === 0 ? <tr><td className="p-6 text-muted" colSpan="5">No transactions.</td></tr> :
                            headers.data.map((h) => (
                                <tr key={h.id} className="border-t border-border">
                                    <td className="p-3 text-muted">#{h.id}</td>
                                    <td className="p-3">{h.user?.name}</td>
                                    <td className="p-3 text-muted">{h.paymentType}</td>
                                    <td className="p-3">{h.items}</td>
                                    <td className="p-3 text-right"><Link href={route('admin.transactions.show', h.id)} className="text-brand hover:underline">Details</Link></td>
                                </tr>
                            ))}
                    </tbody>
                </table>
            </div>
        </AdminLayout>
    );
}