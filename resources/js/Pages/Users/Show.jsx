import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/react';

export default function UsersShow({ seller, services }) {
    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-5xl px-4 sm:px-6 py-8">
                <div className="surface p-6 flex flex-col sm:flex-row sm:items-center gap-5">
                    <span className="inline-flex h-20 w-20 items-center justify-center rounded-full bg-brand text-white text-2xl font-bold">{seller.name?.charAt(0)}</span>
                    <div>
                        <h1 className="text-2xl font-bold">@{seller.username}</h1>
                        <p className="text-muted text-sm">{seller.name}</p>
                        <p className="text-sm text-muted mt-1">{seller.serviceCount} services · ⭐ {seller.rating.toFixed(1)} ({seller.reviewCount} reviews)</p>
                    </div>
                </div>

                <h2 className="text-lg font-semibold mt-8 mb-4">Services</h2>
                {services.data.length === 0 ? (
                    <p className="surface p-6 text-muted text-sm">No services listed.</p>
                ) : (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        {services.data.map((s) => (
                            <Link key={s.id} href={route('services.show', s.id)} className="surface p-4 hover:shadow-md transition">
                                <h3 className="font-medium line-clamp-1">{s.name}</h3>
                                <p className="text-brand font-bold mt-2">${Number(s.price).toFixed(2)}</p>
                            </Link>
                        ))}
                    </div>
                )}
            </div>
        </AuthenticatedLayout>
    );
}