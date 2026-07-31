import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link, useForm } from '@inertiajs/react';

export default function Orders({ orders, purchases }) {
    const finishForm = useForm({ id: null });
    const finish = (id) => {
        finishForm.put(route('orders.finish'), { data: { id }, preserveScroll: true });
    };

    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-5xl px-4 sm:px-6 py-8">
                <h1 className="text-2xl font-bold mb-6">Orders</h1>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <section>
                        <h2 className="text-lg font-semibold mb-4">Incoming orders</h2>
                        {orders.data.length === 0 ? (
                            <p className="surface p-6 text-muted text-sm">No incoming orders yet.</p>
                        ) : orders.data.map((d) => (
                            <article key={d.id} className="surface p-4 mb-3">
                                <div className="flex justify-between gap-3">
                                    <Link href={route('services.show', d.service.id)} className="font-medium hover:text-brand line-clamp-1">{d.service.name}</Link>
                                    <span className={`text-sm shrink-0 ${d.status === 'Done' ? 'text-success' : 'text-accent'}`}>{d.status}</span>
                                </div>
                                {d.buyer && <p className="text-sm text-muted">Buyer: {d.buyer.name}</p>}
                                {d.status === 'Ongoing' && <button onClick={() => finish(d.id)} className="btn btn-ghost text-sm !py-1 mt-3">Mark as done</button>}
                            </article>
                        ))}
                    </section>

                    <section>
                        <h2 className="text-lg font-semibold mb-4">Your purchases</h2>
                        {purchases.data.length === 0 ? (
                            <p className="surface p-6 text-muted text-sm">No purchases yet.</p>
                        ) : purchases.data.map((d) => (
                            <article key={d.id} className="surface p-4 mb-3">
                                <Link href={route('services.show', d.service.id)} className="font-medium hover:text-brand line-clamp-1">{d.service.name}</Link>
                                {d.seller && <p className="text-sm text-muted">Seller: {d.seller.name}</p>}
                                <span className={`text-sm ${d.status === 'Done' ? 'text-success' : 'text-accent'}`}>{d.status}</span>
                            </article>
                        ))}
                    </section>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}