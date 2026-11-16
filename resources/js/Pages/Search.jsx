import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ServiceCard from '@/Components/ServiceCard';
import { Link } from '@inertiajs/react';

export default function Search({ keyword, services }) {
    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-7xl px-4 sm:px-6 py-8">
                <h1 className="text-2xl font-bold mb-2">Search results for “{keyword}”</h1>
                <p className="text-muted mb-6">{services.total} services found</p>

                {services.data.length === 0 ? (
                    <div className="surface p-10 text-center">
                        <p className="text-muted">No services matched. Try a different keyword.</p>
                        <Link href={route('explore')} className="btn btn-brand mt-4">Browse all</Link>
                    </div>
                ) : (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        {services.data.map((s) => <ServiceCard key={s.id} service={s} />)}
                    </div>
                )}
            </div>
        </AuthenticatedLayout>
    );
}