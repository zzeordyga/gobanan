import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function Cart({ carts, total }) {
    const { delete: destroy } = useForm({ id: null });
    const checkoutForm = useForm({ payment_type: 'Debit' });

    const remove = (id) => {
        if (!confirm('Remove from cart?')) return;
        destroy.delete(route('cart.destroy'), { data: { id }, preserveScroll: true });
    };

    const submitCheckout = (e) => {
        e.preventDefault();
        checkoutForm.post(route('cart.checkout'), { preserveScroll: true });
    };

    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-4xl px-4 sm:px-6 py-8">
                <h1 className="text-2xl font-bold mb-6">Your cart</h1>

                {carts.length === 0 ? (
                    <div className="surface p-10 text-center">
                        <p className="text-muted">Your cart is empty.</p>
                        <Link href={route('explore')} className="btn btn-brand mt-4">Browse services</Link>
                    </div>
                ) : (
                    <>
                        <div className="space-y-3">
                            {carts.map((c) => (
                                <div key={c.id} className="surface p-4 flex gap-4 items-center">
                                    {c.service.picture && <img src={c.service.picture} alt="" className="h-16 w-20 rounded-lg object-cover" loading="lazy" />}
                                    <div className="flex-1 min-w-0">
                                        <Link href={route('services.show', c.service.id)} className="font-medium hover:text-brand line-clamp-1">{c.service.name}</Link>
                                        {c.notes && <p className="text-sm text-muted line-clamp-1">“{c.notes}”</p>}
                                        {c.service.seller && <p className="text-sm text-muted">by {c.service.seller.name}</p>}
                                    </div>
                                    <span className="font-bold text-brand">${c.service.price.toFixed(2)}</span>
                                    <button onClick={() => remove(c.id)} className="btn btn-ghost text-sm !px-2">✕</button>
                                </div>
                            ))}
                        </div>

                        <form onSubmit={submitCheckout} className="surface mt-6 p-5 flex flex-col sm:flex-row sm:items-center gap-4">
                            <div className="flex-1">
                                <label className="eyebrow">Payment method</label>
                                <select value={checkoutForm.data.payment_type} onChange={(e) => checkoutForm.setData('payment_type', e.target.value)}
                                    className="block w-full mt-1 surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                                    <option>Debit</option><option>Credit</option><option>Bank Transfer</option><option>E-Wallet</option>
                                </select>
                            </div>
                            <div className="text-right">
                                <p className="eyebrow">Total</p>
                                <p className="text-2xl font-bold text-brand">${total.toFixed(2)}</p>
                            </div>
                            <button type="submit" className="btn btn-brand" disabled={checkoutForm.processing}>Checkout</button>
                        </form>
                    </>
                )}
            </div>
        </AuthenticatedLayout>
    );
}