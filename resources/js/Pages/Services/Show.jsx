import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ServiceCard from '@/Components/ServiceCard';
import { Link, useForm, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function ServicesShow({ service, related }) {
    const { auth } = usePage().props;
    const [rating, setRating] = useState(5);
    const reviewForm = useForm({ title: '', description: '', rating: 5 });
    const cartForm = useForm({ service_id: service.id, notes: '' });

    const submitReview = (e) => {
        e.preventDefault();
        reviewForm.transform((d) => ({ ...d, rating })).post(route('reviews.store', service.id), {
            preserveScroll: true,
            onSuccess: () => reviewForm.reset(),
        });
    };

    const addToCart = (e) => {
        e.preventDefault();
        cartForm.post(route('cart.store'), { preserveScroll: true });
    };

    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-7xl px-4 sm:px-6 py-8">
                <nav className="flex gap-2 text-sm text-muted mb-5 flex-wrap">
                    {service.category && <>
                        <Link href={route('category', service.category.id)} className="hover:text-brand">{service.category.name}</Link>
                        <span>/</span>
                    </>}
                    <span className="text-text">{service.name}</span>
                </nav>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div className="lg:col-span-2 space-y-6">
                        <div className="surface overflow-hidden">
                            {service.picture ? (
                                <img src={service.picture} alt={service.name} className="w-full aspect-[16/10] object-cover" loading="lazy" decoding="async" />
                            ) : (
                                <div className="aspect-[16/10] bg-surface-2" />
                            )}
                        </div>

                        <div>
                            <h1 className="text-3xl font-bold tracking-tight">{service.name}</h1>
                            {service.seller && (
                                <Link href={route('users.show', service.seller.id)} className="mt-2 inline-flex items-center gap-2 text-muted hover:text-brand">
                                    <span className="inline-flex h-7 w-7 items-center justify-center rounded-full bg-brand text-white text-xs font-bold">{service.seller.name?.charAt(0)}</span>
                                    <span>by {service.seller.name}</span>
                                </Link>
                            )}
                        </div>

                        <div className="surface p-5">
                            <div className="flex flex-wrap items-center gap-4 text-sm">
                                <span className="inline-flex items-center gap-1">
                                    <svg className="h-4 w-4 text-accent" fill="currentColor" viewBox="0 0 20 20"><path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.36 4.17h4.38c.97 0 1.37 1.24.59 1.81l-3.55 2.58 1.36 4.17c.3.92-.76 1.69-1.54 1.12L10 16.2l-3.55 2.58c-.78.57-1.84-.2-1.54-1.12l1.36-4.17-3.55-2.58c-.78-.57-.38-1.81.59-1.81h4.38l1.36-4.17z" /></svg>
                                    {service.rating.toFixed(1)} · {service.reviewCount} reviews
                                </span>
                                {service.category && <span className="eyebrow">{service.category.name}</span>}
                            </div>
                            <p className="mt-4 whitespace-pre-line leading-relaxed">{service.description}</p>
                        </div>

                        <section id="reviews" className="surface p-5">
                            <h2 className="text-xl font-bold mb-4">Reviews ({service.reviewCount})</h2>

                            {auth.user ? (
                                <form onSubmit={submitReview} className="surface-2 p-4 mb-6 space-y-3">
                                    <div className="flex gap-1">
                                        {[1, 2, 3, 4, 5].map((i) => (
                                            <button key={i} type="button" onClick={() => setRating(i)}
                                                className={`text-2xl transition ${i <= rating ? 'text-accent' : 'text-muted'}`}>★</button>
                                        ))}
                                    </div>
                                    {reviewForm.errors.rating && <p className="text-sm text-danger">{reviewForm.errors.rating}</p>}
                                    <input type="text" value={reviewForm.data.title} onChange={(e) => reviewForm.setData('title', e.target.value)} placeholder="Review title"
                                        className="w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                                    {reviewForm.errors.title && <p className="text-sm text-danger">{reviewForm.errors.title}</p>}
                                    <textarea rows="3" value={reviewForm.data.description} onChange={(e) => reviewForm.setData('description', e.target.value)} placeholder="Share your experience…"
                                        className="w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                                    <button type="submit" className="btn btn-brand" disabled={reviewForm.processing}>Post review</button>
                                </form>
                            ) : (
                                <p className="text-sm text-muted mb-6"><Link href={route('login')} className="text-brand">Log in</Link> to leave a review.</p>
                            )}

                            <div className="space-y-4">
                                {service.reviews.length === 0 ? (
                                    <p className="text-muted text-sm">No reviews yet — be the first.</p>
                                ) : service.reviews.map((r) => (
                                    <article key={r.id} className="border-b border-border pb-4 last:border-0">
                                        <div className="flex items-center gap-2 mb-1">
                                            <span className="inline-flex h-6 w-6 items-center justify-center rounded-full bg-accent text-white text-xs font-bold">{r.user?.name?.charAt(0)}</span>
                                            <span className="font-medium text-sm">{r.user?.name ?? 'Anonymous'}</span>
                                            <span className="ml-auto text-accent text-sm">{'★'.repeat(r.rating)}</span>
                                        </div>
                                        <p className="font-medium">{r.title}</p>
                                        {r.description && <p className="text-muted text-sm mt-1">{r.description}</p>}
                                    </article>
                                ))}
                            </div>
                        </section>
                    </div>

                    <aside className="lg:col-span-1">
                        <div className="lg:sticky lg:top-20 surface p-6 space-y-4">
                            <div className="flex items-baseline justify-between">
                                <span className="eyebrow">Price</span>
                                <span className="text-3xl font-bold text-brand">${service.price.toFixed(2)}</span>
                            </div>

                            {auth.user ? (
                                <form onSubmit={addToCart} className="space-y-3">
                                    <textarea rows="2" value={cartForm.data.notes} onChange={(e) => cartForm.setData('notes', e.target.value)} placeholder="Add a note for the seller (optional)"
                                        className="w-full surface-2 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand" />
                                    {cartForm.errors.notes && <p className="text-sm text-danger">{cartForm.errors.notes}</p>}
                                    <button type="submit" className="btn btn-brand w-full" disabled={cartForm.processing}>Add to cart</button>
                                </form>
                            ) : (
                                <Link href={route('login')} className="btn btn-brand w-full">Log in to buy</Link>
                            )}

                            {service.seller && (
                                <div className="border-t border-border pt-4">
                                    <Link href={route('users.show', service.seller.id)} className="flex items-center gap-3 hover:text-brand">
                                        <span className="inline-flex h-10 w-10 items-center justify-center rounded-full bg-brand text-white font-bold">{service.seller.name?.charAt(0)}</span>
                                        <div>
                                            <p className="font-medium text-sm">{service.seller.name}</p>
                                            <p className="eyebrow">View seller profile</p>
                                        </div>
                                    </Link>
                                </div>
                            )}
                        </div>
                    </aside>
                </div>

                {related?.length > 0 && (
                    <section className="mt-12">
                        <h2 className="text-xl font-bold mb-5">Similar services</h2>
                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                            {related.map((s) => <ServiceCard key={s.id} service={s} />)}
                        </div>
                    </section>
                )}
            </div>
        </AuthenticatedLayout>
    );
}